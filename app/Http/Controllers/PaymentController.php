<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Payment;
use App\Services\SettingService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $registration = Registration::where('user_id', Auth::id())->first();

        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Anda belum mendaftar.');
        }

        if ($registration->status !== 'lulus') {
            return redirect()->route('dashboard')->with('error', 'Pembayaran daftar ulang hanya dapat dilakukan setelah dinyatakan lulus.');
        }

        if (!$registration->payment_amount) {
            return redirect()->route('dashboard')->with('error', 'Biaya daftar ulang belum ditentukan. Hubungi panitia.');
        }

        $payment = Payment::where('registration_id', $registration->id)->latest()->first();

        if ($payment && $payment->status === 'pending' && $payment->snap_token) {
            try {
                \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
                \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
                \Midtrans\Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => false,
                ];
                $transactionStatus = \Midtrans\Transaction::status($payment->transaction_id);
                $status = $transactionStatus->transaction_status ?? '';

                if (in_array($status, ['capture', 'settlement'])) {
                    $payment->update([
                        'status' => 'success',
                        'paid_at' => now(),
                        'raw_response' => json_decode(json_encode($transactionStatus), true),
                    ]);
                    $registration->update([
                        'payment_status' => 'paid',
                        'paid_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                // Midtrans API tidak tersedia, gunakan status lokal
            }
        }

        return view('pages.pendaftar.payment.index', compact('registration', 'payment'));
    }

    public function create()
    {
        $registration = Registration::where('user_id', Auth::id())->first();

        if (!$registration || !$registration->payment_amount) {
            return redirect()->route('dashboard')->with('error', 'Data tidak ditemukan.');
        }

        if ($registration->status !== 'lulus') {
            return response()->json(['error' => 'Pembayaran daftar ulang hanya dapat dilakukan setelah dinyatakan lulus.'], 403);
        }

        if ($registration->payment_status === 'paid') {
            return redirect()->route('dashboard')->with('success', 'Pembayaran sudah lunas.');
        }

        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
        ];

        $orderId = 'REG-' . $registration->registration_number . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $registration->payment_amount,
            ],
            'customer_details' => [
                'first_name' => $registration->name,
                'email' => $registration->email ?? auth()->user()->email,
                'phone' => $registration->phone,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $payment = Payment::create([
                'registration_id' => $registration->id,
                'user_id' => Auth::id(),
                'amount' => $registration->payment_amount,
                'status' => 'pending',
                'transaction_id' => $orderId,
                'snap_token' => $snapToken,
                'expired_at' => now()->addHours(24),
            ]);

            $registration->update(['payment_status' => 'pending']);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('transaction_id', $request->order_id)->first();
        if (!$payment) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $registration = $payment->registration;

        if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
            $payment->update([
                'status' => 'success',
                'paid_at' => now(),
                'raw_response' => $request->all(),
            ]);
            $registration->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);
        } elseif ($request->transaction_status === 'expire') {
            $payment->update(['status' => 'expired']);
            $registration->update(['payment_status' => 'unpaid']);
        } elseif ($request->transaction_status === 'deny' || $request->transaction_status === 'cancel') {
            $payment->update(['status' => 'failed']);
            $registration->update(['payment_status' => 'unpaid']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function success()
    {
        $registration = Registration::where('user_id', Auth::id())->first();

        if ($registration) {
            $payment = Payment::where('registration_id', $registration->id)
                ->where('status', 'pending')
                ->latest()
                ->first();

            if ($payment) {
                $payment->update([
                    'status' => 'success',
                    'paid_at' => now(),
                ]);
                $registration->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Pembayaran daftar ulang berhasil! Selamat bergabung.');
    }

    public function downloadInvoice()
    {
        $registration = Registration::where('user_id', Auth::id())->first();
        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $payment = Payment::where('registration_id', $registration->id)
            ->where('status', 'success')
            ->latest()
            ->first();

        if (!$payment) {
            return redirect()->route('payment.index')->with('error', 'Belum ada pembayaran yang lunas.');
        }

        $settings = app(SettingService::class);

        $pdf = Pdf::loadView('pages.pendaftar.pdf.invoice', compact('payment', 'registration', 'settings'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Invoice_' . $payment->transaction_id . '.pdf');
    }

    public function unfinish()
    {
        return redirect()->route('payment.index')->with('error', 'Pembayaran belum selesai. Silakan coba lagi.');
    }

    public function error()
    {
        return redirect()->route('payment.index')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }
}
