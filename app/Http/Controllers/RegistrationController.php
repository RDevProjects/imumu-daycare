<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function create()
    {
        $packages = Package::active()->orderBy('name')->orderBy('type')->get();
        return view('pages.daftar', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'child_name' => 'required|string|max:255',
            'child_age' => 'required|string|max:100',
            'child_gender' => 'nullable|in:L,P',
            'address' => 'nullable|string',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,transfer',
            'notes' => 'nullable|string',
        ]);

        // Generate registration number: REG-YYYYMMDD-XXX
        $date = now()->format('Ymd');
        $count = Enrollment::whereDate('created_at', today())->count() + 1;
        $registrationNumber = 'REG-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        // Generate unique history token
        $historyToken = Str::random(32);

        $enrollment = Enrollment::create([
            ...$validated,
            'registration_number' => $registrationNumber,
            'history_token' => $historyToken,
            'status' => 'pending',
        ]);

        return view('pages.daftar-success', compact('enrollment'));
    }
}
