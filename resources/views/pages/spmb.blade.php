@extends('layouts.app')

@section('title', 'SPMB Online - ' . $settings->get('school_name'))

@section('content')

    <!-- Hero -->
    <section class="relative pt-32 pb-16 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0"><img src="https://picsum.photos/seed/spmb-hero/1920/600" alt=""
                class="w-full h-full object-cover opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 to-dark-900"></div>
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-400/10 border border-primary-400/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                <span class="text-primary-300 text-xs font-semibold uppercase tracking-widest">Dibuka</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Pendaftaran Siswa Baru
            </h1>
            <p class="text-dark-300 max-w-2xl mx-auto">Beranda > <a href="{{ route('spmb') }}"
                    class="text-primary-400 hover:text-primary-500">SPMB</a></p>
        </div>
    </section>

    <!-- Info -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="fade-up text-center p-8 bg-gray-50 rounded-2xl">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-primary-500 text-2xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-dark-900 mb-2">Jadwal Pendaftaran</h3>
                    <p class="text-dark-500 text-sm">1 Januari - 30 Juni 2025</p>
                </div>
                <div class="fade-up text-center p-8 bg-gray-50 rounded-2xl">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-primary-500 text-2xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-dark-900 mb-2">Kuota Penerimaan</h3>
                    <p class="text-dark-500 text-sm">SMP: 120 siswa | SMA: 144 siswa</p>
                </div>
                <div class="fade-up text-center p-8 bg-gray-50 rounded-2xl">
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-primary-500 text-2xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-dark-900 mb-2">Biaya Pendaftaran</h3>
                    <p class="text-dark-500 text-sm">Gratis (tanpa biaya pendaftaran)</p>
                </div>
            </div>

            <!-- Persyaratan -->
            <div class="fade-up bg-dark-900 rounded-3xl p-10 mb-16">
                <h2 class="font-display text-2xl font-bold text-white mb-6 text-center">Persyaratan Pendaftaran</h2>
                <div class="grid md:grid-cols-2 gap-4 max-w-3xl mx-auto">
                    @foreach (['Ijazah / Surat Keterangan Lulus', 'Akta Kelahiran', 'Kartu Keluarga', 'Pas Foto 3x4 (4 lembar)', 'Surat Keterangan Sehat', 'Nilai Rapor Semester 1-5', 'NISN (Nomor Induk Siswa Nasional)', 'Surat Pernyataan Orang Tua'] as $req)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 bg-primary-400/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-primary-400 text-xs"></i>
                            </div>
                            <span class="text-dark-300 text-sm">{{ $req }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Form -->
            <div class="fade-up max-w-4xl mx-auto">
                <div class="text-center mb-10">
                    <h2 class="font-display text-3xl font-bold text-dark-900 tracking-tight mb-3">Formulir Pendaftaran
                        Online</h2>
                    <p class="text-dark-500">Isilah formulir berikut dengan data yang benar dan lengkap.</p>
                </div>

                <form method="POST" action="{{ route('spmb.store') }}" id="spmb-form" novalidate>
                    @csrf

                    <div class="bg-white border border-gray-200 rounded-3xl p-8 md:p-10 shadow-sm">
                        <!-- Data Pribadi -->
                        <h3 class="font-display font-bold text-dark-900 text-lg mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 bg-primary-400 text-white rounded-lg flex items-center justify-center text-sm font-bold">1</span>
                            Data Pribadi
                        </h3>

                        <div class="grid md:grid-cols-2 gap-5 mb-8">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('name') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">NISN <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nisn" pattern="\d{10}" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    title="NISN harus berupa 10 digit angka" value="{{ old('nisn') }}" required
                                    maxlength="10"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('nisn') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="10 digit NISN">
                                @error('nisn')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Jenis Kelamin <span
                                        class="text-red-500">*</span></label>
                                <select name="gender" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('gender') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" {{ old('gender') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Tempat Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="birth_place" value="{{ old('birth_place') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('birth_place') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="Kota tempat lahir">
                                @error('birth_place')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Tanggal Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('birth_date') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror">
                                @error('birth_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Asal Sekolah <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="school_origin" value="{{ old('school_origin') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('school_origin') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="Nama SMP/SMA asal">
                                @error('school_origin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nomor Telepon <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('phone') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('email') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="email@contoh.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Alamat Lengkap <span
                                        class="text-red-500">*</span></label>
                                <textarea name="address" required rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm resize-none @error('address') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="Alamat lengkap sesuai KK">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <h3 class="font-display font-bold text-dark-900 text-lg mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 bg-primary-400 text-white rounded-lg flex items-center justify-center text-sm font-bold">2</span>
                            Data Orang Tua
                        </h3>

                        <div class="grid md:grid-cols-2 gap-5 mb-8">
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nama Orang Tua/Wali <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="parent_name" value="{{ old('parent_name') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('parent_name') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="Nama ayah/ibu/wali">
                                @error('parent_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nomor Telepon Orang Tua <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 outline-none transition-all text-sm @error('parent_phone') border-red-300 focus:border-red-400 focus:ring-red-400/20 @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('parent_phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex items-start gap-3 p-5 bg-amber-50 border border-amber-200 rounded-xl mb-8">
                            <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                            <p class="text-sm text-amber-700">Pastikan semua data yang Anda masukkan sudah benar. Data yang
                                sudah dikirim tidak dapat diubah kecuali melalui konfirmasi ke panitia SPMB.</p>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full md:w-auto px-10 py-4 bg-primary-400 text-white font-semibold rounded-xl hover:bg-primary-500 hover:shadow-lg hover:shadow-primary-400/30 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Client-side validation feedback for better UX
        document.getElementById('spmb-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
        });
    </script>

@endsection
