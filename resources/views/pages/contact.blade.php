@extends('layouts.app')

@section('title', 'Hubungi Kami - ' . $settings->get('school_name'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('assets/images/pattern-dots.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 bg-primary-500/10 text-primary-400 text-xs font-bold uppercase tracking-widest rounded-full mb-6 border border-primary-500/20">
                Contact Center
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                Ada Pertanyaan? <span class="text-primary-500">Kami Siap Membantu</span>
            </h1>
            <p class="text-dark-300 max-w-2xl mx-auto text-lg leading-relaxed">
                Silakan hubungi kami melalui formulir di bawah atau saluran komunikasi resmi sekolah kami.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-16">

                <!-- Contact Info Side -->
                <div class="lg:col-span-4 fade-up">
                    <h2 class="font-display text-3xl font-bold text-dark-900 tracking-tight mb-8">Informasi Kontak</h2>

                    <div class="space-y-8">
                        @foreach ([['map-marker-alt', 'Alamat Sekolah', $settings->get('school_address')], ['phone-alt', 'Layanan Telepon', $settings->get('school_phone')], ['envelope', 'Email Resmi', $settings->get('school_email')], ['clock', 'Jam Operasional', 'Senin - Jumat: 07.00 - 16.00 WIB']] as $item)
                            <div
                                class="group flex items-start gap-5 p-4 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                                <div
                                    class="w-14 h-14 bg-white shadow-lg shadow-primary-500/10 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary-500 group-hover:text-white transition-all duration-500">
                                    <i
                                        class="fas fa-{{ $item[0] }} text-primary-500 group-hover:text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-display font-bold text-dark-900 mb-1">{{ $item[1] }}</h4>
                                    <p class="text-sm text-dark-500 leading-relaxed">{{ $item[2] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Social Media Cards -->
                    <div class="mt-12 p-8 bg-dark-900 rounded-[2rem] text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="font-display font-bold mb-6">Media Sosial</h4>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach (['facebook-f', 'instagram', 'youtube', 'whatsapp'] as $social)
                                    <a href="#"
                                        class="w-12 h-12 bg-white/10 hover:bg-primary-500 rounded-xl flex items-center justify-center transition-all duration-300">
                                        <i class="fab fa-{{ $social }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-primary-500/20 rounded-full blur-3xl"></div>
                    </div>
                </div>

                <!-- Contact Form Side -->
                <div class="lg:col-span-8 fade-up">
                    <div
                        class="bg-white border border-gray-100 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-primary-900/5 relative">
                        <!-- Decorative Element -->
                        <div class="absolute top-0 right-0 p-10 opacity-5 hidden md:block">
                            <i class="fas fa-paper-plane text-9xl -rotate-12"></i>
                        </div>

                        <form method="POST" action="{{ route('contact.store') }}" id="contact-form" class="relative z-10">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-8 mb-8">
                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-[0.2em] text-dark-400 ml-1">Nama
                                        Anda</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 focus:ring-4 focus:ring-primary-400/10 outline-none transition-all text-sm font-medium @error('name') border-red-300 @enderror"
                                        placeholder="Contoh: Budi Santoso">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-[0.2em] text-dark-400 ml-1">Alamat
                                        Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 focus:ring-4 focus:ring-primary-400/10 outline-none transition-all text-sm font-medium @error('email') border-red-300 @enderror"
                                        placeholder="email@domain.com">
                                </div>
                            </div>

                            <div class="space-y-2 mb-8">
                                <label class="text-xs font-black uppercase tracking-[0.2em] text-dark-400 ml-1">Pesan atau
                                    Pertanyaan</label>
                                <textarea name="message" required rows="5"
                                    class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 focus:ring-4 focus:ring-primary-400/10 outline-none transition-all text-sm font-medium resize-none @error('message') border-red-300 @enderror"
                                    placeholder="Tuliskan pesan Anda secara detail di sini...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" id="contact-btn"
                                class="group relative w-full md:w-auto px-10 py-5 bg-primary-500 text-white font-bold rounded-2xl overflow-hidden transition-all hover:scale-105 active:scale-95 shadow-xl shadow-primary-500/25">
                                <div
                                    class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                </div>
                                <span class="relative flex items-center justify-center gap-3">
                                    <i
                                        class="fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                    Kirim Pesan Sekarang
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- FAQ Teaser -->
            <div class="mt-32 grid md:grid-cols-3 gap-8">
                @foreach ([['question-circle', 'Cara Mendaftar?', 'Pendaftaran dapat dilakukan secara online melalui menu SPMB di dashboard akun Anda.'], ['info-circle', 'Biaya Sekolah?', 'Informasi detail biaya sekolah dapat Anda unduh melalui brosur digital di halaman profil.'], ['user-friends', 'Kunjungan Sekolah?', 'Kami menerima kunjungan orang tua setiap hari kerja dengan janji temu terlebih dahulu.']] as $faq)
                    <div
                        class="p-8 rounded-[2rem] bg-gray-50 border border-gray-100 hover:border-primary-200 transition-colors">
                        <i class="fas fa-{{ $faq[0] }} text-primary-500 text-2xl mb-4"></i>
                        <h4 class="font-display font-bold text-dark-900 mb-2">{{ $faq[1] }}</h4>
                        <p class="text-sm text-dark-500 leading-relaxed">{{ $faq[2] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Map Section -->
            <div class="mt-24 fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <h3 class="font-display text-2xl font-bold text-dark-900 tracking-tight">Lokasi Sekolah</h3>
                    <div class="h-px flex-1 bg-gray-100"></div>
                </div>
                <div class="rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2346007184847!2d107.00926392499038!3d-6.232773993755419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698e9f48e94667%3A0x94fc76a321fc8e47!2sSekolah%20Menengah%20Pertama%20Tunas%20Harapan!5e0!3m2!1sid!2sid!4v1776742249193!5m2!1sid!2sid"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="sm:h-[500px]"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
