<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicRegistrationRequest;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class PublicRegistrationController extends Controller
{
    public function store(PublicRegistrationRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Registration::create($validated);
        });

        return redirect()
            ->route('ppdb')
            ->with('success', 'Pendaftaran berhasil dikirim! Nomor pendaftaran Anda akan diverifikasi oleh panitia.');
    }
}