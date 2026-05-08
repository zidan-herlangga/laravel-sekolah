@extends('layouts.app')

@section('title', $post->title . ' - ' . $settings->get('school_name'))

@section('meta_tags')
    <meta name="description" content="{{ $post->excerpt }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
    <meta property="og:image" content="{{ $post->image ? asset(Storage::url($post->image)) : asset('img/default-og.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
    <!-- Progress Bar Reading -->
    <div id="reading-progress" class="fixed top-0 left-0 h-1 bg-primary-500 z-[100] transition-all duration-150"
        style="width: 0%"></div>

    <!-- Header Section -->
    <header class="pt-32 pb-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary-600 mb-8">
                <a href="{{ route('home') }}" class="hover:text-dark-900 transition-colors">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-gray-300"></i>
                <a href="{{ route('berita') }}" class="hover:text-dark-900 transition-colors">Berita</a>
                @if ($post->category)
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-300"></i>
                    <span class="text-gray-400">{{ $post->category->name }}</span>
                @endif
            </nav>

            <h1 class="font-display text-3xl md:text-5xl font-extrabold text-dark-900 leading-[1.15] mb-8 tracking-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center justify-between gap-6 pb-8 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-user-nib"></i>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-dark-900">Penulis</p>
                        <p class="text-sm text-gray-500">Admin SMP Tunas Harapan</p>
                    </div>
                </div>
                <div class="flex items-center gap-8">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black uppercase tracking-widest text-dark-900">Diterbitkan</p>
                        <p class="text-sm text-gray-500">{{ $post->created_at->format('d M, Y') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="share('facebook')"
                            class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-primary-500 hover:text-white transition-all shadow-sm">
                            <i class="fa-brands fa-facebook-f"></i>
                        </button>
                        <button onclick="share('twitter')"
                            class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-dark-900 hover:text-white transition-all shadow-sm">
                            <i class="fa-brands fa-x-twitter"></i>
                        </button>
                        <button onclick="copyLink()"
                            class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="pb-24 bg-white">
        <div class="max-w-4xl mx-auto px-6">

            @if ($post->image)
                <div class="relative -mt-4 mb-16 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-primary-900/10 group">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-auto object-cover max-h-[550px] transition-transform duration-700 group-hover:scale-105">
                    @if ($post->image_caption)
                        <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                            <p class="text-white/90 text-xs italic">{{ $post->image_caption }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <div class="grid lg:grid-cols-12 gap-12">
                <!-- Sidebar Samping (Floating) -->
                <aside class="lg:col-span-1 hidden lg:block">
                    <div class="sticky top-32 flex flex-col gap-6 items-center">
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-gray-300 vertical-text">Share</span>
                        <div class="w-px h-12 bg-gray-100"></div>
                        <!-- Social Floating Buttons -->
                    </div>
                </aside>

                <!-- Article Body -->
                <div class="lg:col-span-11">
                    <article
                        class="prose prose-lg max-w-none prose-slate prose-headings:font-display prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary-600 prose-img:rounded-3xl prose-blockquote:border-primary-500 prose-blockquote:bg-primary-50 prose-blockquote:py-1 prose-blockquote:px-6">
                        {!! $post->content !!}
                    </article>

                    <!-- Tags / Kategori Bawah -->
                    <div class="mt-16 flex items-center gap-3">
                        <i class="fa-solid fa-tags text-gray-300"></i>
                        <span
                            class="px-4 py-2 bg-gray-50 text-dark-900 text-xs font-bold rounded-xl border border-gray-100">#Pendidikan</span>
                        <span
                            class="px-4 py-2 bg-gray-50 text-dark-900 text-xs font-bold rounded-xl border border-gray-100">#SMPTunasHarapan</span>
                    </div>

                    <!-- Author Box -->
                    <div class="mt-16 p-8 bg-gray-50 rounded-[2rem] border border-gray-100 flex items-center gap-6">
                        <div class="w-20 h-20 rounded-2xl bg-white shadow-sm flex items-center justify-center text-3xl">
                            🏫
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-dark-900 text-lg">Panitia Humas Sekolah</h4>
                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">Menyajikan informasi akurat dan terkini
                                seputar kegiatan akademik dan non-akademik di lingkungan SMP Tunas Harapan Bekasi.</p>
                        </div>
                    </div>

                    <!-- Disqus Section -->
                    <div class="mt-20 pt-12 border-t border-gray-100">
                        <div class="flex items-center gap-4 mb-10">
                            <h3 class="font-display text-3xl font-black text-dark-900 tracking-tight">Diskusi Berita</h3>
                            <div class="h-px flex-1 bg-gray-100"></div>
                        </div>
                        <div id="disqus_thread" class="bg-white"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section (Horizontal Scroll on Mobile) -->
    @if ($relatedPosts->count())
        <section class="py-24 bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-primary-500 mb-2 block">Jangan
                            Lewatkan</span>
                        <h3 class="font-display text-3xl font-black text-dark-900 tracking-tight">Berita Terkait</h3>
                    </div>
                    <a href="{{ route('berita') }}"
                        class="text-xs font-black uppercase tracking-widest text-dark-400 hover:text-primary-500 transition-colors">Lihat
                        Semua</a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $related)
                        <article
                            class="flex flex-col bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                            <div class="aspect-[16/10] overflow-hidden">
                                <img src="{{ $related->image ? Storage::url($related->image) : 'https://picsum.photos/seed/news-' . $related->id . '/600/400' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="p-6">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-primary-500">{{ $related->category->name ?? 'Update' }}</span>
                                <h4
                                    class="font-display font-bold text-dark-900 mt-2 line-clamp-2 hover:text-primary-500 transition-colors leading-snug">
                                    <a href="{{ route('berita.detail', $related->slug) }}">{{ $related->title }}</a>
                                </h4>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        // Progress Bar Logic
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById("reading-progress").style.width = scrolled + "%";
        });

        // Disqus Config
        var disqus_config = function() {
            this.page.url = '{{ url()->current() }}';
            this.page.identifier = '{{ $post->id }}';
        };
        (function() {
            var d = document,
                s = d.createElement('script');
            s.src = 'https://zidanherlangga.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

        // Share Helpers
        function copyLink() {
            navigator.clipboard.writeText(window.location.href);
            alert('Tautan berhasil disalin!');
        }
    </script>
@endsection
