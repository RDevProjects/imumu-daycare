<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['package', 'payment'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name or registration number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('child_name', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        $enrollments = $query->paginate(15);

        return view('pages.dashboard.pendaftaran.index', compact('enrollments'));
    }

    public function confirm(Enrollment $enrollment)
    {
        if ($enrollment->status !== 'pending') {
            return back()->with('error', 'Pendaftaran sudah dikonfirmasi sebelumnya.');
        }

        $enrollment->update([
            'status' => 'confirmed',
            'confirmed_by' => auth()->id(),
            'confirmed_at' => now(),
        ]);

        // ponytail: one Payment per Enrollment (hasOne). Duplicate guard above prevents double-creating.
        Payment::create([
            'enrollment_id' => $enrollment->id,
            'amount' => $enrollment->package->price,
            'payment_method' => $enrollment->payment_method ?? 'transfer',
            'due_date' => now()->addDays(7),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran dikonfirmasi!');
    }

    public function reject(Enrollment $enrollment, Request $request)
    {
        $enrollment->update([
            'status' => 'rejected',
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return back()->with('success', 'Pendaftaran ditolak.');
    }

    /**
     * Get WhatsApp message preview for confirmation
     */
    public function getWhatsAppMessage(Enrollment $enrollment)
    {
        $template = Setting::get('wa_template_konfirmasi') ?? 'Halo {parent_name}! Pendaftaran {child_name} telah dikonfirmasi.';

        $banks = Bank::active()->get();
        $bankInfo = $banks->map(function ($b) {
            return "{$b->bank_name} - {$b->account_number} a.n. {$b->account_name}";
        })->join("\n");

        $message = str_replace(
            ['{parent_title}', '{parent_name}', '{child_name}', '{package_name}', '{amount}', '{bank_info}', '{tracking_url}'],
            [
                'Bapak/Ibu',
                $enrollment->parent_name,
                $enrollment->child_name,
                $enrollment->package->label,
                'Rp '.number_format($enrollment->package->price, 0, ',', '.'),
                $bankInfo,
                $enrollment->history_url,
            ],
            $template
        );

        return response()->json([
            'message' => $message,
            'wa_number' => Setting::get('daycare_wa', '6285877748008'),
            'parent_phone' => $enrollment->parent_phone,
        ]);
    }
}
