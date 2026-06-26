<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentDate;
use App\Models\Invoice;
use App\Models\Child;
use App\Models\Bank;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['enrollment.package', 'enrollment.child', 'child'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_type')) {
            $query->where('payment_type', $request->payment_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('enrollment', fn($q) => $q->where('child_name', 'like', "%{$search}%")->orWhere('parent_name', 'like', "%{$search}%"))
                  ->orWhereHas('child', fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('parent_name', 'like', "%{$search}%"));
            });
        }

        $payments = $query->paginate(15);

        $totalTerkumpul = Payment::paid()->sum('amount');
        $totalPending = Payment::pending()->count();
        $totalReview = Payment::review()->count();

        $activePaymentType = $request->payment_type;

        return view('pages.dashboard.pembayaran.index', compact(
            'payments',
            'totalTerkumpul',
            'totalPending',
            'totalReview',
            'activePaymentType'
        ));
    }

    public function verify(Payment $payment)
    {
        $payment->load(['enrollment.package', 'enrollment.child', 'child', 'dates']);
        return view('pages.dashboard.pembayaran.verify', compact('payment'));
    }

    public function markAsPaid(Payment $payment, Request $request)
    {
        $validated = $request->validate([
            'bukti_transfer' => 'nullable|image|max:2048',
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

            if ($request->hasFile('bukti_transfer')) {
                $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
                $paymentData['bukti_transfer'] = $path;
            }

            $payment->update($paymentData);

            if ($payment->payment_type === 'registration' && $payment->enrollment) {
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

            if ($payment->payment_type === 'registration' && $payment->enrollment) {
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

    public function showChildCalendar(Request $request, Child $child)
    {
        $child->load(['enrollment.package', 'paymentDates.payment']);

        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $paidDates = PaymentDate::where('child_id', $child->id)
            ->whereHas('payment', fn($q) => $q->where('status', 'paid'))
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->values()
            ->toArray();

        $pendingDates = PaymentDate::where('child_id', $child->id)
            ->whereHas('payment', fn($q) => $q->where('status', 'pending'))
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->values()
            ->toArray();

        $dailyRate = $child->enrollment?->package?->price ?? 0;
        $packageType = $child->enrollment?->package?->type ?? 'harian';

        return view('pages.dashboard.pembayaran.child-calendar', compact(
            'child', 'month', 'year', 'paidDates', 'pendingDates', 'dailyRate', 'packageType'
        ));
    }

    public function storeRecurring(Request $request, Child $child)
    {
        if (is_string($request->input('dates'))) {
            $request->merge(['dates' => json_decode($request->input('dates'), true) ?? []]);
        }

        $validated = $request->validate([
            'dates' => 'nullable|array',
            'dates.*' => 'date|distinct',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer',
            'bukti_transfer' => 'nullable|image|max:2048',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $child->load('enrollment');

        DB::transaction(function () use ($validated, $child, $request) {
            $paymentType = $child->enrollment?->package?->type ?? 'bulanan';

            $payment = Payment::create([
                'child_id' => $child->id,
                'enrollment_id' => $child->enrollment_id,
                'payment_type' => $paymentType,
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'due_date' => now()->addDays(7),
                'payment_date' => $validated['payment_date'] ?? now(),
                'status' => 'paid',
                'bukti_transfer' => $request->hasFile('bukti_transfer')
                    ? $request->file('bukti_transfer')->store('bukti-transfer', 'public')
                    : null,
                'notes' => $validated['notes'] ?? null,
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            if (!empty($validated['dates'])) {
                foreach ($validated['dates'] as $date) {
                    PaymentDate::create([
                        'child_id' => $child->id,
                        'payment_id' => $payment->id,
                        'date' => $date,
                    ]);
                }
            }

            $date = now()->format('Ymd');
            $count = Invoice::whereDate('created_at', today())->count() + 1;
            $invoiceNumber = 'INV-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

            Invoice::create([
                'invoice_number' => $invoiceNumber,
                'payment_id' => $payment->id,
                'enrollment_id' => $child->enrollment_id,
                'issued_date' => now(),
                'total_amount' => $payment->amount,
                'status' => 'paid',
            ]);
        });

        return redirect()->route('dashboard.pembayaran.child', $child)
            ->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function waPreview(Request $request, Child $child)
    {
        $child->load('enrollment.package');

        $datesRaw = $request->input('dates', []);
        $dates = is_string($datesRaw) ? (json_decode($datesRaw, true) ?? []) : $datesRaw;
        $amount = $request->input('amount', 0);
        $paymentType = $child->enrollment?->package?->type ?? 'bulanan';

        $template = Setting::get('wa_template_' . $paymentType)
            ?? "Assalamu'alaikum {parent_title} {parent_name}!\n\nPembayaran {payment_type} untuk {child_name}:\nTanggal: {dates}\nBiaya: {amount}\n\nTransfer ke:\n{bank_info}\n\nSetelah transfer, kirimkan buktinya ke sini ya.";

        $banks = Bank::active()->get();
        $bankInfo = $banks->map(fn($b) => "{$b->bank_name} - {$b->account_number} a.n. {$b->account_name}")->join("\n");

        $cleanPhone = preg_replace('/[^0-9+]/', '', $child->parent_phone);
        $cleanPhone = ltrim($cleanPhone, '+');
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }

        $coll = collect($dates)->sort()->values();
        if ($paymentType === 'bulanan' && $coll->count() > 1) {
            $first = Carbon::parse($coll->first())->format('d/m/Y');
            $last = Carbon::parse($coll->last())->format('d/m/Y');
            $count = $coll->count();
            $formattedDates = "{$first} s/d {$last} ({$count} hari)";
        } else {
            $formattedDates = $coll->map(fn($d) => Carbon::parse($d)->format('d/m/Y'))->join(', ');
        }

        $message = str_replace(
            ['{parent_title}', '{parent_name}', '{child_name}', '{payment_type}', '{dates}', '{amount}', '{bank_info}'],
            [
                'Bapak/Ibu',
                $child->parent_name,
                $child->name,
                $paymentType === 'harian' ? 'harian' : 'bulanan',
                $formattedDates,
                'Rp ' . number_format((int) $amount, 0, ',', '.'),
                $bankInfo,
            ],
            $template
        );

        $waUrl = "https://wa.me/{$cleanPhone}?text=" . rawurlencode($message);

        return response()->json([
            'wa_url' => $waUrl,
            'message' => $message,
            'parent_phone' => $child->parent_phone,
        ]);
    }
}
