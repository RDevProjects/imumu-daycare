@extends('layouts.dashboard')

@php
  $activePage = 'pembayaran';
  $title = 'Invoice ' . $invoice->invoice_number;
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
  <div class="card p-8" id="invoiceContent">
    {{-- Header --}}
    <div class="text-center mb-8 pb-6 border-b-2 border-imumu-pink">
      <h1 class="text-3xl font-black" style="color: #09b1ab">IMUMU Daycare</h1>
      <p class="text-sm text-gray-400 mt-1">{{ \App\Models\Setting::get('daycare_address', '') }}</p>
      <p class="text-sm text-gray-400">WA: {{ \App\Models\Setting::get('daycare_wa', '') }}</p>
    </div>

    {{-- Invoice Info --}}
    <div class="flex justify-between items-start mb-8">
      <div>
        <h2 class="text-xl font-bold text-gray-700 dark:text-imumu-dark-text">INVOICE PEMBAYARAN</h2>
        <p class="text-sm text-gray-400 mt-1">{{ $invoice->invoice_number }}</p>
      </div>
      <div class="text-right">
        <p class="text-sm text-gray-400">Tanggal</p>
        <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $invoice->issued_date->format('d F Y') }}</p>
        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
          ✓ LUNAS
        </span>
      </div>
    </div>

    {{-- Customer Info --}}
    <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-5 mb-8">
      <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-2">DITERBITKAN UNTUK</h3>
      <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $invoice->enrollment->parent_name }}</p>
      <p class="text-sm text-gray-400">Orang Tua dari: {{ $invoice->enrollment->child_name }}</p>
      <p class="text-sm text-gray-400">📞 {{ $invoice->enrollment->parent_phone }}</p>
    </div>

    {{-- Payment Details --}}
    <table class="w-full mb-8">
      <thead>
        <tr class="border-b-2 border-gray-200 dark:border-imumu-dark-border">
          <th class="text-left py-3 text-sm font-semibold text-gray-500">Deskripsi</th>
          <th class="text-right py-3 text-sm font-semibold text-gray-500">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-100 dark:border-imumu-dark-border">
          <td class="py-4">
            <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $invoice->enrollment->package->name }}</p>
            <p class="text-sm text-gray-400">Tipe: {{ ucfirst($invoice->enrollment->package->type) }}</p>
            <p class="text-sm text-gray-400">Metode: {{ $invoice->payment->payment_method === 'cash' ? 'Cash' : 'Transfer' }}</p>
          </td>
          <td class="py-4 text-right font-bold text-gray-700 dark:text-imumu-dark-text">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td class="pt-4 text-right font-bold text-gray-700 dark:text-imumu-dark-text">TOTAL</td>
          <td class="pt-4 text-right font-black text-2xl" style="color: #09b1ab">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>

    {{-- Footer --}}
    <div class="text-center pt-6 border-t border-gray-100 dark:border-imumu-dark-border">
      <p class="text-sm font-semibold text-gray-400">{{ \App\Models\Setting::get('invoice_header_text', 'Terima kasih atas kepercayaan Anda kepada IMUMU Daycare.') }}</p>
      <p class="text-xs text-gray-300 mt-4">{{ \App\Models\Setting::get('invoice_footer_text', 'Invoice ini digenerate otomatis oleh sistem.') }}</p>
    </div>
  </div>

  {{-- Actions --}}
  <div class="flex gap-3 mt-6">
    <button onclick="window.print()" class="btn-primary flex-1 text-sm">🖨️ Cetak Invoice</button>
    <a href="{{ route('dashboard.pembayaran') }}" class="btn-secondary flex-1 text-sm">Kembali</a>
  </div>
</div>
@endsection
