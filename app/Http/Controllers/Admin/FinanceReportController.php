<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceReportController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.reports.finance');
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:2020|max:2100',
            'status' => 'nullable|in:paid,pending,overdue,review',
            'payment_method' => 'nullable|in:cash,transfer',
        ]);

        $query = Payment::with(['enrollment', 'enrollment.package', 'invoice'])
            ->orderBy('payment_date', 'desc')
            ->orderBy('created_at', 'desc');

        if ($validated['month'] && $validated['year']) {
            $query->whereYear('payment_date', $validated['year'])
                  ->whereMonth('payment_date', $validated['month']);
        } elseif ($validated['year']) {
            $query->whereYear('payment_date', $validated['year']);
        }

        if ($validated['status']) {
            $query->where('status', $validated['status']);
        }

        if ($validated['payment_method']) {
            $query->where('payment_method', $validated['payment_method']);
        }

        $payments = $query->get();

        // Generate filename
        $filename = 'laporan-keuangan-' . now()->format('Y-m-d-His') . '.csv';

        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];

        // Create callback function for streaming
        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8 to support Indonesian characters in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Title row
            fputcsv($file, ['LAPORAN KEUANGAN IMUMU DAYCARE']);
            fputcsv($file, ['Periode: ' . now()->format('d F Y H:i')]);
            fputcsv($file, []); // Empty row

            // Header row
            fputcsv($file, [
                'No Invoice',
                'Tanggal Bayar',
                'Nama Anak',
                'Nama Orang Tua',
                'Paket',
                'Nominal',
                'Metode',
                'Status'
            ]);

            // Data rows
            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->invoice?->invoice_number ?? '-',
                    $payment->payment_date?->format('d/m/Y') ?? '-',
                    $payment->enrollment->child_name,
                    $payment->enrollment->parent_name,
                    $payment->enrollment->package->label,
                    'Rp ' . number_format($payment->amount, 0, ',', '.'),
                    $payment->payment_method === 'cash' ? 'Cash' : 'Transfer',
                    ucfirst($payment->status),
                ]);
            }

            // Empty row
            fputcsv($file, []);

            // Summary
            $totalPaid = $payments->where('status', 'paid')->sum('amount');
            $totalPending = $payments->where('status', 'pending')->sum('amount');
            $totalOverdue = $payments->where('status', 'overdue')->sum('amount');
            $totalAll = $payments->sum('amount');

            $paidCount = $payments->where('status', 'paid')->count();
            $pendingCount = $payments->where('status', 'pending')->count();
            $overdueCount = $payments->where('status', 'overdue')->count();

            fputcsv($file, ['RINGKASAN']);
            fputcsv($file, []);
            fputcsv($file, ['Total Pendapatan', 'Rp ' . number_format($totalPaid, 0, ',', '.')]);
            fputcsv($file, ['- Cash', 'Rp ' . number_format($payments->where('status', 'paid')->where('payment_method', 'cash')->sum('amount'), 0, ',', '.') . ' (' . $payments->where('status', 'paid')->where('payment_method', 'cash')->count() . ' transaksi)']);
            fputcsv($file, ['- Transfer', 'Rp ' . number_format($payments->where('status', 'paid')->where('payment_method', 'transfer')->sum('amount'), 0, ',', '.') . ' (' . $payments->where('status', 'paid')->where('payment_method', 'transfer')->count() . ' transaksi)']);
            fputcsv($file, []);
            fputcsv($file, ['Pending', 'Rp ' . number_format($totalPending, 0, ',', '.') . ' (' . $pendingCount . ' transaksi)']);
            fputcsv($file, ['Overdue', 'Rp ' . number_format($totalOverdue, 0, ',', '.') . ' (' . $overdueCount . ' transaksi)']);
            fputcsv($file, []);
            fputcsv($file, ['Total Keseluruhan', 'Rp ' . number_format($totalAll, 0, ',', '.') . ' (' . $payments->count() . ' transaksi)']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
