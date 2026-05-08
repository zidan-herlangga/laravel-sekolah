@extends('layouts.app')

@section('title', 'Pendaftaran Online - ' . $settings->get('school_name'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-dark-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('assets/images/pattern-dots.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <span
                class="inline-block px-4 py-1.5 bg-primary-500/10 text-primary-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6 border border-primary-500/20">
                Admission 2026/2027
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                Pendaftaran <span class="text-primary-500">Siswa Baru</span>
            </h1>
            <p class="text-dark-300 max-w-2xl mx-auto text-lg leading-relaxed">
                Langkah awal menuju masa depan gemilang dimulai di sini. Lengkapi data diri Anda untuk memulai proses
                seleksi.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-20 bg-gray-50/50">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <!-- Requirement Sidebar & Form Grid -->
            <div class="grid lg:grid-cols-12 gap-12">

                <!-- Sidebar Info -->
                <aside class="lg:col-span-4 space-y-8">
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm sticky top-32">
                        <h3 class="font-display font-bold text-dark-900 mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-list-check text-primary-500"></i>
                            Persyaratan
                        </h3>
                        <ul class="space-y-4">
                            @foreach (['Scan Kartu Keluarga', 'Scan Ijazah / SKL', 'Scan Akta Kelahiran', 'Pas Foto Digital', 'Rapor Semester 1-5', 'NISN 10 Digit'] as $req)
                                <li class="flex items-start gap-3">
                                    <div
                                        class="mt-1 w-5 h-5 bg-emerald-50 rounded-full flex items-center justify-center flex-shrink-0 text-[10px] text-emerald-600">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <span class="text-dark-600 text-xs font-medium">{{ $req }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-10 pt-8 border-t border-gray-50">
                            <p class="text-xs text-dark-400 leading-relaxed italic">
                                * Pastikan dokumen dalam format PDF atau JPG dengan ukuran maksimal 2MB per file.
                            </p>
                        </div>
                    </div>
                </aside>

                <!-- Form Section -->
                <div class="lg:col-span-8">
                    <form method="POST" action="{{ route('pendaftar.spmb.store') }}" id="spmb-form"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Section 1: Data Pribadi -->
                        <div
                            class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-gray-100 shadow-xl shadow-primary-900/5">
                            <div class="flex items-center gap-4 mb-10">
                                <div
                                    class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary-500/30">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-dark-900 text-xl">Identitas Calon Siswa</h3>
                                    <p class="text-xs text-dark-400 uppercase tracking-widest font-bold mt-1">Lengkapi data
                                        diri sesuai Akta/KK</p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 focus:ring-4 focus:ring-primary-400/10 outline-none transition-all text-sm font-medium @error('name') border-red-300 @enderror"
                                        placeholder="Masukkan nama sesuai ijazah">
                                    @error('name')
                                        <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">NISN (10
                                        Digit)</label>
                                    <input type="text" name="nisn" value="{{ old('nisn') }}" maxlength="10" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 focus:ring-4 focus:ring-primary-400/10 outline-none transition-all text-sm font-medium"
                                        placeholder="0012345678">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Jenis
                                        Kelamin</label>
                                    <select name="gender" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                        <option value="">Pilih...</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Tempat
                                        Lahir</label>
                                    <input type="text" name="birth_place" value="{{ old('birth_place') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium"
                                        placeholder="Kota Kelahiran">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Tanggal
                                        Lahir</label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Kontak & Alamat -->
                        <div
                            class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-gray-100 shadow-xl shadow-primary-900/5">
                            <div class="flex items-center gap-4 mb-10">
                                <div
                                    class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-500/30">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-dark-900 text-xl">Kontak & Alamat</h3>
                                    <p class="text-xs text-dark-400 uppercase tracking-widest font-bold mt-1">Informasi
                                        tempat tinggal pendaftar</p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Asal
                                        Sekolah</label>
                                    <input type="text" name="school_origin" value="{{ old('school_origin') }}"
                                        placeholder="SD/MI Asal" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">No. HP
                                        WhatsApp</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="0812..."
                                        required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                                {{-- email --}}
                                <div class="md:col-span-2 space-y-2">
                                    <label
                                        class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="email@contoh.com" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                                {{-- parent name --}}
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Nama
                                        Orang Tua</label>
                                    <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                                        placeholder="Nama lengkap orang tua" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                                {{-- phone parent --}}
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">No. HP
                                        Orang Tua</label>
                                    <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}"
                                        placeholder="0812..." required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium">
                                </div>
                                {{-- address --}}
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-dark-400 ml-1">Alamat
                                        Lengkap</label>
                                    <textarea name="address" rows="3" required
                                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-primary-400 outline-none transition-all text-sm font-medium resize-none"
                                        placeholder="Nama jalan, RT/RW, Kecamatan, Kota">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Upload Berkas -->
                        <div
                            class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-gray-100 shadow-xl shadow-primary-900/5">
                            <div class="flex items-center gap-4 mb-10">
                                <div
                                    class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-dark-900 text-xl">Berkas Pendukung</h3>
                                    <p class="text-xs text-dark-400 uppercase tracking-widest font-bold mt-1">Pastikan
                                        dokumen terbaca jelas</p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                @foreach ([['kartu_keluarga', 'Scan Kartu Keluarga'], ['ijazah', 'Scan Ijazah / SKL'], ['akte_kelahiran', 'Scan Akte Kelahiran']] as $file)
                                    <div
                                        class="p-6 rounded-2xl border-2 border-dashed border-gray-100 hover:border-primary-200 transition-colors">
                                        <label class="block">
                                            <span
                                                class="text-xs font-black uppercase tracking-widest text-dark-400 block mb-3">{{ $file[1] }}
                                                <span class="text-red-500">*</span></span>
                                            <input type="file" name="{{ $file[0] }}"
                                                accept=".pdf,.jpg,.jpeg,.png" required
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-all cursor-pointer">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CTA Section -->
                        <div class="bg-primary-900 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden">
                            <div class="relative z-10">
                                <h4 class="font-display font-bold text-xl mb-4 italic">Pernyataan Kejujuran</h4>
                                <p class="text-primary-100 text-sm leading-relaxed mb-8">
                                    Dengan menekan tombol daftar di bawah, saya menyatakan bahwa seluruh data yang saya
                                    isikan adalah benar dan dapat dipertanggungjawabkan sesuai hukum yang berlaku.
                                </p>
                                <button type="submit" id="submit-btn"
                                    class="w-full py-5 bg-primary-500 text-white font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-primary-400 transition-all transform active:scale-95 shadow-xl shadow-black/20 flex items-center justify-center gap-3">
                                    <span>Kirim Pendaftaran</span>
                                    <i class="fa-solid fa-paper-plane text-sm"></i>
                                </button>
                            </div>
                            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary-500/10 rounded-full blur-3xl">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('spmb-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses...';
        });
    </script>
@endpush
