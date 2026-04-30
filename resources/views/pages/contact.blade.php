@extends('layouts.app')

@section('title', 'Kontak - ' . $settings->get('school_name'))

@section('content')

<!-- Hero -->
<section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
    <div class="absolute inset-0"><img src="https://picsum.photos/seed/contact-hero/1920/600" alt="" class="w-full h-full object-cover opacity-30"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 bg-primary-400/10 text-primary-400 text-xs font-semibold uppercase tracking-widest rounded-full mb-4">Hubungi Kami</span>
        <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Kontak</h1>
        <p class="text-dark-300 max-w-2xl mx-auto">Ada pertanyaan? Silakan hubungi kami melalui form berikut atau langsung ke kontak sekolah.</p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-5 gap-12">
            <!-- Contact Info -->
            <div class="lg:col-span-2 fade-up">
                <h2 class="font-display text-2xl font-bold text-dark-900 tracking-tight mb-8">Informasi Sekolah</h2>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-primary-500"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-900 mb-1">Alamat</h4>
                            <p class="text-sm text-dark-500 leading-relaxed">{{ $settings->get('school_address') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-primary-500"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-900 mb-1">Telepon</h4>
                            <p class="text-sm text-dark-500">{{ $settings->get('school_phone') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-primary-500"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-900 mb-1">Email</h4>
                            <p class="text-sm text-dark-500">{{ $settings->get('school_email') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-primary-500"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-900 mb-1">Jam Operasional</h4>
                            <p class="text-sm text-dark-500">Senin - Jumat: 07.00 - 16.00 WIB</p>
                            <p class="text-sm text-dark-500">Sabtu: 07.00 - 12.00 WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-10">
                    <h4 class="font-semibold text-dark-900 mb-4">Ikuti Media Sosial Kami</h4>
                    <div class="flex gap-3">
                        <a href="{{ $settings->get('school_facebook') }}" class="w-11 h-11 bg-dark-50 hover:bg-primary-400 rounded-xl flex items-center justify-center text-dark-500 hover:text-white transition-all duration-300" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->get('school_instagram') }}" class="w-11 h-11 bg-dark-50 hover:bg-primary-400 rounded-xl flex items-center justify-center text-dark-500 hover:text-white transition-all duration-300" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->get('school_youtube') }}" class="w-11 h-11 bg-dark-50 hover:bg-primary-400 rounded-xl flex items-center justify-center text-dark-500 hover:text-white transition-all duration-300" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="{{ $settings->get('school_tiktok') }}" class="w-11 h-11 bg-dark-50 hover:bg-primary-400 rounded-xl flex items-center justify-center text-dark-500 hover:text-white transition-all duration-300" target="_blank"><i class="fab fa-tiktok"></i></a>
                        <a href="https://wa.me/{{$settings->get('school_phone')}}" class="w-11 h-11 bg-dark-50 hover:bg-primary-400 rounded-xl flex items-center justify-center text-dark-500 hover:text-white transition-all duration-300" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-3 fade-up">
                <div class="bg-gray-50 border border-gray-100 rounded-3xl p-8 md:p-10">
                    <h2 class="font-display text-2xl font-bold text-dark-900 tracking-tight mb-2">Kirim Pesan</h2>
                    <p class="text-dark-500 text-sm mb-8">Isi form berikut dan kami akan segera merespons.</p>

                    <form method="POST" action="{{ route('contact.store') }}" id="contact-form" novalidate>
                        @csrf

                        <div class="space-y-5">
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-dark-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm bg-white @error('name') border-red-300 @enderror" placeholder="Nama Anda">
                                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-dark-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm bg-white @error('email') border-red-300 @enderror" placeholder="email@contoh.com">
                                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Pesan <span class="text-red-500">*</span></label>
                                <textarea name="message" required rows="6" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm resize-none bg-white @error('message') border-red-300 @enderror" placeholder="Tuliskan pesan Anda...">{{ old('message') }}</textarea>
                                @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <button type="submit" id="contact-btn" class="mt-6 w-full md:w-auto px-8 py-3.5 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 hover:shadow-lg hover:shadow-primary-400/30 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-16 fade-up rounded-3xl overflow-hidden border border-gray-200 shadow-sm">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2346007184847!2d107.00926392499038!3d-6.232773993755419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698e9f48e94667%3A0x94fc76a321fc8e47!2sSekolah%20Menengah%20Pertama%20Tunas%20Harapan!5e0!3m2!1sid!2sid!4v1776742249193!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('contact-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    });
</script>
@endpush