@extends('layouts.app')

@section('title', 'SPMB Ditutup - ' . $settings->get('school_name'))

@section('content')

    <!-- Hero -->
    <section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0"><img src="https://picsum.photos/seed/-spmbclosed/1920/600" alt=""
                class="w-full h-full object-cover opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/10 border border-red-500/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                <span class="text-red-400 text-xs font-semibold uppercase tracking-widest">Ditutup</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Pendaftaran Siswa Baru
            </h1>
            <p class="text-dark-300 max-w-2xl mx-auto">Beranda > <a href="{{ route('spmb') }}"
                    class="text-primary-400 hover:text-primary-500">SPMB</a></p>
        </div>
    </section>

    <!-- Info Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="fade-up max-w-4xl mx-auto">
                <div class="bg-white border border-gray-200 rounded-3xl p-8 md:p-10 shadow-sm text-center">

                    <!-- Icon -->
                    <div class="w-24 h-24 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-calendar-times text-red-500 text-4xl"></i>
                    </div>

                    <!-- Heading -->
                    <h2 class="font-display text-3xl font-bold text-dark-900 tracking-tight mb-4">Pendaftaran Saat Ini
                        Ditutup</h2>

                    <p class="text-dark-500 leading-relaxed max-w-xl mx-auto mb-10">
                        Mohon maaf, halaman Penerimaan Siswa Baru (SPMB) untuk saat ini sedang tidak aktif.
                        Silakan pantau terus informasi terbaru melalui website ini atau hubungi panitia SPMB kami untuk
                        jadwal pendaftaran selanjutnya.
                    </p>

                    <!-- Info Kontak (Menggunakan style card persyaratan yang sama) -->
                    <div class="bg-dark-900 rounded-3xl p-10 mb-10 text-left">
                        <h3 class="font-display text-2xl font-bold text-white mb-6 text-center">Butuh Informasi Lebih
                            Lanjut?</h3>
                        <div class="grid md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                            <div class="flex flex-col items-center text-center gap-3">
                                <div
                                    class="w-14 h-14 bg-primary-400/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-primary-400 text-lg"></i>
                                </div>
                                <div>
                                    <span
                                        class="text-dark-400 text-xs font-semibold uppercase tracking-widest">Telepon</span>
                                    <p class="text-white text-sm font-medium mt-1">
                                        {{ $settings->get('school_phone', '08128726879') }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center text-center gap-3">
                                <div
                                    class="w-14 h-14 bg-primary-400/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-primary-400 text-lg"></i>
                                </div>
                                <div>
                                    <span class="text-dark-400 text-xs font-semibold uppercase tracking-widest">Email</span>
                                    <p class="text-white text-sm font-medium mt-1">
                                        {{ $settings->get('school_email', 'info@sekolah.id') }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center text-center gap-3">
                                <div
                                    class="w-14 h-14 bg-primary-400/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-primary-400 text-lg"></i>
                                </div>
                                <div>
                                    <span
                                        class="text-dark-400 text-xs font-semibold uppercase tracking-widest">Alamat</span>
                                    <p class="text-white text-sm font-medium mt-1">
                                        {{ $settings->get('school_address', 'Bekasi') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center justify-center gap-2 px-10 py-4 bg-dark-900 text-white font-semibold rounded-xl hover:bg-dark-800 hover:shadow-lg transition-all duration-300">
                            <i class="fas fa-home"></i>
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center gap-2 px-10 py-4 border-2 border-gray-200 text-dark-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                            <i class="fas fa-envelope"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
