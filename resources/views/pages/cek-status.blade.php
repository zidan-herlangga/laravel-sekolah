@extends('layouts.app')

@section('title', 'Cek Status SPMB - ' . $settings->get('school_name'))

@section('content')
    <section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://picsum.photos/id/20/1920/600" alt="" class="w-full h-full object-cover opacity-25">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-400/10 border border-primary-400/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                <span class="text-primary-300 text-xs font-semibold uppercase tracking-widest">Verifikasi Data</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Cek Status SPMB</h1>
            <p class="text-dark-300 max-w-2xl mx-auto">
                Beranda > <a href="{{ route('spmb') }}" class="text-primary-400 hover:text-primary-500">SPMB</a> > Cek
                Status
            </p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-3xl p-8 md:p-10 shadow-lg">

                {{-- 1. FORM PENCARIAN --}}
                @if (!session('registration') && !session('not_found'))
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 bg-primary-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-primary-500 text-4xl"></i>
                        </div>
                        <h2 class="font-display text-2xl font-bold text-dark-900 tracking-tight mb-2">Verifikasi Data
                            Pendaftaran</h2>
                        <p class="text-dark-500">Masukkan 10 digit NISN Anda untuk mengecek status pendaftaran.</p>
                    </div>

                    <form method="POST" action="{{ route('cek-status.check') }}" id="cek-form">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-2">NISN <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nisn" value="{{ old('nisn') }}"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-base text-center font-medium tracking-wider @error('nisn') border-red-300 @enderror"
                                    placeholder="Contoh: 0041234567">
                                @error('nisn')
                                    <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-search"></i> Cek Status Saya
                            </button>
                        </div>
                    </form>
                @endif

                {{-- 2. HASIL JIKA DATA DITEMUKAN --}}
                @if (session('registration'))
                    @php
                        $reg = session('registration');
                        // Tentukan variabel berdasarkan status
                        $status = $reg->status; // verified, rejected, pending (default)
                    @endphp

                    <div class="text-center mb-8">
                        {{-- Icon Dinamis --}}
                        <div
                            class="w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-4 
                            {{ $status === 'verified' ? 'bg-emerald-100' : ($status === 'rejected' ? 'bg-red-100' : 'bg-amber-100') }}">
                            <i
                                class="fas text-4xl 
                                {{ $status === 'verified' ? 'fa-user-check text-emerald-500' : ($status === 'rejected' ? 'fa-user-times text-red-500' : 'fa-clock text-amber-500') }}">
                            </i>
                        </div>

                        {{-- Judul Dinamis --}}
                        <h3
                            class="font-display text-2xl font-bold mb-2 uppercase
                            {{ $status === 'verified' ? 'text-emerald-600' : ($status === 'rejected' ? 'text-red-600' : 'text-amber-600') }}">
                            @if ($status === 'verified')
                                SELAMAT, DATA TERVERIFIKASI!
                            @elseif($status === 'rejected')
                                MAAF, PENDAFTARAN DITOLAK
                            @else
                                DATA SEDANG DIPROSES
                            @endif
                        </h3>

                        {{-- Pesan Dinamis --}}
                        <p class="text-dark-500">
                            @if ($status === 'verified')
                                Data Anda telah divalidasi. Silakan cetak bukti pendaftaran untuk daftar ulang.
                            @elseif($status === 'rejected')
                                Mohon maaf, pendaftaran Anda tidak dapat kami proses karena belum memenuhi persyaratan.
                            @else
                                Data Anda sudah kami terima dan sedang dalam tahap peninjauan oleh panitia.
                            @endif
                        </p>
                    </div>

                    {{-- Card Detail --}}
                    <div
                        class="border rounded-2xl p-6 mb-8
                        {{ $status === 'verified' ? 'bg-emerald-50 border-emerald-200' : ($status === 'rejected' ? 'bg-red-50 border-red-200' : 'bg-amber-50 border-amber-200') }}">
                        <h4 class="font-display font-bold text-dark-900 mb-4 flex items-center gap-2">
                            <i
                                class="fas fa-clipboard-list {{ $status === 'verified' ? 'text-emerald-600' : ($status === 'rejected' ? 'text-red-600' : 'text-amber-600') }}"></i>
                            Data Pendaftaran
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-black/5 pb-3">
                                <span class="text-dark-500 text-sm">Nama</span>
                                <span class="font-semibold text-dark-900 text-sm">{{ $reg->name }}</span>
                            </div>
                            <div class="flex justify-between border-b border-black/5 pb-3">
                                <span class="text-dark-500 text-sm">NISN</span>
                                <span class="font-mono font-semibold text-dark-900 text-sm">{{ $reg->nisn }}</span>
                            </div>
                            <div class="flex justify-between border-b border-black/5 pb-3">
                                <span class="text-dark-500 text-sm">Status Saat Ini</span>
                                <span
                                    class="font-bold text-sm uppercase
                                    {{ $status === 'verified' ? 'text-emerald-600' : ($status === 'rejected' ? 'text-red-600' : 'text-amber-600') }}">
                                    {{ $status === 'verified' ? 'Terverifikasi' : ($status === 'rejected' ? 'Ditolak' : 'Pending') }}
                                </span>
                            </div>

                            {{-- Tampilkan Alasan Jika Ditolak (Opsional, jika Anda punya kolom 'reason' di DB) --}}
                            @if ($status === 'rejected' && $reg->notes)
                                <div class="pt-3">
                                    <span class="text-red-700 text-xs font-bold uppercase">Catatan Panitia:</span>
                                    <p class="text-red-600 text-sm mt-1 italic">"{{ $reg->notes }}"</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        @if ($status === 'verified')
                            <button onclick="window.print()"
                                class="w-full py-4 bg-dark-900 text-white font-semibold rounded-xl hover:bg-dark-800 transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-print"></i> Cetak Bukti Pendaftaran
                            </button>
                        @elseif($status === 'rejected')
                            <a href="{{ route('contact') }}"
                                class="w-full py-4 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors text-center flex items-center justify-center gap-2">
                                <i class="fas fa-info-circle"></i> Hubungi Panitia
                            </a>
                        @endif
                        <a href="{{ route('cek-status') }}"
                            class="text-center text-sm text-dark-500 hover:underline font-medium">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                @endif

                {{-- 3. HASIL JIKA TIDAK DITEMUKAN --}}
                @if (session('not_found'))
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-question-circle text-gray-400 text-4xl"></i>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-dark-900 mb-2">NISN TIDAK DITEMUKAN</h3>
                        <p class="text-dark-500 mb-8">Sistem tidak menemukan data dengan NISN tersebut. Pastikan Anda sudah
                            mengisi formulir SPMB.</p>

                        <div class="flex flex-col gap-3">
                            <a href="{{ route('spmb') }}"
                                class="w-full py-4 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 transition-colors">
                                Daftar SPMB Sekarang
                            </a>
                            <a href="{{ route('cek-status') }}"
                                class="text-sm text-dark-500 hover:underline font-medium">Gunakan NISN Lain</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
