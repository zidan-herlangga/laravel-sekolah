@extends('layouts.app')

@section('title', $settings->get('school_name'))

@section('content')

    <!-- ==================== HERO SECTION ==================== -->
    <section class="relative min-h-screen flex items-center overflow-hidden bg-dark-900">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt=""
                class="w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-900 via-dark-900/50 to-dark-900/60"></div>
            {{-- <div class="absolute inset-0 hero-pattern"></div> --}}
        </div>

        <!-- Floating Decorations -->
        <div class="absolute top-20 right-20 w-72 h-72 bg-primary-400/10 rounded-full blur-3xl float-anim"></div>
        <div class="absolute bottom-20 left-10 w-56 h-56 bg-primary-500/10 rounded-full blur-3xl float-anim"
            style="animation-delay:1.5s"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-32 pb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary-400/10 border border-primary-400/20 rounded-full mb-6">
                        <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                        <span
                            class="text-primary-300 text-xs font-semibold uppercase tracking-widest">{{ $settings->get('school_name') }}</span>
                    </div>

                    <h1
                        class="font-display text-5xl sm:text-5xl lg:text-5xl xl:text-6xl font-extrabold text-white leading-[1.05] tracking-tight mb-6">
                        SMP
                        <span
                            class="block text-transparent bg-clip-text bg-gradient-to-r from-primary-300 via-primary-400 to-primary-500">Berbasis
                            Karakter & </span> Kreativitas Digital
                    </h1>

                    <p class="text-lg text-dark-300 leading-relaxed max-w-lg mb-8">
                        {{ $settings->get('school_motto') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('spmb') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 hover:shadow-2xl hover:shadow-primary-400/30 transition-all duration-300 group">
                            Daftar Sekarang
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 border border-dark-600 text-white font-semibold rounded-xl hover:bg-white/5 hover:border-dark-500 transition-all duration-300">
                            <i class="fas fa-play-circle"></i>
                            Tentang Kami
                        </a>
                    </div>

                    <!-- Mini Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-dark-700/50">
                        <div>
                            <div class="font-display text-3xl font-bold text-white">600<span
                                    class="text-primary-400">+</span></div>
                            <div class="text-sm text-dark-400 mt-1">Siswa Aktif</div>
                        </div>
                        <div>
                            <div class="font-display text-3xl font-bold text-white">98<span
                                    class="text-primary-400">%</span></div>
                            <div class="text-sm text-dark-400 mt-1">Kelulusan</div>
                        </div>
                        <div>
                            <div class="font-display text-3xl font-bold text-white">20<span
                                    class="text-primary-400">+</span></div>
                            <div class="text-sm text-dark-400 mt-1">Pengajar</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                {{-- <div class="hidden lg:block relative">
                <div class="relative">
                    <img src="https://picsum.photos/seed/students-happy/600/700" alt="Siswa Sekolah" class="rounded-3xl shadow-2xl shadow-black/30 object-cover w-full max-w-md mx-auto">
                    <!-- Decorative badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-4 shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-trophy text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="font-display font-bold text-dark-900">A Accredited</div>
                                <div class="text-xs text-dark-500">BSNP & AIJ 2024</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-primary-400 rounded-2xl p-4 shadow-xl">
                        <div class="text-center">
                            <div class="font-display font-bold text-white text-2xl">25</div>
                            <div class="text-xs text-primary-100">Tahun</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
            <span class="text-xs text-dark-400 uppercase tracking-widest">Scroll</span>
            <div class="w-6 h-10 border-2 border-dark-600 rounded-full flex justify-center pt-2">
                <div class="w-1.5 h-3 bg-primary-400 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- ==================== PROGRAM UNGGULAN ==================== -->
    <section class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Program
                    Kami</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-4">Program Unggulan
                </h2>
                <p class="text-dark-500 max-w-2xl mx-auto">Kurikulum terintegrasi yang memadukan keunggulan akademis,
                    keislaman, dan pengembangan karakter.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($programs as $program)
                    <div class="fade-up bg-white rounded-2xl p-8 card-hover border border-gray-100 group">
                        <div
                            class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-primary-400 transition-colors duration-300">
                            <i
                                class="{{ $program->icon ?? 'fas fa-star' }} text-xl text-primary-500 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="font-display text-lg font-bold text-dark-900 mb-3">{{ $program->title }}</h3>
                        <p class="text-sm text-dark-500 leading-relaxed">{{ Str::limit($program->description, 120) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== PROFIL SINGKAT ==================== -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="fade-up relative">
                    <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt="Gedung Sekolah"
                        class="rounded-3xl shadow-xl w-full object-cover">
                    <div class="absolute -bottom-6 -right-6 bg-primary-400 text-white rounded-2xl p-6 shadow-xl">
                        <div class="font-display text-4xl font-bold">38+</div>
                        <div class="text-sm text-primary-100">Tahun Melayani</div>
                    </div>
                </div>

                <div class="fade-up">
                    <span
                        class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Tentang
                        SMP Tunas Harapan Bekasi</span>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-6">Profil Singkat
                        Sekolah</h2>
                    <p class="text-dark-500 leading-relaxed mb-6">
                        SMP Tunas Harapan Bekasi didirikan pada tahun 1980, dengan komitmen untuk menyediakan pendidikan
                        bermutu bagi generasi masa depan. Sejak berdiri, sekolah telah berhasil mencetak banyak prestasi
                        dalam bidang akademik, olahraga, dan seni budaya.
                    </p>

                    {{-- <p class="text-dark-500 leading-relaxed mb-8">
                    Dengan menggabungkan kurikulum nasional, pendidikan karakter islami, dan program internasional, kami berkomitmen membentuk peserta didik yang cerdas, berakhlak mulia, dan siap menghadapi tantangan global.
                </p> --}}

                    {{-- <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fas fa-check text-emerald-600"></i></div>
                        <span class="text-sm font-medium text-dark-800">Kurikulum Merdeka</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fas fa-check text-emerald-600"></i></div>
                        <span class="text-sm font-medium text-dark-800">Akreditasi A</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fas fa-check text-emerald-600"></i></div>
                        <span class="text-sm font-medium text-dark-800">Fasilitas Modern</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fas fa-check text-emerald-600"></i></div>
                        <span class="text-sm font-medium text-dark-800">Guru Berpengalaman</span>
                    </div>
                </div> --}}

                    <a href="{{ route('about') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-dark-900 text-white font-semibold rounded-xl hover:bg-dark-800 transition-colors group">
                        Selengkapnya <i
                            class="fas fa-arrow-right group-hover:translate-x-1 transition-transform text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FASILITAS ==================== -->
    <section class="py-24 bg-dark-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-primary-400/10 text-primary-400 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Fasilitas</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-white tracking-tight mb-4">Fasilitas Unggulan
                </h2>
                <p class="text-dark-400 max-w-2xl mx-auto">Fasilitas modern dan lengkap untuk mendukung proses belajar
                    mengajar yang efektif dan nyaman.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ([['Ruang Kelas', 'fas fa-school', 'class-room'], ['Ruang OSIS', 'fas fa-book', 'library'], ['Kantin', 'fas fa-solid fa-bowl-food', 'canteen'], ['Lapangan Olahraga', 'fas fa-futbol', 'sports-field'], ['Ruang UKS', 'fas fa-solid fa-stethoscope', 'health-center'], ['LAB Komputer', 'fas fa-laptop', 'computer-lab']] as $item)
                    <div class="fade-up group relative overflow-hidden rounded-2xl aspect-[3/4] cursor-pointer">
                        <img src="https://picsum.photos/seed/{{ $item[2] }}/400/533" alt="{{ $item[0] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="w-10 h-10 bg-primary-400/20 rounded-lg flex items-center justify-center mb-3">
                                <i class="{{ $item[1] }} text-primary-400"></i>
                            </div>
                            <h3 class="font-display font-bold text-white text-lg">{{ $item[0] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== SAMBUTAN KEPALA SEKOLAH ==================== -->
    <section class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-12 items-center">
                <div class="lg:col-span-2 fade-up flex justify-center">
                    <div class="relative">
                        <img src="{{ asset('kepala-sekolah.jpeg') }}"
                            alt="{{ $teacher->name ?? 'Dra.Hj. Neneng Yeti.D, M.Pd' }}"
                            class="rounded-3xl shadow-xl w-72 h-80 object-cover">
                        <div
                            class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-xl px-6 py-3 shadow-lg whitespace-nowrap">
                            <span
                                class="font-display font-bold text-dark-900 text-sm">{{ $teacher->name ?? 'Dra.Hj. Neneng Yeti.D, M.Pd' }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 fade-up">
                    <span
                        class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Sambutan</span>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-6">Sambutan
                        Kepala Sekolah</h2>
                    <div class="relative pl-6 border-l-4 border-primary-400">
                        <div class="text-dark-600 leading-relaxed italic text-lg mb-4">
                            {!! $settings->get('headmaster_welcome', '#') !!}
                        </div>
                    </div>
                    <p class="text-dark-500 leading-relaxed mt-4">
                        Kami berharap website ini dapat menjadi jembatan komunikasi yang efektif antara sekolah, orang tua,
                        dan masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== GALERI ==================== -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Galeri</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-4">Galeri Kegiatan
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($galleries as $index => $gallery)
                    <div
                        class="fade-up overflow-hidden rounded-2xl {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }} aspect-square group cursor-pointer">
                        <img src="storage/{{ $gallery->image }}" alt="{{ $gallery->title ?? 'Galeri' }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            loading="lazy">
                        <div
                            class="absolute inset-0 bg-dark-900/0 group-hover:bg-dark-900/40 transition-colors duration-300 flex items-end">
                            @if ($gallery->title)
                                <span
                                    class="text-white font-medium text-sm p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">{{ $gallery->title }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== BERITA TERBARU ==================== -->
    <section class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 fade-up">
                <div>
                    <span
                        class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Berita</span>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight">Berita Terbaru
                    </h2>
                </div>
                <a href="{{ route('berita') }}"
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                    Lihat Semua <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform text-sm"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="fade-up bg-white rounded-2xl overflow-hidden card-hover border border-gray-100 group">
                        <div class="aspect-[16/10] overflow-hidden">
                            <img src="{{ 'storage/' . $post->image ?? 'https://picsum.photos/seed/news-' . $post->id . '/600/375' }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 text-xs text-dark-400 mb-3">
                                <span><i class="far fa-calendar mr-1"></i>{{ $post->created_at->format('d M Y') }}</span>
                                <span><i class="far fa-clock mr-1"></i>{{ $post->reading_time }} menit</span>
                            </div>
                            <h3
                                class="font-display font-bold text-dark-900 mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                                <a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-dark-500 leading-relaxed line-clamp-2">{{ $post->excerpt }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== CTA SPMB ==================== -->
    <section class="py-24 bg-dark-900 relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-500/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 lg:px-8 text-center fade-up">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-400/10 border border-primary-400/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                <span class="text-primary-300 text-xs font-semibold uppercase tracking-widest">Pendaftaran Dibuka</span>
            </div>

            <h2 class="font-display text-3xl md:text-5xl font-bold text-white tracking-tight mb-6">Siap Bergabung Bersama
                Kami?</h2>
            <div class="text-lg text-dark-300 max-w-2xl mx-auto mb-10">
                {!! $settings->get(
                    'spmb_info',
                    'Pendaftaran peserta didik baru telah dibuka. Segera daftarkan putra-putri Anda!',
                ) !!}
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('spmb') }}"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 hover:shadow-2xl hover:shadow-primary-400/30 transition-all duration-300 group text-lg">
                    Daftar Sekarang
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="https://wa.me/{{ $settings->get('school_phone', '#') }}"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 border border-dark-600 text-white font-semibold rounded-xl hover:bg-white/5 transition-all duration-300 text-lg"
                    target="_blank">
                    <i class="fas fa-phone-alt"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

@endsection
