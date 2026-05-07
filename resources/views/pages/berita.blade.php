@extends('layouts.app')
@section('title', 'Berita & Artikel - SMP Tunas Harapan Bekasi')

@section('content')
    <!-- Hero -->
    <section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0"><img src="https://picsum.photos/seed/berita-hero/1920/600" alt=""
                class="w-full h-full object-cover opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <span
                class="inline-block px-4 py-1.5 bg-primary-400/10 text-primary-400 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Informasi</span>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Berita & Artikel</h1>
            <p class="text-dark-300">Beranda > <span class="text-primary-400">Berita</span></p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if ($posts->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 group transition-all duration-300">
                            <div class="aspect-[16/10] overflow-hidden relative">
                                <!-- Category Badge -->
                                @if ($post->category)
                                    <span
                                        class="absolute top-4 left-4 z-10 px-3 py-1 bg-primary-500 text-white text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-md">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

                                <img src="{{ $post->image ? Storage::url($post->image) : 'https://picsum.photos/seed/news-' . $post->id . '/600/375' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                    <span><i
                                            class="far fa-calendar mr-1"></i>{{ $post->created_at->format('d M Y') }}</span>
                                    <span><i class="far fa-clock mr-1"></i>{{ $post->reading_time }} mnt baca</span>
                                </div>
                                <h3
                                    class="font-display font-bold text-xl text-dark-900 mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                                    <a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">{{ $post->excerpt }}</p>
                                <a href="{{ route('berita.detail', $post->slug) }}"
                                    class="inline-flex items-center gap-2 text-sm text-primary-500 font-bold hover:gap-3 transition-all">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-12 flex justify-center">{{ $posts->links() }}</div>
            @else
                <div class="text-center py-20 text-gray-400">
                    <i class="far fa-newspaper text-6xl mb-4"></i>
                    <p>Belum ada berita yang dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
