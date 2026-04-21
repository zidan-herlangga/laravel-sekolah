<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        private SettingService $settingService
    ) {}

    public function index()
    {
        $settings = $this->settingService->getAll();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_short_name' => 'required|string|max:20',
            'school_motto' => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:500',
            'school_phone' => 'nullable|string|max:50',
            'school_email' => 'nullable|email|max:255',
            'school_facebook' => 'nullable|url|max:255',
            'school_instagram' => 'nullable|url|max:255',
            'school_youtube' => 'nullable|url|max:255',
            'school_tiktok' => 'nullable|url|max:255',
            'ppdb_info' => 'nullable|string|max:2000',
            'headmaster_welcome' => 'nullable|string|max:5000',
        ]);

        $fields = [
            'school_name', 'school_short_name', 'school_motto',
            'school_address', 'school_phone', 'school_email',
            'school_facebook', 'school_instagram', 'school_youtube', 'school_tiktok',
            'ppdb_info', 'headmaster_welcome',
        ];

        foreach ($fields as $field) {
            $this->settingService->set($field, $request->input($field, ''));
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}