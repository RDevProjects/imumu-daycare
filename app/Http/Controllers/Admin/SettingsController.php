<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Bank;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::allAsArray();
        $banks = Bank::orderBy('is_active', 'desc')->orderBy('bank_name')->get();

        return view('pages.dashboard.pengaturan', compact('settings', 'banks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'daycare_name' => 'nullable|string|max:255',
            'daycare_address' => 'nullable|string',
            'daycare_phone' => 'nullable|string|max:20',
            'daycare_wa' => 'nullable|string|max:20',
            'wa_contact_name' => 'nullable|string|max:100',
            'daycare_email' => 'nullable|email|max:255',
            'daycare_open_time' => 'nullable|date_format:H:i',
            'daycare_close_time' => 'nullable|date_format:H:i',
            'tarif_pendaftaran' => 'nullable|numeric|min:0',
            'wa_template_konfirmasi' => 'nullable|string',
            'invoice_header_text' => 'nullable|string',
            'invoice_footer_text' => 'nullable|string',
        ]);

        // Filter out null values and empty strings
        $validated = array_filter($validated, fn($v) => $v !== null && $v !== '');

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Determine which tab to return to
        $activeSection = 'profil';
        if (isset($validated['daycare_wa']) || isset($validated['daycare_name']) || isset($validated['daycare_address'])) {
            $activeSection = 'daycare';
        } elseif (isset($validated['tarif_pendaftaran'])) {
            $activeSection = 'tarif';
        } elseif (isset($validated['wa_template_konfirmasi'])) {
            $activeSection = 'notifikasi';
        }

        return back()->with(['success' => 'Pengaturan berhasil disimpan!', 'active_section' => $activeSection]);
    }

    public function updateAdminProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;

        if (!empty($validated['new_password'])) {
            if (!\Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
            $user->password = \Hash::make($validated['new_password']);
        }

        $user->save();

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }
}
