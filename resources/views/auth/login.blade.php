@extends('layouts.app')
@section('title', 'Masuk Pendaftar - SMP Tunas Harapan')

@section('content')
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-dark-900">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt=""
                class="w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-900 via-dark-900/50 to-dark-900/60"></div>
            {{-- <div class="absolute inset-0 hero-pattern"></div> --}}
        </div>

        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 fade-up visible">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-50 rounded-2xl mb-4">
                    <i class="fa-solid fa-user-check text-primary-500 text-2xl"></i>
                </div>
                <h2 class="font-display text-2xl font-bold text-dark-900">Masuk Akun</h2>
                <p class="text-dark-500 text-sm mt-2">Masuk untuk melanjutkan pendaftaran siswa baru</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-dark-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm @error('email') border-red-500 @enderror"
                        placeholder="email@contoh.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-dark-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm">
                </div>
                <button type="submit"
                    class="w-full py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 shadow-lg shadow-primary-500/30 transition-all">Masuk
                    Sekarang</button>
            </form>

            <p class="mt-8 text-center text-sm text-dark-500">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-primary-500 font-bold hover:underline">Daftar Akun Baru</a></p>
        </div>
    </section>
@endsection
