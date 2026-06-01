<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use OpenSpout\Writer\CSV\Writer as CSVWriter;
use OpenSpout\Writer\XLSX\Writer as XLSXWriter;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Cell\StringCell;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Color;
use Illuminate\Http\Request;

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
            'format' => 'nullable|in:csv,xlsx',
        ]);

        $format = $validated['format'] ?? 'csv';

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

        // Prepare data rows
        $dataRows = [];
        foreach ($payments as $payment) {
            $dataRows[] = [
                $payment->invoice?->invoice_number ?? '-',
                $payment->payment_date?->format('d/m/Y') ?? '-',
                $payment->enrollment->child_name,
                $payment->enrollment->parent_name,
                $payment->enrollment->package->label,
                'Rp ' . number_format($payment->amount, 0, ',', '.'),
                $payment->payment_method === 'cash' ? 'Cash' : 'Transfer',
                ucfirst($payment->status),
            ];
        }

        // Summary data
        $totalPaid = $payments->where('status', 'paid')->sum('amount');
        $totalPending = $payments->where('status', 'pending')->sum('amount');
        $totalOverdue = $payments->where('status', 'overdue')->sum('amount');
        $totalAll = $payments->sum('amount');

        $paidCount = $payments->where('status', 'paid')->count();
        $pendingCount = $payments->where('status', 'pending')->count();
        $overdueCount = $payments->where('status', 'overdue')->count();

        $summaryRows = [
            ['RINGKASAN'],
            [],
            ['Total Pendapatan', 'Rp ' . number_format($totalPaid, 0, ',', '.')],
            ['- Cash', 'Rp ' . number_format($payments->where('status', 'paid')->where('payment_method', 'cash')->sum('amount'), 0, ',', '.') . ' (' . $payments->where('status', 'paid')->where('payment_method', 'cash')->count() . ' transaksi)'],
            ['- Transfer', 'Rp ' . number_format($payments->where('status', 'paid')->where('payment_method', 'transfer')->sum('amount'), 0, ',', '.') . ' (' . $payments->where('status', 'paid')->where('payment_method', 'transfer')->count() . ' transaksi)'],
            [],
            ['Pending', 'Rp ' . number_format($totalPending, 0, ',', '.') . ' (' . $pendingCount . ' transaksi)'],
            ['Overdue', 'Rp ' . number_format($totalOverdue, 0, ',', '.') . ' (' . $overdueCount . ' transaksi)'],
            [],
            ['Total Keseluruhan', 'Rp ' . number_format($totalAll, 0, ',', '.') . ' (' . $payments->count() . ' transaksi)'],
        ];

        $filename = 'laporan-keuangan-' . now()->format('Y-m-d-His');

        if ($format === 'xlsx') {
            return $this->exportXlsx($filename, $dataRows, $summaryRows);
        }

        return $this->exportCsv($filename, $dataRows, $summaryRows);
    }

    private function exportCsv($filename, $dataRows, $summaryRows)
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];

        $callback = function() use ($dataRows, $summaryRows) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, ['LAPORAN KEUANGAN IMUMU DAYCARE']);
            fputcsv($file, ['Periode: ' . now()->format('d F Y H:i')]);
            fputcsv($file, []);

            fputcsv($file, ['No Invoice', 'Tanggal Bayar', 'Nama Anak', 'Nama Orang Tua', 'Paket', 'Nominal', 'Metode', 'Status']);

            foreach ($dataRows as $row) {
                fputcsv($file, $row);
            }

            fputcsv($file, []);
            foreach ($summaryRows as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportXlsx($filename, $dataRows, $summaryRows)
    {
        $filePath = storage_path('app/' . $filename . '.xlsx');

        $writer = new XLSXWriter();

        // OpenSpout v5: Style via constructor
        $headerStyle = new Style(
            fontBold: true,
            fontColor: Color::BLUE,
            cellAlignment: CellAlignment::CENTER,
        );

        $titleStyle = new Style(
            fontBold: true,
            fontSize: 14,
            fontColor: Color::DARK_BLUE,
        );

        // Open file
        $writer->openToFile($filePath);

        // Helper to create row with styled cells
        $createRow = function($values, $style = null) {
            $cells = array_map(function($value) use ($style) {
                return new StringCell((string) $value, $style);
            }, $values);
            return new Row($cells);
        };

        // Title row
        $writer->addRow($createRow(['LAPORAN KEUANGAN IMUMU DAYCARE'], $titleStyle));
        $writer->addRow($createRow(['Periode: ' . now()->format('d F Y H:i')]));
        $writer->addRow($createRow([]));

        // Header row
        $writer->addRow($createRow(['No Invoice', 'Tanggal Bayar', 'Nama Anak', 'Nama Orang Tua', 'Paket', 'Nominal', 'Metode', 'Status'], $headerStyle));

        // Data rows
        foreach ($dataRows as $row) {
            $writer->addRow($createRow($row));
        }

        // Empty row
        $writer->addRow($createRow([]));

        // Summary rows
        foreach ($summaryRows as $row) {
            $writer->addRow($createRow($row));
        }

        $writer->close();

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
