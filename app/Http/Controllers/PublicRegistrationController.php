<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Services\SettingService;
use Barryvdh\DomPDF\Facade\Pdf;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicRegistrationController extends Controller
{
    public function store(Request $request)
    {
        // 1. CEK APAKAH USER SUDAH PERNAH MENDAFTAR
        $existing = Registration::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah melakukan pendaftaran dengan nomor: ' . $existing->registration_number);
        }

        // 2. VALIDASI DATA
        $validated = $request->validate([
            // Data Pribadi
            'name'              => 'required|string|max:255',
            'nisn'              => [
                'required',
                'numeric',
                'digits:10',
                'unique:registrations,nisn' 
            ],
            'school_origin'     => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'gender'            => 'required|in:L,P',
            'birth_date'        => 'required|date|before:today',
            'birth_place'       => 'required|string|max:255',
            'address'           => 'required|string|max:1000',
            
            // Data Orang Tua
            'parent_name'       => 'required|string|max:255',
            'parent_phone'      => 'required|string|max:20',
            
            // Dokumen (Wajib)
            'kartu_keluarga'    => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah'            => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'akte_kelahiran'    => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nisn.unique' => 'NISN ini sudah terdaftar dalam sistem.',
            'nisn.digits' => 'NISN harus berjumlah 10 digit angka.',
            'kartu_keluarga.max' => 'Ukuran file Kartu Keluarga maksimal 2MB.',
        ]);

        // 3. GENERATE NOMOR PENDAFTARAN OTOMATIS (Format: REG-2026-0001)
        $year = date('Y');
        $lastReg = Registration::whereYear('created_at', $year)->latest()->first();
        $nextNumber = $lastReg ? (int) substr($lastReg->registration_number, -4) + 1 : 1;
        $registrationNumber = 'REG-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // 4. PROSES UPLOAD FILE
        $filePaths = [];
        $documents = ['kartu_keluarga', 'ijazah', 'akte_kelahiran'];
        
        foreach ($documents as $doc) {
            if ($request->hasFile($doc)) {
                $filePaths[$doc] = $request->file($doc)->store('documents/spmb', 'public');
            }
        }

        // 5. SIMPAN KE DATABASE DENGAN RELASI USER
        Registration::create(array_merge($validated, $filePaths, [
            'user_id' => Auth::id(),
            'registration_number' => $registrationNumber,
            'status' => 'pending' // Default status
        ]));

        // 6. REDIRECT KE DASHBOARD
        return redirect()->route('dashboard')->with('success', 'Pendaftaran Berhasil! Nomor Anda: ' . $registrationNumber);
    }

    public function downloadBukti()
    {
        // 1. Ambil data pendaftaran milik user yang sedang login
        $registration = Registration::where('user_id', Auth::id())->first();

        // 2. Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // 3. Ambil setting sekolah (menggunakan service yang Anda punya)
        $settings = app(SettingService::class);

        // 4. Load view khusus PDF dan lempar datanya
        // Pastikan file view ini ada di: resources/views/pages/pendaftar/bukti-pdf.blade.php
        $pdf = Pdf::loadView('pages.pendaftar.pdf.bukti-pendaftaran', compact('registration', 'settings'))
                  ->setPaper('a4', 'portrait');

        // 5. Download file PDF-nya
        return $pdf->download('Bukti_Pendaftaran_' . $registration->registration_number . '.pdf');
    }

    public function downloadKartu()
    {
        $registration = Registration::where('user_id', Auth::id())->first();

        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $settings = app(SettingService::class);

        $pdf = Pdf::loadView('pages.pendaftar.pdf.kartu-peserta', compact('registration', 'settings'))
                  ->setPaper([0, 0, 520, 720], 'portrait');

        return $pdf->download('Kartu_Peserta_' . $registration->registration_number . '.pdf');
    }
}