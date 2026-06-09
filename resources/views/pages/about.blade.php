@extends('layouts.app')

@section('title', 'Tentang Kami - ' . $settings->get('school_name'))

@section('content')
    <!-- Hero Section Tentang Kami -->
    <section class="relative pt-32 pb-20 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('assets/images/pattern-dots.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 bg-primary-500/10 text-primary-400 text-xs font-bold uppercase tracking-widest rounded-full mb-6 border border-primary-500/20">
                Mengenal Lebih Dekat
            </span>
            <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                Membangun Generasi <span class="text-primary-500">Digital & Berkarakter</span>
            </h1>
            <p class="text-dark-300 max-w-3xl mx-auto text-lg leading-relaxed">
                SMP Tunas Harapan Bekasi bukan sekadar tempat belajar, melainkan ekosistem untuk tumbuh, berinovasi, dan
                membentuk akhlak mulia di era digital.
            </p>
        </div>
    </section>

    <!-- Statistik Singkat -->
    <section class="relative -mt-12 z-20">
        <div class="max-w-5xl mx-auto px-6">
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 bg-white rounded-3xl shadow-2xl shadow-primary-900/10 p-8 border border-gray-100">
                <div class="text-center">
                    <p class="font-display text-3xl font-black text-primary-600">500+</p>
                    <p class="text-xs text-dark-400 font-bold uppercase mt-1">Siswa Aktif</p>
                </div>
                <div class="text-center md:border-l border-gray-100">
                    <p class="font-display text-3xl font-black text-primary-600">30+</p>
                    <p class="text-xs text-dark-400 font-bold uppercase mt-1">Guru Ahli</p>
                </div>
                <div class="text-center md:border-l border-gray-100">
                    <p class="font-display text-3xl font-black text-primary-600">15+</p>
                    <p class="text-xs text-dark-400 font-bold uppercase mt-1">Ekstrakurikuler</p>
                </div>
                <div class="text-center md:border-l border-gray-100">
                    <p class="font-display text-3xl font-black text-primary-600">100%</p>
                    <p class="text-xs text-dark-400 font-bold uppercase mt-1">Akreditasi A</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-32">
                <div class="fade-up relative">
                    <div
                        class="absolute -top-6 -left-6 w-32 h-32 bg-primary-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-32 h-32 bg-blue-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000">
                    </div>
                    <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt="Gedung Sekolah"
                        class="relative rounded-[2.5rem] shadow-2xl w-full h-[450px] object-cover">
                    <div
                        class="absolute -bottom-8 -left-8 bg-white p-6 rounded-3xl shadow-xl hidden md:block border border-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white">
                                <i class="fas fa-award text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-dark-400 font-bold uppercase tracking-widest">Berdiri Sejak</p>
                                <p class="font-display font-black text-dark-900 text-xl">2010</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fade-up">
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-8">
                        Mempersiapkan Pemimpin Masa Depan Sejak <span
                            class="text-primary-500 underline decoration-primary-200 underline-offset-8">Dini</span>
                    </h2>
                    <div class="space-y-6 text-dark-500 text-lg leading-relaxed">
                        <p>
                            SMP Tunas Harapan Bekasi didirikan dengan komitmen kuat untuk menjadi oase pendidikan yang
                            menggabungkan ketajaman intelektual dengan keluhuran akhlak.
                        </p>
                        <p>
                            Kami memahami bahwa era digital menuntut lebih dari sekadar nilai akademis. Oleh karena itu,
                            kurikulum kami dirancang untuk memicu kreativitas, kemampuan berpikir kritis, dan literasi
                            teknologi tanpa meninggalkan akar budaya dan nilai religius.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Visi Misi Section -->
            <div class="grid md:grid-cols-2 gap-8 mb-32">
                <div
                    class="fade-up group p-1 bg-gradient-to-br from-primary-400 to-blue-600 rounded-[2.5rem] transition-all hover:scale-[1.02]">
                    <div class="bg-white rounded-[2.3rem] p-10 h-full">
                        <div
                            class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mb-8 group-hover:rotate-6 transition-transform">
                            <i class="fas fa-eye text-3xl text-primary-500"></i>
                        </div>
                        <h3 class="font-display text-3xl font-bold text-dark-900 mb-6">Visi Kami</h3>
                        <p class="text-dark-500 text-xl leading-relaxed italic font-medium">
                            "Menjadi sekolah unggul dalam melahirkan generasi yang berakhlak mulia, cerdas, berkarakter, dan
                            berdaya saing global."
                        </p>
                    </div>
                </div>
                <div
                    class="fade-up group p-1 bg-gradient-to-br from-dark-800 to-dark-950 rounded-[2.5rem] transition-all hover:scale-[1.02]">
                    <div class="bg-dark-900 rounded-[2.3rem] p-10 h-full">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-8 group-hover:rotate-6 transition-transform">
                            <i class="fas fa-bullseye text-3xl text-primary-400"></i>
                        </div>
                        <h3 class="font-display text-3xl font-bold text-white mb-6">Misi Kami</h3>
                        <ul class="space-y-4">
                            @foreach (['Meningkatkan mutu pendidikan secara berkelanjutan.', 'Adaptif terhadap Iptek dan Kebudayaan global.', 'Membina akhlakul karimah dan budi pekerti luhur.', 'Membentuk karakter pribadi yang hebat dan tangguh.'] as $misi)
                                <li class="flex items-start gap-4">
                                    <div
                                        class="mt-1.5 w-5 h-5 rounded-full bg-primary-500/20 flex items-center justify-center flex-shrink-0">
                                        <div class="w-2 h-2 rounded-full bg-primary-400"></div>
                                    </div>
                                    <span class="text-dark-300 font-medium">{{ $misi }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tim Pengajar Section -->
            <div class="fade-up">
                <div class="text-center mb-20">
                    <h2 class="font-display text-4xl font-bold text-dark-900 mb-4 tracking-tight">Pilar Pendidikan Kami</h2>
                    <p class="text-dark-500 max-w-2xl mx-auto text-lg italic">
                        "Guru yang baik menginspirasi, guru yang hebat membimbing selamanya."
                    </p>
                </div>

                @if ($teachers->isNotEmpty())
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-20">
                        @foreach ($teachers as $teacher)
                            <div
                                class="fade-up group bg-white rounded-[2rem] p-8 card-hover border border-gray-100 text-center">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div
                                        class="absolute inset-0 bg-primary-500 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-500">
                                    </div>
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}"
                                        class="relative w-full h-full object-cover rounded-3xl shadow-lg">
                                </div>
                                <h3 class="font-display font-bold text-dark-900 text-xl mb-1">{{ $teacher->name }}</h3>
                                <p class="text-sm text-primary-600 font-bold uppercase tracking-widest mb-4">
                                    {{ $teacher->position }}</p>
                                @if ($teacher->bio)
                                    <p class="text-dark-400 text-sm leading-relaxed italic line-clamp-3">
                                        "{{ $teacher->bio }}"</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($staff->isNotEmpty())
                    <div class="bg-gray-50 rounded-[3rem] p-12">
                        <h3 class="font-display text-2xl font-bold text-dark-900 mb-10 text-center">Staf Administrasi &
                            Pendukung</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                            @foreach ($staff as $s)
                                <div class="text-center group">
                                    <div
                                        class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-md group-hover:scale-110 transition-transform">
                                        <img src="{{ asset('storage/' . $s->photo) }}" alt="{{ $s->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <h4 class="font-bold text-dark-900 text-sm">{{ $s->name }}</h4>
                                    <p class="text-xs text-primary-500 font-bold uppercase">{{ $s->position }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
