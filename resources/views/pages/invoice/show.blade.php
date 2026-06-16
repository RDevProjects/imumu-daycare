@extends('layouts.front')

@section('title', 'Invoice ' . $invoice->invoice_number . ' - IMUMU Daycare')

@section('content')

    <section class="px-4 py-10 md:py-14">
        <div class="mx-auto max-w-2xl">

            <!-- Invoice Card -->
            <div class="rounded-card p-8 border-2"
                style="background:white; border-color:#09b1ab; box-shadow: 5px 5px 0 #d8f7f5">

                <!-- Header -->
                <div class="text-center mb-8 pb-6 border-b-2 border-imumu-pink">
                    <h1 class="font-display text-2xl font-black" style="color: #09b1ab">IMUMU Daycare</h1>
                    <p class="text-sm" style="color:#5c5555">{{ \App\Models\Setting::get('daycare_address', '') }}</p>
                    <p class="text-sm" style="color:#5c5555">WA: {{ \App\Models\Setting::get('daycare_wa', '') }}</p>
                </div>

                <!-- Invoice Info -->
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="font-display text-lg font-black text-ink">INVOICE PEMBAYARAN</h2>
                        <p class="text-sm" style="color:#5c5555">{{ $invoice->invoice_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm" style="color:#5c5555">Tanggal</p>
                        <p class="font-bold text-ink">{{ $invoice->issued_date->format('d F Y') }}</p>
                        <span
                            class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                            ✓ LUNAS
                        </span>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="rounded-soft p-5 mb-8" style="background:#d8f7f5">
                    <h3 class="text-sm font-bold mb-2" style="color:#5c5555">DITERBITKAN UNTUK</h3>
                    <p class="font-bold text-ink">{{ $invoice->enrollment->parent_name }}</p>
                    <p class="text-sm" style="color:#5c5555">Orang Tua dari: {{ $invoice->enrollment->child_name }}</p>
                    <p class="text-sm" style="color:#5c5555">📞 {{ $invoice->enrollment->parent_phone }}</p>
                </div>

                <!-- Payment Details -->
                <table class="w-full mb-8">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 text-sm font-bold" style="color:#5c5555">Deskripsi</th>
                            <th class="text-right py-3 text-sm font-bold" style="color:#5c5555">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-4">
                                <p class="font-bold text-ink">{{ $invoice->enrollment->package->name }}</p>
                                <p class="text-sm" style="color:#5c5555">Tipe:
                                    {{ ucfirst($invoice->enrollment->package->type) }}</p>
                                <p class="text-sm" style="color:#5c5555">Metode:
                                    {{ $invoice->payment->payment_method === 'cash' ? 'Cash' : 'Transfer' }}</p>
                            </td>
                            <td class="py-4 text-right font-bold text-ink">Rp
                                {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pt-4 text-right font-bold text-ink">TOTAL</td>
                            <td class="pt-4 text-right font-black text-2xl" style="color: #09b1ab">Rp
                                {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Footer -->
                <div class="text-center pt-6 border-t border-gray-100">
                    <p class="text-sm font-bold" style="color:#5c5555">
                        {{ \App\Models\Setting::get('invoice_header_text', 'Terima kasih atas kepercayaan Anda kepada IMUMU Daycare.') }}
                    </p>
                    <p class="text-xs mt-4" style="color:#999">
                        {{ \App\Models\Setting::get('invoice_footer_text', 'Invoice ini digenerate otomatis oleh sistem.') }}
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 mt-6">
                <button onclick="window.print()" class="btn btn-primary flex-1 text-sm">🖨️ Cetak</button>
                <a href="{{ $invoice->enrollment->history_url }}" class="btn btn-secondary flex-1 text-sm">🔗 Tracker</a>
            </div>

            <!-- Help -->
            <div class="mt-6 text-center">
                <p class="text-sm font-bold" style="color:#5c5555">Butuh bantuan?</p>
                <a href="https://wa.me/{{ \App\Models\Setting::get('daycare_wa', '6285877748008') }}" target="_blank"
                    class="inline-flex items-center gap-2 mt-2 px-6 py-3 rounded-full font-bold text-white"
                    style="background:#25d366">
                    💬 Chat WhatsApp
                </a>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        @media print {

            header,
            footer,
            nav,
            .btn,
            .no-print,
            button {
                display: none !important;
            }

            body {
                margin: 0;
                padding: 10px;
                background: white !important;
            }

            .rounded-card {
                box-shadow: none !important;
                border: 2px solid #09b1ab !important;
            }

            section {
                padding: 0 !important;
            }

            main {
                display: block !important;
            }

            a {
                text-decoration: none !important;
                color: inherit !important;
            }
        }
    </style>
@endpush
