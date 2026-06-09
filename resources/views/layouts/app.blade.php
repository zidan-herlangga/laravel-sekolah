<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-site-verification" content="{{ $settings->get('google_site_verification') ?? '' }}" />
    <meta name="msvalidate.01" content="{{ $settings->get('msvalidate.01') ?? '' }}" />

    <title>@yield('title', 'SMP Tunas Harapan Bekasi')</title>
    @yield('meta_tags')
    <meta name="description" content="@yield('meta_description', 'SMP Tunas Harapan Bekasi - Berbasis Karakter & Kreativitas Digital')">

    {{-- Icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo-tunas-harapan.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554'
                        },
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617'
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Animations */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 5px 15px rgba(37, 211, 102, 0.4);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: #128c7e;
        }

        @media (max-width: 640px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 24px;
            }
            .flash-msg {
                bottom: 80px !important;
                right: 16px !important;
                left: 16px !important;
                font-size: 13px;
            }
        }

        @media print {

            nav,
            footer,
            .whatsapp-float {
                display: none !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-white text-dark-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav id="navbar"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-dark-950  shadow-xl shadow-black/5 text-white text-dark-900">
        <div class="max-w-7xl mx-auto  lg:px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo Tetap Sama -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div
                        class="bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center p-1.5 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('assets/images/logo-tunas-harapan.png') }}" alt="Logo"
                            class="w-12 h-12 md:w-14 md:h-14 object-contain">
                    </div>
                    <div>
                        <span id="nav-brand"
                            class="font-display font-bold text-lg leading-tight block text-white transition-colors duration-300 text-white text-dark-900">SMP
                            Tunas Harapan</span>
                        <span id="nav-sub-brand"
                            class="text-xs text-white/70 block transition-colors duration-300">Berbasis Karakter &
                            Digital</span>
                    </div>
                </a>

                <!-- Desktop Menu (Disederhanakan) -->
                <div class="hidden md:flex items-center gap-2">
                    @php $currentRoute = request()->route()->getName(); @endphp

                    @foreach (['home' => 'Beranda', 'about' => 'Tentang', 'berita' => 'Berita', 'contact' => 'Kontak'] as $route => $label)
                        <a href="{{ route($route) }}"
                            class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ $currentRoute === $route || ($route === 'berita' && str_contains($currentRoute, 'berita')) ? 'text-primary-500 bg-primary-50' : 'text-white hover:text-primary-400' }}">
                            {{ $label }}
                        </a>
                    @endforeach

                    <div class="h-6 w-[1px] bg-white/20 mx-2"></div>

                    @auth
                        <!-- Tampilan Jika Sudah Login -->
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-2 px-4 py-2 bg-primary-500 text-white text-sm font-bold rounded-xl hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/20">
                                <i class="fa-solid fa-gauge-high"></i> Dashboard
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-white/70 hover:text-red-400 text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-power-off"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Tampilan Jika Belum Login -->
                        <a href="{{ route('login') }}"
                            class="nav-link px-4 py-2 text-white text-sm font-medium hover:text-primary-400">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="ml-2 px-6 py-2.5 bg-white text-primary-600 text-sm font-bold rounded-xl hover:bg-primary-50 shadow-lg shadow-black/5 transition-all">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Trigger Tetap Sama -->
                <button id="offcanvas-open"
                    class="md:hidden p-2.5 rounded-xl text-white hover:bg-white/10 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Mobile Menu -->
    <div id="offcanvas-menu" class="fixed inset-0 z-[60] invisible transition-all duration-300">
        <!-- Backdrop dengan blur yang lebih halus -->
        <div id="offcanvas-backdrop"
            class="absolute inset-0 bg-dark-950/60 backdrop-blur-md opacity-0 transition-opacity duration-300"></div>

        <div id="offcanvas-content"
            class="absolute top-0 right-0 bottom-0 w-[320px] bg-white translate-x-full transition-transform duration-500 cubic-bezier(0.4, 0, 0.2, 1) flex flex-col shadow-2xl">

            <!-- Header dengan Branding -->
            <div class="p-6 flex items-center justify-between border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo-tunas-harapan.png') }}" class="w-8 h-8 object-contain"
                        alt="Logo">
                    <span class="font-display font-bold text-dark-900 tracking-tight">Navigasi Utama</span>
                </div>
                <button id="offcanvas-close"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-gray-400 hover:bg-gray-100 hover:text-dark-900 transition-all">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar">
                <!-- Section: User Account (Hanya jika login) -->
                @auth
                    <div class="p-6 bg-primary-50/50 border-b border-primary-100/50">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary-500/20">
                                <i class="fa-solid fa-user-graduate text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-primary-600 mb-0.5">Pendaftar
                                </p>
                                <p class="font-display font-bold text-dark-900 leading-none">
                                    {{ Str::words(auth()->user()->name, 2) }}</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center justify-center gap-2 w-full py-2.5 bg-white border border-primary-200 text-primary-600 text-xs font-bold rounded-xl hover:bg-primary-50 transition-all">
                            <i class="fa-solid fa-gauge-high"></i> Buka Dashboard
                        </a>
                    </div>
                @endauth

                <!-- Section: Menu Links -->
                <div class="p-4 space-y-1">
                    <p class="px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Menu Utama</p>
                    @foreach (['home' => ['house', 'Beranda'], 'about' => ['circle-info', 'Tentang Kami'], 'berita' => ['newspaper', 'Berita & Artikel'], 'contact' => ['envelope', 'Hubungi Kami']] as $route => $info)
                        <a href="{{ route($route) }}"
                            class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-dark-700 hover:bg-gray-50 hover:text-primary-600 transition-all group {{ request()->routeIs($route) ? 'bg-primary-50 text-primary-600 font-bold' : '' }}">
                            <div
                                class="w-8 h-8 rounded-xl flex items-center justify-center bg-gray-100 group-hover:bg-primary-100 transition-colors {{ request()->routeIs($route) ? 'bg-primary-100 text-primary-600' : '' }}">
                                <i class="fa-solid fa-{{ $info[0] }} text-sm"></i>
                            </div>
                            <span class="text-sm">{{ $info[1] }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- Section: Sosial Media -->
                <div class="p-8 mt-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4 text-center">Ikuti
                        Kami</p>
                    <div class="flex justify-center gap-4">
                        @foreach (['instagram', 'facebook', 'youtube', 'tiktok'] as $social)
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-primary-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-brands fa-{{ $social }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Footer Offcanvas: Action Button -->
            <div class="p-6 border-t border-gray-50 bg-white">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full py-4 text-sm font-bold text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                            <i class="fa-solid fa-power-off mr-2"></i> Keluar Akun
                        </button>
                    </form>
                @else
                    <a href="{{ route('spmb') }}"
                        class="flex items-center justify-center gap-3 w-full py-4 bg-primary-500 text-white font-bold rounded-2xl shadow-xl shadow-primary-500/30 hover:bg-primary-600 transition-all active:scale-[0.98]">
                        Daftar SPMB 2026 <i class="fa-solid fa-arrow-right-long animate-pulse"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-950 text-dark-300 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 pb-12 border-b border-dark-800">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('assets/images/logo-tunas-harapan.png') }}"
                            class="w-12 h-12 object-contain" alt="Logo">
                        <span class="font-display font-bold text-lg text-white">SMP Tunas Harapan</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6">Membentuk generasi cerdas, berkarakter Islami, dan siap
                        menghadapi tantangan era digital.</p>
                    <div class="flex gap-3">
                        @foreach (['facebook' => 'school_facebook', 'instagram' => 'school_instagram', 'youtube' => 'school_youtube', 'tiktok' => 'school_tiktok'] as $icon => $key)
                            <a href="{{ $settings->get($key, '#') }}"
                                class="w-10 h-10 rounded-xl bg-dark-800 hover:bg-primary-500 flex items-center justify-center text-white transition-all"
                                target="_blank"><i class="fab fa-{{ $icon }}"></i></a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-6 uppercase tracking-wider text-xs">Navigasi
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-400">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-primary-400">Tentang Kami</a></li>
                        <li><a href="{{ route('berita') }}" class="hover:text-primary-400">Berita</a></li>
                        <li><a href="{{ route('spmb') }}" class="hover:text-primary-400">Pendaftaran</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-6 uppercase tracking-wider text-xs">Kontak Kami
                    </h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex gap-3"><i
                                class="fas fa-map-marker-alt text-primary-500 mt-1"></i><span>{{ $settings->get('school_address') }}</span>
                        </li>
                        <li class="flex gap-3"><i
                                class="fas fa-phone text-primary-500"></i><span>{{ $settings->get('school_phone') }}</span>
                        </li>
                        <li class="flex gap-3"><i
                                class="fas fa-envelope text-primary-500"></i><span>{{ $settings->get('school_email') }}</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-6 uppercase tracking-wider text-xs">Akses Cepat
                    </h4>
                    <a href="{{ route('spmb') }}"
                        class="block p-4 bg-dark-800 rounded-2xl border border-dark-700 hover:border-primary-500 transition-colors group">
                        <span class="block text-white font-bold mb-1 group-hover:text-primary-400">SPMB 2026</span>
                        <span class="text-xs text-dark-400">Daftar sekarang secara online.</span>
                    </a>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
                <p>&copy; {{ date('Y') }} SMP Tunas Harapan Bekasi. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('admin.login') }}" class="hover:text-white"><i
                            class="fas fa-lock mr-2"></i>Admin Area</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/{{ $settings->get('school_phone') }}" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Flash Messages -->
    @foreach (['success' => 'emerald', 'error' => 'red'] as $type => $color)
        @if (session($type))
            <div
                class="flash-msg fixed bottom-6 right-6 z-[100] bg-{{ $color }}-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce-short">
                <i class="fas fa-{{ $type === 'success' ? 'check-circle' : 'exclamation-circle' }} text-xl"></i>
                <span class="text-sm font-bold">{{ session($type) }}</span>
                <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
            </div>
        @endif
    @endforeach

    <script>
        // Offcanvas Logic
        const offcanvas = document.getElementById('offcanvas-menu');
        const content = document.getElementById('offcanvas-content');
        const backdrop = document.getElementById('offcanvas-backdrop');
        const openBtn = document.getElementById('offcanvas-open');
        const closeBtn = document.getElementById('offcanvas-close');

        function toggleMenu(show) {
            if (show) {
                offcanvas.classList.remove('invisible');
                setTimeout(() => {
                    backdrop.classList.replace('opacity-0', 'opacity-100');
                    content.classList.replace('translate-x-full', 'translate-x-0');
                }, 10);
                document.body.style.overflow = 'hidden';
            } else {
                backdrop.classList.replace('opacity-100', 'opacity-0');
                content.classList.replace('translate-x-0', 'translate-x-full');
                setTimeout(() => {
                    offcanvas.classList.add('invisible');
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        openBtn.addEventListener('click', () => toggleMenu(true));
        closeBtn.addEventListener('click', () => toggleMenu(false));
        backdrop.addEventListener('click', () => toggleMenu(false));

        // Intersection Observer for Animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

        // Auto-remove flash messages
        setTimeout(() => {
            document.querySelectorAll('.flash-msg').forEach(el => {
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>

</html>
