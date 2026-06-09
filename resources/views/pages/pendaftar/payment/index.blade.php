@extends('layouts.app')

@section('title', 'Pembayaran - SMP Tunas Harapan')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-12">
    <div class="max-w-2xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-8 fade-up visible">
            <h1 class="font-display text-3xl font-bold text-dark-900">Pembayaran Daftar Ulang</h1>
            <p class="text-dark-500 mt-1">Selesaikan pembayaran daftar ulang setelah dinyatakan lulus seleksi.</p>
        </div>

        @if (session('error'))
        <div class="p-4 mb-6 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
            {{ session('error') }}
        </div>
        @endif

        @if ($payment && $payment->status === 'success')
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-check text-2xl text-emerald-500"></i>
            </div>
            <h3 class="font-display font-bold text-xl text-dark-900 mb-2">Pembayaran Lunas!</h3>
            <p class="text-dark-500 mb-4">Terima kasih, pembayaran Anda telah dikonfirmasi.</p>
            <div class="flex items-center justify-center gap-3">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-all">
                    Ke Dashboard <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="{{ route('payment.invoice') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white text-dark-700 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all">
                    <i class="fa-solid fa-download"></i> Invoice
                </a>
            </div>
        </div>
        @elseif ($registration->payment_status === 'pending')
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm text-center">
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-clock text-2xl text-amber-500"></i>
            </div>
            <h3 class="font-display font-bold text-xl text-dark-900 mb-2">Menunggu Pembayaran</h3>
            <p class="text-dark-500 mb-6">Pembayaran sedang diproses. Klik tombol di bawah untuk melanjutkan atau coba
                lagi.</p>
            <button id="pay-button" onclick="payNow()"
                class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-all">
                Lanjutkan Pembayaran
            </button>
        </div>
        @else
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8">
                <h3 class="font-display font-bold text-lg text-dark-900 mb-6">Detail Pembayaran</h3>

                <div class="flex justify-between items-center py-4 border-b border-gray-100">
                    <span class="text-dark-500">Nomor Pendaftaran</span>
                    <span class="font-bold text-dark-900">{{ $registration->registration_number }}</span>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100">
                    <span class="text-dark-500">Nama</span>
                    <span class="font-bold text-dark-900">{{ $registration->name }}</span>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100">
                    <span class="text-dark-500">Biaya Daftar Ulang</span>
                    <span class="font-bold text-2xl text-primary-600">{{ $registration->payment_amount_formatted }}</span>
                </div>
                <div class="flex justify-between items-center py-4">
                    <span class="text-dark-500">Status</span>
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold uppercase bg-{{ $registration->payment_status_color }}-100 text-{{ $registration->payment_status_color }}-700">
                        {{ $registration->payment_status_label }}
                    </span>
                </div>
            </div>

            <div class="px-8 pb-8">
                <button id="pay-button" onclick="payNow()"
                    class="w-full py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 shadow-lg transition-all flex items-center justify-center gap-2 text-lg">
                    <i class="fa-solid fa-credit-card"></i>
                    Bayar Sekarang
                </button>
                <p class="text-[11px] text-dark-400 text-center mt-3">
                    Pembayaran diproses melalui Midtrans. Didukung QRIS, Virtual Account, dan metode lainnya.
                </p>
            </div>
        </div>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-primary-500 hover:text-primary-600">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function payNow() {
        const btn = document.getElementById('pay-button');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        fetch('{{ route('payment.create') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function() {
                        window.location.href = '{{ route('payment.success') }}';
                    },
                    onPending: function() {
                        window.location.href = '{{ route('payment.unfinish') }}';
                    },
                    onError: function() {
                        window.location.href = '{{ route('payment.error') }}';
                    },
                    onClose: function() {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-credit-card"></i> Bayar Sekarang';
                    }
                });
            } else {
                alert('Gagal memproses pembayaran: ' + (data.error || 'Unknown error'));
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-credit-card"></i> Bayar Sekarang';
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-credit-card"></i> Bayar Sekarang';
        });
    }
</script>
@endpush
