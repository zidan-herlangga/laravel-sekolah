@extends('layouts.app')

@section('title', 'Tentang Kami - Sekolah Unggulan Indonesia')

@section('content')

<!-- Hero -->
<section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
    <div class="absolute inset-0"><img src="https://picsum.photos/seed/about-hero/1920/600" alt="" class="w-full h-full object-cover opacity-30"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 bg-primary-400/10 text-primary-400 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Tentang Kami</span>
        <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Profil Sekolah</h1>
        <p class="text-dark-300 max-w-2xl mx-auto">Beranda > <a href="{{ route('about') }}" class="text-primary-400 hover:text-primary-500">Tentang Kami</a></p>
    </div>
</section>

<!-- Profil -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
            <div class="fade-up">
                <img src="{{asset('assets/images/gedung-sekolah.jpeg')}}" alt="Profil Sekolah" class="rounded-3xl shadow-xl w-full object-cover">
            </div>
            <div class="fade-up">
                <h2 class="font-display text-3xl font-bold text-dark-900 tracking-tight mb-6">Profile SMP Tunas Harapan Bekasi</h2>
                <p class="text-dark-500 leading-relaxed mb-4">Selamat datang di SMP Tunas Harapan Bekasi.SMP Tunas Harapan Bekasi didirikan dengan visi untuk menyediakan pendidikan berkualitas tinggi yang mempersiapkan siswa untuk menghadapi tantangan masa depan. Kami percaya bahwa setiap anak memiliki potensi luar biasa yang perlu dikembangkan melalui pendidikan yang komprehensif dan inovatif.</p>
                
            </div>
        </div>

        <!-- Visi Misi -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            <div class="fade-up bg-gradient-to-br from-primary-400 to-primary-600 rounded-3xl p-10 text-white">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
                <h3 class="font-display text-2xl font-bold mb-4">Visi</h3>
                <p class="text-primary-50 leading-relaxed text-lg italic">"Menjadi lembaga pendidikan terdepan yang melahirkan generasi berilmu, berkarakter islami, berwawasan global, dan berjiwa kepemimpinan."</p>
            </div>
            <div class="fade-up bg-dark-900 rounded-3xl p-10 text-white">
                <div class="w-14 h-14 bg-primary-400/20 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-2xl text-primary-400"></i>
                </div>
                <h3 class="font-display text-2xl font-bold mb-4">Misi</h3>
                <ul class="space-y-3 text-dark-300">
                    <li class="flex items-start gap-3"><i class="fas fa-check-circle text-primary-400 mt-1 text-sm"></i><span>Menyelenggarakan pendidikan berkualitas berbasis kurikulum terkini</span></li>
                    <li class="flex items-start gap-3"><i class="fas fa-check-circle text-primary-400 mt-1 text-sm"></i><span>Membangun karakter islami melalui pembiasaan dan pembelajaran tahfidz</span></li>
                    <li class="flex items-start gap-3"><i class="fas fa-check-circle text-primary-400 mt-1 text-sm"></i><span>Mengembangkan kemampuan berpikir kritis, kreatif, dan inovatif</span></li>
                    <li class="flex items-start gap-3"><i class="fas fa-check-circle text-primary-400 mt-1 text-sm"></i><span>Mempersiapkan siswa menghadapi tantangan global dengan program bilingual</span></li>
                    <li class="flex items-start gap-3"><i class="fas fa-check-circle text-primary-400 mt-1 text-sm"></i><span>Menjalin kemitraan strategis dengan institusi pendidikan nasional dan internasional</span></li>
                </ul>
            </div>
        </div>

        <!-- Struktur Guru & Staff -->
        <div class="fade-up">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Tim Kami</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-dark-900 tracking-tight mb-4">Guru & Staf Pengajar</h2>
                <p class="text-dark-500 max-w-2xl mx-auto">Tenaga pengajar profesional dan berdedikasi tinggi yang siap membimbing putra-putri Anda.</p>
            </div>

            @if($teachers->isNotEmpty())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($teachers as $teacher)
                <div class="bg-white rounded-2xl p-6 card-hover border border-gray-100 text-center group">
                    <div class="w-24 h-24 mx-auto rounded-2xl overflow-hidden mb-4 bg-gray-100">
                        <img src="{{'storage/' . $teacher->photo ?? 'https://picsum.photos/seed/teacher-' . $teacher->id . '/200/200' }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-display font-bold text-dark-900 mb-1">{{ $teacher->name }}</h3>
                    <p class="text-sm text-primary-500 font-medium mb-2">{{ $teacher->position }}</p>
                    @if($teacher->bio)
                    <p class="text-xs text-dark-400 leading-relaxed">{{ Str::limit($teacher->bio, 80) }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            @if($staff->isNotEmpty())
            <h3 class="font-display text-xl font-bold text-dark-900 mb-6 text-center">Staf & Administrasi</h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($staff as $s)
                <div class="bg-gray-50 rounded-xl p-5 text-center group hover:bg-white hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 mx-auto rounded-xl overflow-hidden mb-3 bg-gray-200">
                        <img src="{{'storage/' . $s->photo ?? 'https://picsum.photos/seed/staff-' . $s->id . '/200/200' }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-semibold text-dark-900 text-sm">{{ $s->name }}</h4>
                    <p class="text-xs text-dark-400">{{ $s->position }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

@endsection