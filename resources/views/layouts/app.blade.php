<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'SMP Tunas Harapan Bekasi')</title>
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
                            50:'#eff6ff', 100:'#dbeafe', 200:'#bfdbfe', 300:'#93c5fd', 
                            400:'#60a5fa', 500:'#3b82f6', 600:'#2563eb', 700:'#1d4ed8', 
                            800:'#1e40af', 900:'#1e3a8a', 950:'#172554' 
                        },
                        secondary: { 
                            50:'#fdf4ff', 100:'#fae8ff', 200:'#f5d0fe', 300:'#f0abfc', 
                            400:'#e879f9', 500:'#d946ef', 600:'#c026d3', 700:'#a21caf', 
                            800:'#86198f', 900:'#701a75' 
                        },
                        dark: { 
                            50:'#f8fafc', 100:'#f1f5f9', 200:'#e2e8f0', 300:'#cbd5e1', 
                            400:'#94a3b8', 500:'#64748b', 600:'#475569', 700:'#334155', 
                            800:'#1e293b', 900:'#0f172a', 950:'#020617' 
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern { background-image: radial-gradient(circle at 25% 25%, rgba(249,173,56,0.15) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(217,119,6,0.1) 0%, transparent 50%); }
        .glass { background: rgba(255,255,255,0.8); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); }
        .fade-up { opacity: 0; transform: translateY(30px); transition: all 0.7s cubic-bezier(0.4,0,0.2,1); }
        .fade-up.visible { opacity: 1; transform: translateY(0); }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        .float-anim { animation: float 3s ease-in-out infinite; }
    </style>

    @stack('styles')
</head>
<body class="bg-white text-dark-900">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class=" bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center p-1.5 overflow-hidden group-hover:scale-105 transition-transform">
                        <img src="{{ asset('assets/images/logo-tunas-harapan.png') }}" alt="Logo Sekolah" class="w-14 h-14 object-contain">
                    </div>
                    <div>
                        <span class="font-display font-bold text-lg leading-tight block nav-text-color">SMP Tunas Harapan</span>
                        <span class="text-xs nav-sub-text-color opacity-70">Berbasis Karakter & Kreativitas Digital</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    @php $currentRoute = request()->route()->getName(); @endphp
                    <a href="{{ route('home') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $currentRoute === 'home' ? 'text-primary-500 bg-primary-50' : 'nav-text-color hover:text-primary-500 hover:bg-primary-50/50' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $currentRoute === 'about' ? 'text-primary-500 bg-primary-50' : 'nav-text-color hover:text-primary-500 hover:bg-primary-50/50' }}">Tentang</a>
                    <a href="{{ route('berita') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ str_starts_with($currentRoute, 'berita') ? 'text-primary-500 bg-primary-50' : 'nav-text-color hover:text-primary-500 hover:bg-primary-50/50' }}">Berita</a>
                    <a href="{{ route('ppdb') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $currentRoute === 'ppdb' ? 'text-primary-500 bg-primary-50' : 'nav-text-color hover:text-primary-500 hover:bg-primary-50/50' }}">PPDB</a>
                    <a href="{{ route('contact') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $currentRoute === 'contact' ? 'text-primary-500 bg-primary-50' : 'nav-text-color hover:text-primary-500 hover:bg-primary-50/50' }}">Kontak</a>
                    <a href="{{ route('ppdb') }}" class="ml-3 px-5 py-2.5 bg-primary-400 text-white text-sm font-semibold rounded-lg hover:bg-primary-500 hover:shadow-lg hover:shadow-primary-400/30 transition-all">
                        Daftar PPDB
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg nav-text-color hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden border-t border-gray-100">
            <div class="px-6 py-4 space-y-1 bg-white">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-dark-800 hover:bg-primary-50 hover:text-primary-500 transition-colors">Beranda</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-dark-800 hover:bg-primary-50 hover:text-primary-500 transition-colors">Tentang</a>
                <a href="{{ route('berita') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-dark-800 hover:bg-primary-50 hover:text-primary-500 transition-colors">Berita</a>
                <a href="{{ route('ppdb') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-dark-800 hover:bg-primary-50 hover:text-primary-500 transition-colors">PPDB</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-dark-800 hover:bg-primary-50 hover:text-primary-500 transition-colors">Kontak</a>
                <a href="{{ route('ppdb') }}" class="block px-4 py-3 bg-primary-400 text-white text-sm font-semibold rounded-lg text-center mt-2">Daftar PPDB</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-900 text-dark-300 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-10 pb-12 border-b border-dark-700">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white/10 rounded-xl flex items-center justify-center">
                            <img src="{{ asset('assets/images/logo-tunas-harapan.png') }}"alt="Logo Sekolah" class="w-14 h-14 object-contain">
                        </div>
                        <span class="font-display font-bold text-lg text-white">SMP Tunas Harapan Bekasi</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-4">SMP Berbasis Karakter & Kreativitas Digital</p>
                   <div class="flex gap-3">
                        <a href="{{ $settings->get('school_facebook', '#') }}" class="w-9 h-9 rounded-lg bg-dark-800 hover:bg-primary-400 flex items-center justify-center transition-colors" target="_blank"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="{{ $settings->get('school_instagram', '#') }}" class="w-9 h-9 rounded-lg bg-dark-800 hover:bg-primary-400 flex items-center justify-center transition-colors" target="_blank"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="{{ $settings->get('school_youtube', '#') }}" class="w-9 h-9 rounded-lg bg-dark-800 hover:bg-primary-400 flex items-center justify-center transition-colors" target="_blank"><i class="fab fa-youtube text-sm"></i></a>
                        <a href="{{ $settings->get('school_tiktok', '#') }}" class="w-9 h-9 rounded-lg bg-dark-800 hover:bg-primary-400 flex items-center justify-center transition-colors" target="_blank"><i class="fab fa-tiktok text-sm"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-sm hover:text-primary-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('berita') }}" class="text-sm hover:text-primary-400 transition-colors">Berita</a></li>
                        <li><a href="{{ route('ppdb') }}" class="text-sm hover:text-primary-400 transition-colors">PPDB Online</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm hover:text-primary-400 transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Program -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Program</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="text-sm hover:text-primary-400 transition-colors">Kurikulum Merdeka</a></li>
                        <li><a href="#" class="text-sm hover:text-primary-400 transition-colors">Fasilitas</a></li>
                        <li><a href="#" class="text-sm hover:text-primary-400 transition-colors">Ekstra Kurikuler</a></li>
                        <li><a href="#" class="text-sm hover:text-primary-400 transition-colors">Guru Tersertifikasi</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm">
                            <i class="fas fa-map-marker-alt text-primary-400 mt-1"></i>
                            <span>{{ $settings->get('school_address', 'Jl. Pendidikan No. 1, Jakarta Selatan') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <i class="fas fa-phone text-primary-400"></i>
                            <span>{{ $settings->get('school_phone', '(021) 1234-5678') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <i class="fas fa-envelope text-primary-400"></i>
                            <span>{{ $settings->get('school_email', 'info@sekolahunggulan.id') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-dark-500">&copy; {{ date('Y') }} SMP Tunas Harapan Bekasi.</p>
                <a href="{{ route('admin.login') }}" class="text-xs text-dark-600 hover:text-dark-400 transition-colors"><i class="fas fa-lock mr-1"></i>Admin Panel</a>
            </div>
        </div>
    </footer>

    <!-- Flash Messages -->
    @if(session('success'))
    <div id="flash-success" class="fixed bottom-6 right-6 z-[100] bg-emerald-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 transform translate-y-2 opacity-0 transition-all duration-300" style="transition-delay:100ms">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-70"><i class="fas fa-times"></i></button>
    </div>
    @endif

    @if(session('error'))
    <div id="flash-error" class="fixed bottom-6 right-6 z-[100] bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 transform translate-y-2 opacity-0 transition-all duration-300" style="transition-delay:100ms">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="text-sm font-medium">{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-70"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <script id="dsq-count-scr" src="//zidanherlangga.disqus.com/count.js" async></script>
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        function updateNavbar() {
            if (window.scrollY > 20) {
                navbar.classList.add('glass', 'shadow-lg', 'shadow-black/5');
                navbar.querySelectorAll('.nav-text-color').forEach(el => el.style.color = '#1e293b');
                navbar.querySelectorAll('.nav-sub-text-color').forEach(el => el.style.color = '#1e293b');
            } else {
                navbar.classList.remove('glass', 'shadow-lg', 'shadow-black/5');
                navbar.querySelectorAll('.nav-text-color').forEach(el => el.style.color = '#ffffff');
                navbar.querySelectorAll('.nav-sub-text-color').forEach(el => el.style.color = '#ffffff');
            }
        }
        updateNavbar();
        window.addEventListener('scroll', updateNavbar);

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Flash messages animation
        document.addEventListener('DOMContentLoaded', () => {
            ['flash-success', 'flash-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    setTimeout(() => { el.style.transform = 'translateY(0)'; el.style.opacity = '1'; }, 100);
                    setTimeout(() => { el.style.transform = 'translateY(10px)'; el.style.opacity = '0'; setTimeout(() => el.remove(), 300); }, 5000);
                }
            });
        });

        // Scroll reveal animation
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>