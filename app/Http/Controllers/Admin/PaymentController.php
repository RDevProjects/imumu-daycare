<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['enrollment', 'enrollment.package', 'enrollment.child'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('enrollment', function ($q) use ($search) {
                $q->where('child_name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%");
            });
        }

        $payments = $query->paginate(15);

        // Summary
        $totalTerkumpul = Payment::paid()->sum('amount');
        $totalPending = Payment::pending()->count();
        $totalReview = Payment::review()->count();

        return view('pages.dashboard.pembayaran.index', compact(
            'payments',
            'totalTerkumpul',
            'totalPending',
            'totalReview'
        ));
    }

    public function verify(Payment $payment)
    {
        return view('pages.dashboard.pembayaran.verify', compact('payment'));
    }

    public function markAsPaid(Payment $payment, Request $request)
    {
        $validated = $request->validate([
            'bukti_transfer' => 'nullable|image|max:2048', // 2MB max
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($payment, $validated, $request) {
            $paymentData = [
                'status' => 'paid',
                'payment_date' => $validated['payment_date'] ?? now(),
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'notes' => $validated['notes'] ?? $payment->notes,
            ];

            // Handle file upload
            if ($request->hasFile('bukti_transfer')) {
                $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
                $paymentData['bukti_transfer'] = $path;
            }

            $payment->update($paymentData);

            // Update enrollment status
            $payment->enrollment->update(['status' => 'paid']);

            // Create child record if not exists
            if (!$payment->enrollment->child) {
                Child::create([
                    'enrollment_id' => $payment->enrollment_id,
                    'name' => $payment->enrollment->child_name,
                    'birth_date' => $payment->enrollment->child_birth_date,
                    'gender' => $payment->enrollment->child_gender ?? 'L',
                    'parent_name' => $payment->enrollment->parent_name,
                    'parent_phone' => $payment->enrollment->parent_phone,
                    'status' => 'aktif',
                ]);
            }

            // Create invoice
            if (!$payment->invoice) {
                $date = now()->format('Ymd');
                $count = Invoice::whereDate('created_at', today())->count() + 1;
                $invoiceNumber = 'INV-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

                Invoice::create([
                    'invoice_number' => $invoiceNumber,
                    'payment_id' => $payment->id,
                    'enrollment_id' => $payment->enrollment_id,
                    'issued_date' => now(),
                    'total_amount' => $payment->amount,
                    'status' => 'paid',
                ]);
            }
        });

        return back()->with('success', 'Pembayaran dikonfirmasi sebagai LUNAS!');
    }

    public function markAsCash(Payment $payment)
    {
        DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'paid',
                'payment_date' => now(),
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'payment_method' => 'cash',
            ]);

            $payment->enrollment->update(['status' => 'paid']);

            if (!$payment->enrollment->child) {
                Child::create([
                    'enrollment_id' => $payment->enrollment_id,
                    'name' => $payment->enrollment->child_name,
                    'birth_date' => $payment->enrollment->child_birth_date,
                    'gender' => $payment->enrollment->child_gender ?? 'L',
                    'parent_name' => $payment->enrollment->parent_name,
                    'parent_phone' => $payment->enrollment->parent_phone,
                    'status' => 'aktif',
                ]);
            }

            if (!$payment->invoice) {
                $date = now()->format('Ymd');
                $count = Invoice::whereDate('created_at', today())->count() + 1;
                $invoiceNumber = 'INV-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

                Invoice::create([
                    'invoice_number' => $invoiceNumber,
                    'payment_id' => $payment->id,
                    'enrollment_id' => $payment->enrollment_id,
                    'issued_date' => now(),
                    'total_amount' => $payment->amount,
                    'status' => 'paid',
                ]);
            }
        });

        return back()->with('success', 'Pembayaran cash berhasil dicatat!');
    }

    public function reject(Payment $payment, Request $request)
    {
        $payment->update([
            'status' => 'review',
            'notes' => $request->input('notes', 'Bukti transfer tidak valid'),
        ]);

        return back()->with('success', 'Pembayaran ditandai untuk review.');
    }
}
