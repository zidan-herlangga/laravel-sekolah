@extends('layouts.app')
@section('title', 'Verifikasi Email - SMP Tunas Harapan')

@section('content')
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-dark-900">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt=""
                class="w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-900 via-dark-900/50 to-dark-900/60"></div>
            {{-- <div class="absolute inset-0 hero-pattern"></div> --}}
        </div>

        <div
            class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 fade-up visible text-center">
            <div class="w-20 h-20 bg-primary-50 text-primary-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-paper-plane text-3xl"></i>
            </div>
            <h2 class="font-display text-2xl font-bold text-dark-900 mb-4">Verifikasi Email Anda</h2>
            <p class="text-dark-600 text-sm mb-8 leading-relaxed">Kami telah mengirimkan link verifikasi ke email Anda.
                Silakan klik link tersebut untuk mengaktifkan akun dan mengisi formulir SPMB.</p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 shadow-lg mb-4">Kirim
                    Ulang Link</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-xs text-dark-400 hover:text-primary-500 font-bold uppercase tracking-widest">Ganti Email /
                    Keluar</button>
            </form>
        </div>
    </section>
@endsection
