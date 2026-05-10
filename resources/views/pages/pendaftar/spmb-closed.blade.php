@extends('layouts.app')

@section('title', 'Pendaftaran Ditutup - ' . $settings->get('school_name'))

@section('content')
    <!-- Hero Background Header -->
    <section class="relative pt-32 pb-20 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('assets/images/pattern-dots.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <h1 class="font-display text-4xl font-extrabold text-white mb-4 tracking-tight">
                Penerimaan Siswa Baru
            </h1>
            <div class="h-1 w-20 bg-primary-500 mx-auto rounded-full"></div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="fade-up max-w-3xl mx-auto">
                <div
                    class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-gray-200/50 text-center border border-gray-100 relative overflow-hidden">

                    <!-- Decorative Element -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-bl-[5rem] -mr-10 -mt-10"></div>

                    <!-- Icon with Soft Glow -->
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-amber-50 rounded-[2rem] flex items-center justify-center mx-auto mb-10 transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                            <i class="fa-solid fa-calendar-circle-exclamation text-amber-500 text-4xl"></i>
                        </div>
                    </div>

                    <!-- Heading & Text -->
                    <h2 class="font-display text-3xl md:text-4xl font-black text-dark-900 tracking-tight mb-6">
                        Pendaftaran Belum <span class="text-amber-500">Tersedia</span>
                    </h2>

                    <div class="text-dark-500 leading-relaxed max-w-xl mx-auto mb-12 space-y-4">
                        <p class="font-medium">
                            Terima kasih atas antusiasme Anda terhadap {{ $settings->get('school_name') }}.
                        </p>
                        <p class="text-sm">
                            Saat ini sistem pendaftaran online (SPMB) sedang dalam masa pemeliharaan atau periode
                            pendaftaran gelombang ini telah berakhir. Kami sedang mempersiapkan gelombang pendaftaran
                            selanjutnya untuk Anda.
                        </p>
                    </div>

                    <!-- Information Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12 text-left">
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <h4 class="text-xs font-black uppercase tracking-widest text-primary-600 mb-2">Pantau Informasi
                            </h4>
                            <p class="text-xs text-dark-400 leading-relaxed">Ikuti media sosial kami untuk mendapatkan
                                notifikasi jadwal pembukaan pendaftaran terbaru.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <h4 class="text-xs font-black uppercase tracking-widest text-primary-600 mb-2">Layanan Bantuan
                            </h4>
                            <p class="text-xs text-dark-400 leading-relaxed">Ada pertanyaan mendesak? Hubungi panitia
                                melalui layanan pesan instan kami.</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center justify-center gap-3 px-10 py-4 bg-dark-900 text-white font-bold rounded-2xl hover:bg-dark-800 transition-all active:scale-95 shadow-xl shadow-dark-900/20 uppercase tracking-widest text-xs">
                            <i class="fa-solid fa-house-chimney"></i>
                            Beranda
                        </a>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center gap-3 px-10 py-4 bg-white border-2 border-gray-100 text-dark-900 font-bold rounded-2xl hover:bg-gray-50 hover:border-gray-200 transition-all active:scale-95 uppercase tracking-widest text-xs">
                            <i class="fa-solid fa-paper-plane"></i>
                            Hubungi Panitia
                        </a>
                    </div>
                </div>

                <!-- Secondary Info -->
                <p class="text-center mt-12 text-dark-400 text-sm italic">
                    Copyright &copy; {{ date('Y') }} Panitia PPDB {{ $settings->get('school_name') }}
                </p>
            </div>
        </div>
    </section>
@endsection
