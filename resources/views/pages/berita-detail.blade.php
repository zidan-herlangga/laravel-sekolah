@extends('layouts.app')

@section('title', $post->title . ' - Sekolah Unggulan Indonesia')
@section('meta_description', $post->excerpt)

@section('content')

<style>
    .berita-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #334155;
    }
    .berita-content h1 { font-size: 2rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; color: #0f172a; font-family: 'Plus Jakarta Sans', sans-serif; }
    .berita-content h2 { font-size: 1.6rem; font-weight: 700; margin-top: 1.8rem; margin-bottom: 0.8rem; color: #0f172a; font-family: 'Plus Jakarta Sans', sans-serif; }
    .berita-content h3 { font-size: 1.35rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.6rem; color: #1e293b; font-family: 'Plus Jakarta Sans', sans-serif; }
    .berita-content h4 { font-size: 1.15rem; font-weight: 600; margin-top: 1.2rem; margin-bottom: 0.5rem; color: #1e293b; }
    .berita-content p { margin-bottom: 1rem; }
    .berita-content ul, .berita-content ol { margin-bottom: 1rem; padding-left: 1.8rem; }
    .berita-content li { margin-bottom: 0.4rem; }
    .berita-content ul li { list-style-type: disc; }
    .berita-content ol li { list-style-type: decimal; }
    .berita-content strong, .berita-content b { font-weight: 700; color: #0f172a; }
    .berita-content em, .berita-content i { font-style: italic; }
    .berita-content a { color: #d97706; text-decoration: underline; }
    .berita-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 1.5rem 0; }
    .berita-content blockquote { border-left: 4px solid #d97706; padding-left: 1rem; margin: 1.5rem 0; color: #64748b; font-style: italic; }
    .berita-content table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; }
    .berita-content th, .berita-content td { border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left; }
    .berita-content th { background-color: #f8fafc; font-weight: 600; }
</style>

<!-- Hero -->
<section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $post->image ? Storage::url($post->image) : 'https://picsum.photos/seed/news-' . $post->id . '/1920/600' }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-25">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
    <div class="relative max-w-4xl mx-auto px-6 lg:px-8">
        <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 text-dark-300 hover:text-primary-400 text-sm mb-6 transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali ke Berita
        </a>
        <div class="flex items-center gap-4 text-sm text-dark-400 mb-4">
            <span><i class="far fa-calendar mr-1"></i>{{ $post->created_at->format('d F Y') }}</span>
            <span><i class="far fa-clock mr-1"></i>{{ $post->reading_time }} menit baca</span>
        </div>
        <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight">{{ $post->title }}</h1>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">

        @if($post->image)
        <!-- FEATURED IMAGE (Gambar Utama Berita) -->
        <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-100">
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover" style="max-height: 450px;">
        </div>
        @endif

        <!-- ISI KONTEN BERITA -->
        <article class="berita-content">
            {!! $post->content !!}
        </article>

        <!-- Related Posts -->
        @if($relatedPosts->count())
        <div class="mt-20 pt-12 border-t border-gray-100">
            <h3 class="font-display text-2xl font-bold text-dark-900 mb-8">Berita Terkait</h3>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <article class="bg-gray-50 rounded-xl overflow-hidden card-hover group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ $related->image ? Storage::url($related->image) : 'https://picsum.photos/seed/news-' . $related->id . '/400/250' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-dark-400">{{ $related->created_at->format('d M Y') }}</span>
                        <h4 class="font-display font-bold text-dark-900 text-sm mt-1 group-hover:text-primary-500 transition-colors line-clamp-2">
                            <a href="{{ route('berita.detail', $related->slug) }}">{{ $related->title }}</a>
                        </h4>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection