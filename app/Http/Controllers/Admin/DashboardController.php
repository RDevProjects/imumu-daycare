<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Enrollment;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnak = Child::count();
        $anakAktif = Child::aktif()->count();
        $enrollmentsPending = Enrollment::pending()->count();
        $paymentsPending = Payment::pending()->count();
        $paymentsPaid = Payment::paid()->count();

        // Recent enrollments
        $recentEnrollments = Enrollment::with('package')
            ->latest()
            ->take(5)
            ->get();

        // Recent payments
        $recentPayments = Payment::with(['enrollment', 'enrollment.child', 'child'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly revenue
        $monthlyRevenue = Payment::paid()
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
