<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class PublicInvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $invoice->load(['payment', 'enrollment', 'enrollment.package']);

        return view('pages.invoice.show', compact('invoice'));
    }
}
