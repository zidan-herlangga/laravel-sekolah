@extends('layouts.app')

@section('title', 'Pengecekan Status Ditutup - ' . $settings->get('school_name'))

@section('content')
    <section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://picsum.photos/id/160/1920/600" alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Layanan Nonaktif</h1>
            <p class="text-dark-300 max-w-2xl mx-auto">
                Beranda > <span class="text-primary-400">Cek Status</span>
            </p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-6 lg:px-8 text-center">
            <div class="bg-gray-50 border border-gray-200 rounded-3xl p-10 md:p-16 shadow-sm">
                <div class="w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-exclamation-triangle text-amber-500 text-4xl"></i>
                </div>

                <h2 class="font-display text-3xl font-bold text-dark-900 mb-4">Pengecekan Status Dinonaktifkan</h2>

                <p class="text-dark-600 text-lg mb-8 leading-relaxed">
                    Mohon maaf, fitur pengecekan status pendaftaran SPMB Online saat ini sedang ditangguhkan atau telah
                    resmi ditutup sesuai dengan jadwal administrasi sekolah.
                </p>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-10 text-left inline-block w-full">
                    <h4 class="font-bold text-dark-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-info-circle text-primary-500"></i>
                        Apa yang harus saya lakukan?
                    </h4>
                    <ul class="space-y-3 text-dark-500 text-sm">
                        <li class="flex gap-3">
                            <span class="text-primary-500 font-bold">•</span>
                            <span>Pantau terus halaman <strong>Berita</strong> untuk pengumuman hasil seleksi
                                kolektif.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-primary-500 font-bold">•</span>
                            <span>Jika Anda sudah terverifikasi sebelumnya, harap menunggu instruksi daftar ulang via
                                WhatsApp/Email.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-primary-500 font-bold">•</span>
                            <span>Hubungi sekretariat pendaftaran pada jam kerja jika ada kendala mendesak.</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                        class="px-8 py-4 bg-dark-900 text-white font-semibold rounded-xl hover:bg-dark-800 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('contact') }}"
                        class="px-8 py-4 bg-white border border-gray-300 text-dark-700 font-semibold rounded-xl hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-phone-alt"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
