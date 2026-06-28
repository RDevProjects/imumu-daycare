<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payment;

class HistoryController extends Controller
{
    public function show(string $token)
    {
        $enrollment = Enrollment::where('history_token', $token)
            ->with(['package', 'payment.invoice'])
            ->firstOrFail();

        $payments = Payment::with('invoice')
            ->where('enrollment_id', $enrollment->id)
            ->latest()
            ->get();

        return view('pages.riwayat', compact('enrollment', 'payments'));
    }
}
