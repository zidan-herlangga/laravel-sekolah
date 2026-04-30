<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use Illuminate\Http\Request;
class PublicRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'nisn'          => 'required|digits:10|unique:registrations,nisn', // Gunakan digits untuk angka murni
            'school_origin' => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:255',
            'gender'        => 'required|in:L,P',
            'birth_date'    => 'required|date|before:today', // Validasi tanggal logis
            'birth_place'   => 'required|string|max:255',
            'address'       => 'required|string|max:1000',
            'parent_name'   => 'required|string|max:255',
            'parent_phone'  => 'required|string|max:20',
        ]);

        $request->validate([
            'nisn' => [
                'required',
                'digits:10',             // Harus angka dan tepat 10 digit
                'unique:registrations', // Tidak boleh ada NISN ganda di database
                'numeric',              // Memastikan tidak ada karakter aneh
            ],
        ], [
            'nisn.digits' => 'Mohon masukkan 10 digit NISN yang valid.',
            'nisn.unique' => 'NISN ini sudah terdaftar sebelumnya.',
        ]);

        // Menggunakan variabel $validated lebih aman daripada $request->all()
        Registration::create($validated);

        return redirect()->route('spmb')->with('success', 'Pendaftaran berhasil!');
    }   
}