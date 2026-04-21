<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $registrations = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'total' => Registration::count(),
            'pending' => Registration::pending()->count(),
            'verified' => Registration::verified()->count(),
            'rejected' => Registration::rejected()->count(),
        ];

        return view('admin.registrations.index', compact('registrations', 'statusCounts'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        $registration->update($request->validated());

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function export()
    {
        $registrations = Registration::latest()->get();

        $csvData = [];
        $csvData[] = ['ID', 'Nama', 'NISN', 'Asal Sekolah', 'Telepon', 'Email', 'Jenis Kelamin', 'Tanggal Lahir', 'Tempat Lahir', 'Alamat', 'Nama Orang Tua', 'Telepon Orang Tua', 'Status', 'Tanggal Daftar'];

        foreach ($registrations as $reg) {
            $csvData[] = [
                $reg->id,
                $reg->name,
                $reg->nisn,
                $reg->school_origin,
                $reg->phone,
                $reg->email,
                $reg->gender_label,
                $reg->birth_date?->format('d/m/Y'),
                $reg->birth_place,
                $reg->address,
                $reg->parent_name,
                $reg->parent_phone,
                $reg->status_label,
                $reg->created_at->format('d/m/Y H:i'),
            ];
        }

        $filename = 'ppdb_data_' . date('Y-m-d_His') . '.csv';
        $handle = fopen('php://output', 'w');
        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);

        return response()->streamDownload(function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}