@extends('layouts.app')

@section('title', 'Cek Status SPMB - ' . $settings->get('school_name'))

@section('content')
    <!-- Content -->
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

                    <form method="POST" action="{{ route('pendaftar.cek-status.check') }}" id="cek-form">
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
                        $status = $reg->status;
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
                                Data Anda telah diverifikasi lengkap. Silakan perhatikan jadwal tes dan informasi pembayaran
                                di bawah.
                            @elseif($status === 'rejected')
                                Mohon maaf, pendaftaran Anda tidak dapat kami proses karena belum memenuhi persyaratan.
                            @else
                                Data Anda sudah kami terima dan sedang dalam tahap peninjauan oleh panitia.
                            @endif
                        </p>
                    </div>

                    {{-- CARD JADWAL TES & INFORMASI (KHUSUS STATUS VERIFIED) --}}
                    @if ($status === 'verified')
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-6 text-center">
                            <h4 class="font-bold text-emerald-800 mb-4 flex items-center justify-center gap-2">
                                <i class="fas fa-calendar-check"></i> JADWAL TES & INFORMASI
                            </h4>
                            {{-- Kolom 'notes' berisi pesan dari admin saat klik tombol verifikasi --}}
                            <p class="text-emerald-900 font-medium text-lg mb-2 leading-relaxed">
                                {!! nl2br(e($reg->notes)) !!}
                            </p>

                            {{-- Informasi Pembayaran Hardcoded atau dari Settings --}}
                            <div class="mt-4 pt-4 border-t border-emerald-200/50 text-sm text-emerald-800">
                                <strong>Informasi Pembayaran:</strong><br>
                                Silakan lakukan pembayaran uang pangkal sebelum tanggal tes di Bank BNI No. Rek: 1234567890
                                a.n Yayasan Sekolah. <br>
                                Bukti transfer ditunjukkan pada saat tes.
                            </div>
                        </div>
                    @endif

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

                            {{-- Tampilkan Alasan Jika Ditolak --}}
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
                            {{-- GANTI TOMBOL INI DENGAN FORM --}}
                            <form method="GET" action="{{ route('pendaftar.cek-status.pdf') }}" class="w-full">
                                {{-- Kita kirim NISN secara rahasia (hidden) --}}
                                <input type="hidden" name="nisn" value="{{ $reg->nisn }}">

                                <button type="submit"
                                    class="w-full py-4 bg-dark-900 text-white font-semibold rounded-xl hover:bg-dark-800 transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-file-pdf"></i> Unduh Bukti Pendaftaran (PDF)
                                </button>
                            </form>
                        @elseif($status === 'rejected')
                            <a href="{{ route('contact') }}"
                                class="w-full py-4 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors text-center flex items-center justify-center gap-2">
                                <i class="fas fa-info-circle"></i> Hubungi Panitia
                            </a>
                        @endif
                        <a href="{{ route('pendaftar.cek-status') }}"
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
                            <a href="{{ route('pendaftar.cek-status') }}"
                                class="text-sm text-dark-500 hover:underline font-medium">Gunakan NISN Lain</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
