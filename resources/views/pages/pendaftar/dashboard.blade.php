@extends('layouts.app')

@section('title', 'Dashboard Pendaftar - SMP Tunas Harapan')

@section('content')
    <div class="min-h-screen bg-gray-50 pt-28 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Welcome Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 fade-up visible">
                <div>
                    <h1 class="font-display text-3xl font-bold text-dark-900">Halo, {{ $user->name }}! 👋</h1>
                    <p class="text-dark-500 mt-1">Selamat datang di panel kendali pendaftaran Anda.</p>
                </div>
                <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center text-white">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div class="pr-4">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-dark-400">Status Akun</p>
                        <p class="text-sm font-bold text-emerald-500">Terverifikasi</p>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Main Statistics & Status -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Status Pendaftaran Card -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                        <h3 class="font-display font-bold text-dark-900 mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-primary-500"></i>
                            Status Pendaftaran
                        </h3>

                        @if ($registration)
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-500 text-white',
                                    'verified' => 'bg-blue-500 text-white',
                                    'lulus' => 'bg-emerald-500 text-white',
                                    'tidak_lulus' => 'bg-red-500 text-white',
                                    'rejected' => 'bg-red-500 text-white',
                                ];
                                $badgeClass = $statusColors[$registration->status] ?? 'bg-gray-500 text-white';
                            @endphp
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between p-6 bg-primary-50 rounded-2xl border border-primary-100 gap-4">
                                <div>
                                    <p class="text-xs text-primary-600 font-bold uppercase tracking-wider mb-1">Nomor
                                        Pendaftaran</p>
                                    <p class="text-xl font-display font-black text-primary-900">
                                        {{ $registration->registration_number }}</p>
                                </div>
                                <div class="sm:text-right">
                                    <span class="px-4 py-2 rounded-full text-xs font-bold uppercase {{ $badgeClass }}">
                                        {{ $registration->status_label }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-file-pen text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-dark-500 text-sm mb-4">Anda belum melengkapi formulir pendaftaran.</p>
                                <a href="{{ route('spmb') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/20">
                                    <i class="fa-solid fa-pen-to-square"></i> Isi Formulir Sekarang
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- @if ($examResult && $examResult->end_time)
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                        <h3 class="font-display font-bold text-dark-900 mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-scroll text-primary-500"></i>
                            Hasil Ujian
                        </h3>
                        <div class="flex items-center justify-between p-6 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl text-white">
                            <div>
                                <p class="text-primary-100 text-xs font-bold uppercase tracking-wider mb-1">Nilai Akhir</p>
                                <p class="text-4xl font-display font-black">{{ $examResult->score }}</p>
                                <p class="text-primary-200 text-xs mt-1">dari maksimal {{ $maxScore }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-5xl font-black opacity-30">{{ round(($examResult->score / max($maxScore, 1)) * 100) }}%</div>
                                <p class="text-primary-200 text-xs mt-1">Selesai: {{ $examResult->end_time->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif --}}

                    @if (
                        $registration &&
                            $registration->status === 'lulus' &&
                            $registration->payment_amount &&
                            $registration->payment_amount > 0)
                        <div
                            class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                            <h3 class="font-display font-bold text-dark-900 mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-credit-card text-primary-500"></i>
                                Pembayaran Daftar Ulang
                            </h3>
                            <div
                                class="flex items-center justify-between p-6 rounded-2xl {{ $registration->payment_status === 'paid' ? 'bg-emerald-50 border border-emerald-100' : 'bg-amber-50 border border-amber-100' }}">
                                <div>
                                    <p
                                        class="text-xs font-bold uppercase tracking-wider mb-1 {{ $registration->payment_status === 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                        Status Pembayaran</p>
                                    <p
                                        class="text-xl font-display font-black {{ $registration->payment_status === 'paid' ? 'text-emerald-900' : 'text-amber-900' }}">
                                        {{ $registration->payment_status_label }}
                                    </p>
                                    @if ($registration->payment_amount)
                                        <p class="text-sm text-dark-500 mt-1">Nominal:
                                            {{ $registration->payment_amount_formatted }}</p>
                                    @endif
                                </div>
                                @if ($registration->payment_status !== 'paid')
                                    <a href="{{ route('payment.index') }}"
                                        class="px-5 py-2.5 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-all text-sm">
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <div class="text-right flex flex-col items-end gap-1">
                                        <i class="fa-solid fa-check-circle text-3xl text-emerald-500"></i>
                                        @if ($registration->paid_at)
                                            <p class="text-xs text-emerald-600">
                                                {{ $registration->paid_at->format('d/m/Y') }}</p>
                                        @endif
                                        @if ($payment)
                                            <a href="{{ route('payment.invoice') }}"
                                                class="text-xs text-primary-600 hover:text-primary-700 font-semibold underline">
                                                <i class="fa-solid fa-file-invoice mr-1"></i>Download Invoice
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Menu Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Cek Kelulusan -->
                        <a href="{{ route('pendaftar.cek-status') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-id-card text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Cek Kelulusan (NISN)</h4>
                            <p class="text-xs text-dark-500 mt-2">Lihat pengumuman hasil seleksi akhir menggunakan NISN
                                Anda.</p>
                        </a>

                        <!-- Test Online -->
                        <a href="{{ route('pendaftar.ujian.index') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-laptop-code text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Tes Online</h4>
                            <p class="text-xs text-dark-500 mt-2">Fitur tes online akan dibuka sesuai jadwal yang
                                ditentukan.</p>
                        </a>

                        <!-- Profile -->
                        <a href="{{ route('pendaftar.profile') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-user-gear text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Profil Pendaftar</h4>
                            <p class="text-xs text-dark-500 mt-2">Lengkapi data diri, foto profil, dan dokumen pendukung
                                lainnya.</p>
                        </a>

                        <!-- Kartu Peserta -->
                        <a href="{{ route('pendaftar.kartu') }}"
                            class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:border-primary-500 transition-all card-hover">
                            <div
                                class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-500 group-hover:text-white transition-all">
                                <i class="fa-solid fa-id-card text-xl"></i>
                            </div>
                            <h4 class="font-display font-bold text-dark-900">Unduh Kartu</h4>
                            <p class="text-xs text-dark-500 mt-2">Cetak kartu peserta ujian seleksi.</p>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-8">
                    <!-- Info Pendaftaran -->
                    <div class="bg-dark-900 rounded-3xl p-8 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="font-display font-bold text-xl mb-4">Bantuan Teknis?</h3>
                            <p class="text-dark-300 text-sm mb-6 leading-relaxed">Jika mengalami kendala saat pengisian data
                                atau ujian online, hubungi panitia melalui WhatsApp.</p>
                            <a href="https://wa.me/{{ $settings->get('school_phone') }}"
                                class="flex items-center justify-center gap-2 w-full py-3 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-all">
                                <i class="fa-brands fa-whatsapp"></i> Chat Panitia
                            </a>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary-500/10 rounded-full blur-3xl"></div>
                    </div>

                    @php
                        $stepConfig = [];
                        // Step 1: Verifikasi Berkas
                        if (!$registration) {
                            $stepConfig[1] = ['state' => 'pending', 'desc' => 'Lengkapi form pendaftaran SPMB terlebih dahulu.', 'action' => 'Isi Formulir', 'route' => 'spmb'];
                        } elseif ($registration->status === 'rejected') {
                            $stepConfig[1] = ['state' => 'failed', 'desc' => 'Berkas ditolak. Silakan hubungi panitia.', 'action' => null, 'route' => null];
                        } elseif (in_array($registration->status, ['verified', 'lulus'])) {
                            $stepConfig[1] = ['state' => 'completed', 'desc' => 'Berkas telah diverifikasi oleh panitia.', 'action' => null, 'route' => null];
                        } else {
                            $stepConfig[1] = ['state' => 'active', 'desc' => 'Menunggu verifikasi berkas oleh panitia.', 'action' => null, 'route' => null];
                        }

                        // Step 2: Ujian Seleksi Online
                        if (!$registration || $registration->status === 'pending' || $registration->status === 'rejected') {
                            $stepConfig[2] = ['state' => 'pending', 'desc' => 'Tersedia setelah berkas terverifikasi.', 'action' => null, 'route' => null];
                        } elseif ($registration->status === 'verified' && !$examResult) {
                            $stepConfig[2] = ['state' => 'active', 'desc' => 'Silakan ikuti ujian seleksi online sekarang.', 'action' => 'Ikuti Ujian', 'route' => 'pendaftar.ujian.index'];
                        } else {
                            $stepConfig[2] = ['state' => 'completed', 'desc' => 'Ujian seleksi telah selesai.', 'action' => null, 'route' => null];
                        }

                        // Step 3: Pengumuman Kelulusan
                        if (in_array($registration->status ?? '', ['lulus', 'tidak_lulus'])) {
                            if ($registration->status === 'lulus') {
                                $stepConfig[3] = ['state' => 'completed', 'desc' => 'Selamat! Anda dinyatakan lulus seleksi.', 'action' => null, 'route' => null];
                            } else {
                                $stepConfig[3] = ['state' => 'failed', 'desc' => 'Mohon maaf, Anda belum berhasil. Tetap semangat!', 'action' => null, 'route' => null];
                            }
                        } elseif (($registration->status ?? '') === 'verified' && $examResult) {
                            $stepConfig[3] = ['state' => 'active', 'desc' => 'Menunggu pengumuman hasil seleksi oleh panitia.', 'action' => null, 'route' => null];
                        } else {
                            $stepConfig[3] = ['state' => 'pending', 'desc' => 'Belum tersedia.', 'action' => null, 'route' => null];
                        }

                        // Step 4: Pembayaran Daftar Ulang
                        if ($registration && $registration->status === 'lulus') {
                            if ($registration->payment_status === 'paid') {
                                $stepConfig[4] = ['state' => 'completed', 'desc' => 'Pembayaran telah lunas. Selamat bergabung!', 'action' => null, 'route' => null];
                            } else {
                                $stepConfig[4] = ['state' => 'active', 'desc' => 'Silakan lakukan pembayaran daftar ulang.', 'action' => 'Bayar Sekarang', 'route' => 'payment.index'];
                            }
                        } elseif ($registration && $registration->status === 'tidak_lulus') {
                            $stepConfig[4] = ['state' => 'pending', 'desc' => 'Tidak tersedia.', 'action' => null, 'route' => null];
                        } else {
                            $stepConfig[4] = ['state' => 'pending', 'desc' => 'Belum tersedia.', 'action' => null, 'route' => null];
                        }
                    @endphp

                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <h4 class="font-display font-bold text-dark-900 mb-6 uppercase tracking-widest text-[10px]">Alur
                            Selanjutnya</h4>
                        <div class="space-y-0">
                            @foreach ([1 => 'Verifikasi Berkas', 2 => 'Ujian Seleksi Online', 3 => 'Pengumuman Kelulusan', 4 => 'Pembayaran Daftar Ulang'] as $num => $label)
                                @php $s = $stepConfig[$num]; @endphp
                                <div class="flex gap-4 {{ !$loop->last ? 'pb-6' : '' }}">
                                    {{-- Circle & Connector --}}
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold
                                            {{ $s['state'] === 'completed' ? 'bg-emerald-500 text-white' : ($s['state'] === 'active' ? 'bg-primary-500 text-white' : ($s['state'] === 'failed' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-400')) }}
                                            {{ $s['state'] === 'active' ? 'shadow-lg shadow-primary-500/30' : '' }}">
                                            @if ($s['state'] === 'completed')
                                                <i class="fa-solid fa-check text-xs"></i>
                                            @elseif ($s['state'] === 'failed')
                                                <i class="fa-solid fa-xmark text-xs"></i>
                                            @elseif ($s['state'] === 'active')
                                                <div class="flex h-2 w-2">
                                                    <div class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-primary-400 opacity-75"></div>
                                                    <div class="relative inline-flex rounded-full h-2 w-2 bg-white"></div>
                                                </div>
                                            @else
                                                {{ $num }}
                                            @endif
                                        </div>
                                        @if (!$loop->last)
                                            <div class="w-px flex-1 min-h-[24px] mt-1
                                                {{ $s['state'] === 'completed' || ($stepConfig[$num + 1]['state'] ?? '') === 'completed' ? 'bg-emerald-200' : 'bg-gray-200' }}">
                                            </div>
                                        @endif
                                    </div>
                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0 {{ $loop->last ? 'pb-0' : '' }}">
                                        <div class="flex items-center justify-between gap-2">
                                            <h5 class="text-sm font-bold text-dark-900">{{ $label }}</h5>
                                            <span class="text-[10px] font-bold uppercase tracking-widest whitespace-nowrap
                                                {{ $s['state'] === 'completed' ? 'text-emerald-600' : ($s['state'] === 'active' ? 'text-primary-600' : ($s['state'] === 'failed' ? 'text-red-500' : 'text-gray-400')) }}">
                                                {{ $s['state'] === 'completed' ? 'Selesai' : ($s['state'] === 'active' ? 'Berlangsung' : ($s['state'] === 'failed' ? 'Gagal' : 'Menunggu')) }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-dark-500 mt-1 leading-relaxed">{{ $s['desc'] }}</p>
                                        @if ($s['action'] && $s['route'])
                                            <a href="{{ route($s['route']) }}"
                                                class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 text-xs font-bold rounded-xl
                                                {{ $s['state'] === 'active' ? 'bg-primary-500 text-white hover:bg-primary-600' : 'bg-gray-100 text-dark-600 hover:bg-gray-200' }}
                                                transition-all">
                                                {{ $s['action'] }} <i class="fa-solid fa-arrow-right-long text-[10px]"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
