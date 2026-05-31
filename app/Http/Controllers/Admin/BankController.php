<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        Bank::create($validated);

        return back()->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    public function update(Request $request, Bank $bank)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $bank->update($validated);

        return back()->with('success', 'Rekening bank berhasil diperbarui!');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return back()->with('success', 'Rekening bank berhasil dihapus!');
    }

    public function toggleActive(Bank $bank)
    {
        $bank->update(['is_active' => !$bank->is_active]);

        return back()->with('success', 'Status rekening berhasil diubah!');
    }
}
