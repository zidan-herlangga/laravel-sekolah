<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class PublicRegistrationController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDASI DATA (Digabung jadi satu blok yang rapi)
        $validated = $request->validate([
            // Data Pribadi
            'name'              => 'required|string|max:255',
            'nisn'              => [
                'required',
                'numeric',
                'digits:10',
                'unique:registrations,nisn' // Cek unik di tabel registrations kolom nisn
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
            
            // Dokumen (Wajib diupload)
            'kartu_keluarga'    => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah'            => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'akte_kelahiran'    => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            // Pesan Error Kustom (Opsional)
            'nisn.unique' => 'NISN ini sudah terdaftar sebelumnya.',
            'nisn.digits' => 'NISN harus 10 digit angka.',
            'kartu_keluarga.required' => 'Kartu Keluarga wajib diupload.',
            'ijazah.required' => 'Ijazah / SKL wajib diupload.',
            'akte_kelahiran.required' => 'Akte Kelahiran wajib diupload.',
        ]);

        // 2. PROSES UPLOAD FILE
        // Kita ambil path file dan masukkan ke array $validated
        if ($request->hasFile('kartu_keluarga')) {
            $validated['kartu_keluarga'] = $request->file('kartu_keluarga')->store('documents/spmb', 'public');
        }

        if ($request->hasFile('ijazah')) {
            $validated['ijazah'] = $request->file('ijazah')->store('documents/spmb', 'public');
        }

        if ($request->hasFile('akte_kelahiran')) {
            $validated['akte_kelahiran'] = $request->file('akte_kelahiran')->store('documents/spmb', 'public');
        }

        // 3. SIMPAN KE DATABASE
        // Status default 'pending' ada di migration, jadi tidak perlu di set manual
        Registration::create($validated);

        // 4. REDIRECT
        return redirect()->route('spmb')->with('success', 'Pendaftaran Berhasil! Silakan cek status secara berkala.');
    }
}