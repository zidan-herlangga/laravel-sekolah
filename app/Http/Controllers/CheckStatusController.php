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
}