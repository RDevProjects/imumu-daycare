@extends('layouts.front')

@section('title', 'Riwayat Pembayaran - IMUMU Daycare')

@section('content')

    <section class="px-4 py-12 md:py-16 relative overflow-hidden"
        style="background: linear-gradient(135deg, #d8f7f5 0%, #fff8e8 50%, #fff4a8 100%)">
        <div class="relative mx-auto max-w-3xl text-center">
            <span class="badge badge-teal mb-4">💰 Riwayat Pembayaran</span>
            <h1 class="font-display font-black text-ink" style="font-size: clamp(1.8rem, 4vw, 2.5rem); line-height:1.1">
                IMUMU Daycare
            </h1>
        </div>
    </section>

    <section class="mx-auto max-w-4xl px-4 py-10">
        <!-- Child Info -->
        <div class="rounded-card p-6 border-2 mb-6"
            style="background:white; border-color:#09b1ab; box-shadow: 5px 5px 0 #d8f7f5">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-teal/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="text-left">
                    <h2 class="font-display text-xl font-black text-ink">{{ $enrollment->child_name }}</h2>
                    <p class="text-sm font-semibold" style="color:#5c5555">Orang Tua: {{ $enrollment->parent_name }}</p>
                    <p class="text-sm font-semibold" style="color:#5c5555">Paket: {{ $enrollment->package->label }}</p>
                </div>
                <div class="ml-auto">
                    <span
                        class="px-4 py-2 rounded-full text-sm font-bold
          {{ $enrollment->status === 'paid'
              ? 'bg-green-100 text-green-700'
              : ($enrollment->status === 'confirmed'
                  ? 'bg-yellow-100 text-yellow-700'
                  : 'bg-gray-100 text-gray-600') }}">
                        {{ match ($enrollment->status) {
                            'paid' => '✓ Lunas',
                            'confirmed' => '⏳ Menunggu Bayar',
                            'pending' => '⏳ Menunggu Konfirmasi',
                            default => ucfirst($enrollment->status),
                        } }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Payment History -->
        <div class="rounded-card p-6 border-2"
            style="background:white; border-color:#ffd900; box-shadow: 5px 5px 0 #ffd900">
            <h3 class="font-display text-lg font-black text-ink mb-4">📄 Riwayat Pembayaran</h3>

            @forelse($payments as $payment)
                <div
                    class="flex items-center justify-between p-4 {{ $loop->first ? '' : 'border-t border-gray-100' }} hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full {{ $payment->status === 'paid' ? 'bg-green-100' : 'bg-yellow-100' }} flex items-center justify-center">
                            @if ($payment->status === 'paid')
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-ink">
                                {{ $payment->payment_date ? $payment->payment_date->format('d M Y') : 'Belum dibayar' }}
                            </p>
                            <p class="text-xs font-semibold" style="color:#5c5555">
                                {{ $payment->payment_method === 'cash' ? '💵 Cash' : '🏦 Transfer' }}
                                @if ($payment->invoice)
                                    • Invoice: {{ $payment->invoice->invoice_number }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-ink">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        <span
                            class="text-xs font-bold {{ $payment->status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ match ($payment->status) {
                                'paid' => '✓ Lunas',
                                'pending' => '⏳ Pending',
                                'review' => '🔍 Review',
                                default => ucfirst($payment->status),
                            } }}
                        </span>
                    </div>
                </div>

                @if ($payment->invoice)
                    <div class="px-4 pb-4">
                        <a href="{{ route('public.invoice.show', $payment->invoice->slug) }}" target="_blank"
                            class="text-sm text-teal font-bold hover:underline">
                            📄 Lihat Invoice →
                        </a>
                    </div>
                @endif
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-400 font-semibold">Belum ada riwayat pembayaran</p>
                </div>
            @endforelse
        </div>

        <!-- Help -->
        <div class="mt-6 text-center">
            <p class="text-sm font-semibold" style="color:#5c5555">Butuh bantuan?</p>
            @auth
                <a href="{{ route('dashboard.pengaturan') }}?section=daycare"
                    class="inline-flex items-center gap-2 mt-2 px-6 py-3 rounded-full font-bold text-white"
                    style="background:#25d366">
                    💬 Atur WhatsApp Daycare
                </a>
            @else
                <a href="https://wa.me/{{ \App\Models\Setting::get('daycare_wa', '') }}" target="_blank"
                    class="inline-flex items-center gap-2 mt-2 px-6 py-3 rounded-full font-bold text-white"
                    style="background:#25d366">
                    💬 Chat WhatsApp
                </a>
            @endauth
        </div>
    </section>

@endsection
