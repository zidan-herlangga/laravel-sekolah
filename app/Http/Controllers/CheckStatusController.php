<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckStatusController extends Controller
{
  public function show()
  {
    return view('pages.cek-status');
  }

  public function check(Request $request)
  {
      $request->validate([
          'nisn' => 'required|digits:10',
      ]);

      $registration = Registration::where('nisn', $request->nisn)->first();

      if (!$registration) {
          return redirect()->route('cek-status')->with('not_found', true)->withInput();
      }

      // Kirim data registration ke session
      return redirect()->route('cek-status')->with('registration', $registration);
  }

  public function downloadPdf(Request $request)
  {
      // 1. Ambil NISN dari input form
      $nisn = $request->input('nisn');

      // 2. Cari data berdasarkan NISN di Database
      // Pastikan menggunakan model Registration yang benar
      $reg = \App\Models\Registration::where('nisn', $nisn)->firstOrFail();

      // 3. Ambil setting nama sekolah
      $schoolName = \App\Models\SiteSetting::where('key', 'school_name')->first()?->value ?? 'Sekolah';

      // 4. Load PDF
      $pdf = \PDF::loadView('pdf.bukti-pendaftaran', compact('reg', 'schoolName'));

      // 5. Download
      return $pdf->download('Bukti-Pendaftaran-' . $reg->nisn . '.pdf');
  }
}