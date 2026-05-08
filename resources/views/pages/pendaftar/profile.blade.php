@extends('layouts.app')

@section('title', 'Profil Pendaftar - ' . auth()->user()->name)

@section('content')
    <section class="min-h-screen bg-gray-50/50 pt-32 pb-20">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <!-- Header Profil -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 fade-up">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-primary-500 rounded-[2rem] flex items-center justify-center text-white shadow-xl shadow-primary-500/20">
                            <i class="fa-solid fa-user-graduate text-4xl"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center text-white shadow-lg"
                            title="Akun Terverifikasi">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="font-display text-3xl font-black text-dark-900 tracking-tight">{{ $registration->name }}
                        </h1>
                        <p class="text-dark-500 font-medium flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-primary-500"></i>
                            NISN: {{ $registration->nisn }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('pendaftar.download') }}"
                        class="px-6 py-3 bg-white border border-gray-200 text-dark-700 font-bold rounded-2xl hover:bg-gray-50 transition-all shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Cetak Bukti
                    </a>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri: Detail Informasi -->
                <div class="lg:col-span-2 space-y-8 fade-up" style="transition-delay: 100ms">

                    <!-- Data Pendidikan & Pribadi -->
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-gray-100 shadow-sm">
                        <h3 class="font-display font-bold text-dark-900 text-lg mb-8 flex items-center gap-3">
                            <span class="w-2 h-6 bg-primary-500 rounded-full"></span>
                            Informasi Biodata
                        </h3>

                        <div class="grid md:grid-cols-2 gap-y-8 gap-x-12">
                            <div class="group">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1 group-hover:text-primary-500 transition-colors">
                                    Asal Sekolah</p>
                                <p class="font-semibold text-dark-900">{{ $registration->school_origin }}</p>
                            </div>
                            <div class="group">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1 group-hover:text-primary-500 transition-colors">
                                    Tempat, Tanggal Lahir</p>
                                <p class="font-semibold text-dark-900">{{ $registration->birth_place }},
                                    {{ $registration->birth_date->format('d F Y') }}</p>
                            </div>
                            <div class="group">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1 group-hover:text-primary-500 transition-colors">
                                    Jenis Kelamin</p>
                                <p class="font-semibold text-dark-900">{{ $registration->gender_label }}</p>
                            </div>
                            <div class="group">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1 group-hover:text-primary-500 transition-colors">
                                    Nomor WhatsApp</p>
                                <p class="font-semibold text-dark-900">{{ $registration->phone }}</p>
                            </div>
                            <div class="md:col-span-2 group">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1 group-hover:text-primary-500 transition-colors">
                                    Alamat Lengkap</p>
                                <p class="font-semibold text-dark-900 leading-relaxed">{{ $registration->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-gray-100 shadow-sm">
                        <h3 class="font-display font-bold text-dark-900 text-lg mb-8 flex items-center gap-3">
                            <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
                            Data Orang Tua / Wali
                        </h3>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1">Nama
                                    Ayah/Ibu/Wali</p>
                                <p class="font-semibold text-dark-900">{{ $registration->parent_name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-dark-400 mb-1">Telepon Orang
                                    Tua</p>
                                <p class="font-semibold text-dark-900">{{ $registration->parent_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Status & Dokumen -->
                <div class="space-y-8 fade-up" style="transition-delay: 200ms">

                    <!-- Card Status -->
                    <div class="bg-dark-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl">
                        <div class="relative z-10">
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white/50 mb-6">Status
                                Pendaftaran</p>
                            <div
                                class="inline-flex px-4 py-2 rounded-xl bg-{{ $registration->status_color }}-500/20 text-{{ $registration->status_color }}-400 text-xs font-bold border border-{{ $registration->status_color }}-500/30 mb-4">
                                {{ $registration->status_label }}
                            </div>
                            <h4 class="font-display text-xl font-bold mb-2">No. Registrasi:</h4>
                            <p class="text-3xl font-black tracking-tighter text-primary-400">
                                {{ $registration->registration_number }}</p>
                        </div>
                        <!-- Glow decoration -->
                        <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-primary-500/20 rounded-full blur-3xl"></div>
                    </div>

                    <!-- Card Dokumen -->
                    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm">
                        <h3 class="font-display font-bold text-dark-900 text-lg mb-6">Berkas Terunggah</h3>
                        <div class="space-y-4">
                            @foreach ([['Kartu Keluarga', $registration->kartu_keluarga], ['Ijazah / SKL', $registration->ijazah], ['Akte Kelahiran', $registration->akte_kelahiran]] as $doc)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 group hover:border-primary-200 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary-500 shadow-sm group-hover:bg-primary-500 group-hover:text-white transition-all">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                        <span class="text-xs font-bold text-dark-700">{{ $doc[0] }}</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $doc[1]) }}" target="_blank"
                                        class="text-xs font-black uppercase tracking-widest text-primary-600 hover:text-primary-700">Lihat</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Alert Bantuan -->
                    <div class="p-6 bg-blue-50 rounded-[2rem] border border-blue-100 flex items-start gap-4">
                        <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Data ini bersifat permanen. Jika terdapat kesalahan input, silakan hubungi <strong>Sekretariat
                                PPDB</strong> melalui WhatsApp.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
