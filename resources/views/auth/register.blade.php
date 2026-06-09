@extends('layouts.app')
@section('title', 'Daftar Akun Pendaftar - SMP Tunas Harapan')

@section('content')
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-dark-900">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/images/gedung-sekolah.jpeg') }}" alt=""
                class="w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-900 via-dark-900/50 to-dark-900/60"></div>
            {{-- <div class="absolute inset-0 hero-pattern"></div> --}}
        </div>

        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 fade-up visible">
            <div class="text-center mb-8">
                <h2 class="font-display text-2xl font-bold text-dark-900">Registrasi Pendaftar</h2>
                <p class="text-dark-500 text-sm mt-2">Satu akun untuk seluruh proses pendaftaran</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-dark-700 mb-1.5">Nama Lengkap Orang Tua/Wali</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm @error('name') border-red-500 @enderror">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-dark-700 mb-1.5">Email Aktif (Wajib Gmail/Yahoo)</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm @error('email') border-red-500 @enderror">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-dark-700 mb-1.5">Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-3 pr-10 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-dark-700 mb-1.5">Konfirmasi</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 pr-10 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 outline-none transition-all text-sm">
                            <button type="button" onclick="togglePassword('password_confirmation', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-[11px] text-dark-400 mt-1">Minimal 8 karakter.</p>
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex gap-3 mt-4">
                    <i class="fa-solid fa-envelope-circle-check text-blue-500 mt-1"></i>
                    <p class="text-[11px] text-blue-700 leading-relaxed">Sistem akan mengirimkan link verifikasi ke email
                        Anda. Pastikan email bisa dibuka.</p>
                </div>
                <button type="submit"
                    class="w-full py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 shadow-lg mt-4 transition-all">Buat
                    Akun</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endpush
