@extends('layouts.app')

@section('title', 'Dashboard Pendaftar - SMP Tunas Harapan')

@section('content')
    <div class="min-h-screen bg-gray-50 pt-28 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Welcome Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 fade-up visible">
                <div>
                    <h1 class="font-display text-3xl font-bold text-dark-900">Halo, {{ $user->name }}! 👋</h1>
                    <p class="text-dark-500 mt-1">Selamat datang di panel kendali pendaftaran Anda.</p>
                </div>
                <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center text-white">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div class="pr-4">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-dark-400">Status Akun</p>
                        <p class="text-sm font-bold text-emerald-500">Terverifikasi</p>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Main Statistics & Status -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Status Pendaftaran Card -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                        <h3 class="font-display font-bold text-dark-900 mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-primary-500"></i>
                            Status Pendaftaran
                        </h3>

                        @if ($registration)
                            <div
                                class="flex items-center justify-between p-6 bg-primary-50 rounded-2xl border border-primary-100">
                                <div>
                                    <p class="text-xs text-primary-600 font-bold uppercase tracking-wider mb-1">Nomor
                                        Pendaftaran</p>
                                    <p class="text-xl font-display font-black text-primary-900">
                                        {{ $registration->registration_number }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase {{ $registration->status == 'lulus' ? 'bg-emerald-500 text-white' : 'bg-amber-400 text-white' }}">
                                        {{ $registration->status ?? 'Proses Seleksi' }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <p class="text-dark-500 text-sm mb-4">Anda belum melengkapi formulir pendaftaran.</p>
                                <a href="{{ route('spmb') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-all">
                                    Isi Formulir Sekarang <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Menu Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Cek Kelulusan -->
                        <a href="{{ route('pendaftar.cek-status') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-id-card text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Cek Kelulusan (NISN)</h4>
                            <p class="text-xs text-dark-500 mt-2">Lihat pengumuman hasil seleksi akhir menggunakan NISN
                                Anda.</p>
                        </a>

                        <!-- Test Online -->
                        <a href="{{ route('pendaftar.ujian.index') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-laptop-code text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Tes Online</h4>
                            <p class="text-xs text-dark-500 mt-2">Fitur tes online akan dibuka sesuai jadwal yang
                                ditentukan.</p>
                        </a>

                        <!-- Profile -->
                        <a href="{{ route('pendaftar.profile') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-user-gear text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Profil Pendaftar</h4>
                            <p class="text-xs text-dark-500 mt-2">Lengkapi data diri, foto profil, dan dokumen pendukung
                                lainnya.</p>
                        </a>

                        <!-- Dokumen -->
                        <a href="#"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-file-pdf text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Unduh Kartu</h4>
                            <p class="text-xs text-dark-500 mt-2">Cetak kartu bukti pendaftaran dan kartu ujian seleksi.</p>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-8">
                    <!-- Info Pendaftaran -->
                    <div class="bg-dark-900 rounded-3xl p-8 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="font-display font-bold text-xl mb-4">Bantuan Teknis?</h3>
                            <p class="text-dark-300 text-sm mb-6 leading-relaxed">Jika mengalami kendala saat pengisian data
                                atau ujian online, hubungi panitia melalui WhatsApp.</p>
                            <a href="https://wa.me/{{ $settings->get('school_phone') }}"
                                class="flex items-center justify-center gap-2 w-full py-3 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-all">
                                <i class="fa-brands fa-whatsapp"></i> Chat Panitia
                            </a>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary-500/10 rounded-full blur-3xl"></div>
                    </div>

                    <!-- Pengumuman Singkat -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <h4 class="font-display font-bold text-dark-900 mb-4 uppercase tracking-widest text-[10px]">Alur
                            Selanjutnya</h4>
                        <ul class="space-y-4">
                            <li class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 text-[10px] font-bold">
                                    1</div>
                                <p class="text-xs text-dark-600">Verifikasi berkas oleh panitia (1-3 hari kerja).</p>
                            </li>
                            <li class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0 text-[10px] font-bold">
                                    2</div>
                                <p class="text-xs text-dark-400">Pelaksanaan ujian seleksi online sesuai jadwal.</p>
                            </li>
                            <li class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0 text-[10px] font-bold">
                                    3</div>
                                <p class="text-xs text-dark-400">Pengumuman kelulusan melalui dashboard ini.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
