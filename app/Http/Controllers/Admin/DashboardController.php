<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnak = \App\Models\Child::count();
        $anakAktif = \App\Models\Child::aktif()->count();
        $enrollmentsPending = \App\Models\Enrollment::pending()->count();
        $paymentsPending = \App\Models\Payment::pending()->count();
        $paymentsPaid = \App\Models\Payment::paid()->count();

        // Recent enrollments
        $recentEnrollments = \App\Models\Enrollment::with('package')
            ->latest()
            ->take(5)
            ->get();

        // Recent payments
        $recentPayments = \App\Models\Payment::with(['enrollment', 'enrollment.child'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly revenue
        $monthlyRevenue = \App\Models\Payment::paid()
            ->whereMonth('payment_date', now()->month)
            ->sum('amount');

        return view('pages.dashboard.index', compact(
            'totalAnak',
            'anakAktif',
            'enrollmentsPending',
            'paymentsPending',
            'paymentsPaid',
            'recentEnrollments',
            'recentPayments',
            'monthlyRevenue'
        ));
    }
}
