@extends('layouts.app')

@section('title', 'Ujian Masuk Online - SMP Tunas Harapan')

@section('content')
    <section class="min-h-screen bg-gray-50 pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <div class="fade-up">
                <h1 class="font-display text-3xl font-black text-dark-900 mb-2">Computer Based Test (CBT)</h1>
                <p class="text-dark-500 mb-10">Seleksi Akademik Calon Siswa Baru TA 2026/2027</p>

                <div class="grid md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary-500 mb-2">Durasi</p>
                        <p class="font-bold text-dark-900">60 Menit</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary-500 mb-2">Jumlah Soal</p>
                        <p class="font-bold text-dark-900">{{ $countQuestions }} Soal</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary-500 mb-2">Mata Uji</p>
                        <p class="font-bold text-dark-900">Matematika, IPA, B. Indo</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-sm mb-10">
                    <h3 class="font-display font-bold text-lg text-dark-900 mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-amber-500"></i> Instruksi Penting
                    </h3>
                    <ul class="space-y-4 text-dark-600 text-sm leading-relaxed">
                        <li class="flex gap-4">
                            <span
                                class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">1</span>
                            Pastikan koneksi internet Anda stabil sebelum menekan tombol mulai.
                        </li>
                        <li class="flex gap-4">
                            <span
                                class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">2</span>
                            Dilarang membuka tab baru atau aplikasi lain selama ujian berlangsung.
                        </li>
                        <li class="flex gap-4">
                            <span
                                class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">3</span>
                            Sistem akan mengunci jawaban secara otomatis jika durasi waktu habis.
                        </li>
                    </ul>
                </div>

                <div class="flex items-center justify-center">
                    <a href="{{ route('pendaftar.ujian.start') }}"
                        class="px-12 py-5 bg-primary-500 text-white font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-primary-600 transition-all shadow-xl shadow-primary-500/25 active:scale-95">
                        Mulai Ujian Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
