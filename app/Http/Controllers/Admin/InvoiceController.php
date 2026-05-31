<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $invoice->load(['payment', 'enrollment', 'enrollment.package']);

        return view('pages.dashboard.invoices.show', compact('invoice'));
    }
}
