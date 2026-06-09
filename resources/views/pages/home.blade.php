@extends('layouts.app')

@section('title', 'Beranda - ' . $settings->get('school_name'))

@section('content')

    <!-- ==================== HERO SECTION (REMASTERED) ==================== -->
    <section class="relative min-h-screen flex items-center overflow-hidden bg-dark-900">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt="Gedung SMP Tunas Harapan"
                class="w-full h-full object-cover opacity-30 scale-105" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-900 via-dark-900/40 to-transparent"></div>
        </div>

        <!-- Animated Shapes -->
        <div class="absolute top-1/4 -right-20 w-96 h-96 bg-primary-600/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-blue-600/10 rounded-full blur-[100px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 pt-20">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="fade-up">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full mb-8 backdrop-blur-sm">
                        <span class="flex h-2 w-2 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                        </span>
                        <span class="text-white/80 text-[10px] font-black uppercase tracking-[0.2em]">Penerimaan Siswa Baru
                            2026</span>
                    </div>

                    <h1
                        class="font-display text-4xl sm:text-5xl md:text-7xl font-extrabold text-white leading-[1.1] tracking-tighter mb-8">
                        Masa Depan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-blue-400">Dimulai di
                            Sini.</span>
                    </h1>

                    <p class="text-lg text-dark-300 leading-relaxed max-w-lg mb-10 font-medium">
                        {{ $settings->get('school_motto', 'Membentuk generasi cerdas, berkarakter, dan siap menghadapi tantangan kreativitas digital.') }}
                    </p>

                    <div class="flex flex-wrap gap-5">
                        <a href="{{ route('register') }}"
                            class="px-10 py-5 bg-primary-500 text-white font-bold rounded-2xl hover:bg-primary-600 shadow-2xl shadow-primary-500/30 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                            Daftar Sekarang <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                        <a href="{{ route('about') }}"
                            class="px-10 py-5 bg-white/5 text-white font-bold rounded-2xl border border-white/10 hover:bg-white/10 backdrop-blur-md transition-all flex items-center gap-3">
                            Profil Sekolah
                        </a>
                    </div>

                    <!-- Trusted Stats -->
                    <div class="mt-16 flex items-center gap-4 sm:gap-12 flex-wrap">
                        <div>
                            <p class="text-3xl font-display font-black text-white">600+</p>
                            <p class="text-[10px] font-bold text-dark-400 uppercase tracking-widest mt-1">Siswa</p>
                        </div>
                        <div class="h-10 w-px bg-white/10"></div>
                        <div>
                            <p class="text-3xl font-display font-black text-white">30+</p>
                            <p class="text-[10px] font-bold text-dark-400 uppercase tracking-widest mt-1">Ekstrakurikuler
                            </p>
                        </div>
                        <div class="h-10 w-px bg-white/10"></div>
                        <div>
                            <p class="text-3xl font-display font-black text-white">A</p>
                            <p class="text-[10px] font-bold text-dark-400 uppercase tracking-widest mt-1">Akreditasi</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Card Illustration -->
                <div class="hidden lg:block relative fade-up" style="transition-delay: 200ms">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden border-8 border-white/5 shadow-2xl">
                        <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" class="w-full aspect-[4/5] object-cover"
                            alt="">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent"></div>
                        <div
                            class="absolute bottom-10 left-10 right-10 p-8 bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20">
                            <i class="fa-solid fa-quote-left text-primary-400 text-3xl mb-4"></i>
                            <p class="text-white font-medium italic text-lg leading-relaxed">
                                "Pendidikan bukan persiapan untuk hidup; pendidikan adalah hidup itu sendiri."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== PROGRAM UNGGULAN (MODERN GRID) ==================== -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
                <div class="max-w-2xl">
                    <span class="text-xs font-black uppercase tracking-[0.3em] text-primary-500 mb-4 block">Our
                        Excellence</span>
                    <h2 class="font-display text-4xl md:text-5xl font-black text-dark-900 tracking-tight leading-none">
                        Fasilitas & Program <span class="text-gray-300">Unggulan</span>
                    </h2>
                </div>
                <p class="text-dark-500 max-w-sm font-medium">Kami menyediakan ekosistem terbaik untuk perkembangan kognitif
                    dan emosional siswa.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($programs as $program)
                    <div
                        class="group p-10 bg-gray-50 rounded-[2.5rem] hover:bg-primary-600 transition-all duration-500 cursor-default">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:rotate-6 transition-transform">
                            <i class="{{ $program->icon ?? 'fas fa-star' }} text-2xl text-primary-500"></i>
                        </div>
                        <h3
                            class="font-display text-xl font-bold text-dark-900 mb-4 group-hover:text-white transition-colors">
                            {{ $program->title }}</h3>
                        <p class="text-dark-500 leading-relaxed group-hover:text-primary-100 transition-colors">
                            {{ Str::limit($program->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== FASILITAS (INTERACTIVE GRID) ==================== -->
    <section class="py-32 bg-dark-950 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="font-display text-4xl font-black text-white mb-6">Lingkungan Belajar <span
                        class="text-primary-500 italic">Modern</span></h2>
                <p class="text-dark-400 max-w-xl mx-auto">Mendukung kreativitas tanpa batas dengan infrastruktur teknologi
                    terkini.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $facilities = [
                        ['LAB Komputer', 'computer-lab'],
                        ['Perpustakaan Digital', 'library'],
                        ['Studio Kreatif', 'studio'],
                        ['Lapangan Olahraga', 'sports'],
                    ];
                @endphp
                @foreach ($facilities as $index => $f)
                    <div
                        class="group relative aspect-[3/4] rounded-[2rem] overflow-hidden {{ $index % 2 == 1 ? 'md:translate-y-12' : '' }}">
                        <img src="https://picsum.photos/seed/{{ $f[1] }}/600/800"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent opacity-80">
                        </div>
                        <div class="absolute bottom-8 left-8">
                            <p class="text-white font-display font-bold text-xl">{{ $f[0] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== SAMBUTAN (ELEGANT SECTION) ==================== -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-gray-50 rounded-[4rem] p-12 md:p-24 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-12 opacity-5">
                    <i class="fa-solid fa-quote-right text-[15rem]"></i>
                </div>
                <div class="grid lg:grid-cols-2 gap-16 items-center relative z-10">
                    <div class="order-2 lg:order-1">
                        <span class="text-xs font-black uppercase tracking-widest text-primary-500 mb-6 block">Sambutan
                            Kepala Sekolah</span>
                        <h2 class="font-display text-3xl md:text-4xl font-black text-dark-900 mb-8 leading-tight">
                            "Membentuk Karakter, <br>Mengukir Prestasi."
                        </h2>
                        <div class="text-dark-600 text-lg leading-relaxed italic mb-10">
                            {!! $settings->get(
                                'headmaster_welcome',
                                'Selamat datang di SMP Tunas Harapan Bekasi. Kami berkomitmen memberikan layanan pendidikan terbaik dengan mengedepankan nilai-nilai Islami dan kemajuan teknologi.',
                            ) !!}
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-px bg-primary-500"></div>
                            <p class="font-display font-bold text-dark-900">Dra. Hj. Neneng Yeti.D, M.Pd</p>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 flex justify-center">
                        <div class="relative">
                            <div class="absolute -inset-4 bg-primary-500/10 rounded-[3rem] blur-xl"></div>
                            <img src="{{ asset('kepala-sekolah.jpeg') }}"
                                class="relative w-72 h-96 object-cover rounded-[3rem] shadow-2xl" alt="Kepala Sekolah">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== BERITA TERBARU (CLEAN LIST) ==================== -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between mb-16">
                <h2 class="font-display text-4xl font-black text-dark-900">Warta <span
                        class="text-primary-500">Sekolah</span></h2>
                <a href="{{ route('berita') }}"
                    class="font-bold text-sm text-dark-400 hover:text-primary-500 transition-colors uppercase tracking-widest">Semua
                    Berita</a>
            </div>

            <div class="grid md:grid-cols-3 gap-8 md:gap-12">
                @foreach ($posts->take(3) as $post)
                    <article class="group cursor-pointer">
                        <div class="aspect-video rounded-[2rem] overflow-hidden mb-8">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                alt="">
                        </div>
                        <div
                            class="flex items-center gap-4 text-xs font-bold text-dark-400 uppercase tracking-widest mb-4">
                            <span class="text-primary-500">{{ $post->created_at->format('d M Y') }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>{{ $post->reading_time ?? '5' }} Min Read</span>
                        </div>
                        <h3
                            class="font-display text-xl font-bold text-dark-900 leading-snug group-hover:text-primary-500 transition-colors">
                            <a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== CTA FINAL ==================== -->
    <section class="py-20 px-6">
        <div
            class="max-w-7xl mx-auto bg-primary-600 rounded-[4rem] p-10 md:p-16 lg:p-24 text-center relative overflow-hidden shadow-3xl shadow-primary-500/40">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
            </div>
            <div class="relative z-10">
                <h2 class="font-display text-4xl md:text-6xl font-black text-white mb-8 tracking-tighter">
                    Siap Menjadi Bagian <br> dari Kami?
                </h2>
                <p class="text-primary-100 text-lg mb-12 max-w-xl mx-auto font-medium">
                    Jangan lewatkan kesempatan untuk bergabung di lingkungan belajar yang inspiratif dan inovatif.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('register') }}"
                        class="px-12 py-6 bg-white text-primary-600 font-black rounded-2xl hover:bg-primary-50 transition-all shadow-xl active:scale-95 text-lg uppercase tracking-widest">
                        Daftar PPDB
                    </a>
                    <a href="https://wa.me/{{ $settings->get('school_phone') }}"
                        class="px-12 py-6 bg-primary-700 text-white font-black rounded-2xl hover:bg-primary-800 transition-all active:scale-95 text-lg uppercase tracking-widest">
                        Hubungi CS
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
