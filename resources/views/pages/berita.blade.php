@extends('layouts.app')
@section('title', 'Berita & Artikel - SMP Tunas Harapan Bekasi')

@section('content')
    <!-- Hero Section Berita -->
    <section class="relative pt-32 pb-20 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('assets/images/pattern-news.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <span
                    class="inline-block px-4 py-1.5 bg-primary-500/10 text-primary-400 text-xs font-bold uppercase tracking-widest rounded-full mb-6 border border-primary-500/20">
                    Update Terkini
                </span>
                <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                    Berita & <span class="text-primary-500">Artikel Sekolah</span>
                </h1>
                <p class="text-dark-300 max-w-2xl mx-auto text-lg leading-relaxed">
                    Ikuti perkembangan terbaru, prestasi siswa, dan informasi penting lainnya dari lingkungan SMP Tunas
                    Harapan Bekasi.
                </p>
            </div>
        </div>
    </section>

    <!-- News Filter & Grid -->
    <section class="py-20 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            @if ($posts->count())
                <!-- News Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($posts as $post)
                        <article
                            class="fade-up flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                            <!-- Image Header -->
                            <div class="aspect-[16/10] overflow-hidden relative">
                                <!-- Category Badge -->
                                @if ($post->category)
                                    <div class="absolute top-5 left-5 z-20">
                                        <span
                                            class="px-4 py-1.5 bg-white/90 backdrop-blur text-primary-600 text-[10px] font-black uppercase tracking-widest rounded-xl shadow-sm">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Hover Overlay -->
                                <div
                                    class="absolute inset-0 bg-primary-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                                </div>

                                <img src="{{ $post->image ? Storage::url($post->image) : 'https://picsum.photos/seed/news-' . $post->id . '/600/375' }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>

                            <!-- Content -->
                            <div class="p-8 flex flex-col flex-1">
                                <div
                                    class="flex items-center gap-4 text-xs font-bold text-gray-400 mb-4 uppercase tracking-widest">
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-calendar text-primary-500"></i>
                                        {{ $post->created_at->format('d M, Y') }}
                                    </span>
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-clock text-primary-500"></i> {{ $post->reading_time ?? '5' }} Menit
                                    </span>
                                </div>

                                <h3
                                    class="font-display font-bold text-xl text-dark-900 mb-4 group-hover:text-primary-500 transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-8">
                                    {{ $post->excerpt }}
                                </p>

                                <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                    <a href="{{ route('berita.detail', $post->slug) }}"
                                        class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-primary-600 hover:gap-4 transition-all">
                                        Selengkapnya <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                    <div class="flex -space-x-2">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center text-[10px] font-bold text-gray-500 uppercase">
                                            TH</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-20 flex justify-center">
                    <nav class="inline-flex bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                        {{ $posts->links('pagination::tailwind') }}
                    </nav>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-32 bg-white rounded-[3rem] border border-dashed border-gray-200">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="far fa-newspaper text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-dark-900 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-400">Kami sedang menyiapkan konten menarik untuk Anda.</p>
                </div>
            @endif

        </div>
    </section>

    <!-- CTA Section -->
    <section class="pb-24 bg-gray-50/50 px-6">
        <div
            class="max-w-5xl mx-auto bg-primary-600 rounded-[3rem] p-8 md:p-16 text-center relative overflow-hidden shadow-2xl shadow-primary-500/20">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mt-32 blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-6">Ingin Berlangganan Berita?</h2>
                <p class="text-primary-100 mb-10 max-w-xl mx-auto">Dapatkan update prestasi dan kegiatan sekolah langsung ke
                    email Anda setiap bulan.</p>
                <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                    <input type="email" placeholder="Masukkan alamat email"
                        class="flex-1 px-6 py-4 rounded-2xl bg-white/10 border border-white/20 text-white placeholder:text-white/60 focus:outline-none focus:bg-white focus:text-dark-900 transition-all">
                    <button
                        class="px-8 py-4 bg-white text-primary-600 font-bold rounded-2xl hover:bg-primary-50 transition-all">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
@endsection
