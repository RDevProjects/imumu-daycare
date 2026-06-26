@extends('layouts.dashboard')

@php
    $activePage = 'pembayaran';
    $title = 'Verifikasi Pembayaran';
    $subtitle = $payment->enrollment?->child_name ?? $payment->child?->name ?? '';

    $paymentTypeLabels = [
        'registration' => 'Pendaftaran',
        'harian' => 'Harian',
        'bulanan' => 'Bulanan',
    ];

    $childName = $payment->child?->name ?? $payment->enrollment?->child_name ?? '—';
    $parentName = $payment->child?->parent_name ?? $payment->enrollment?->parent_name ?? '—';
    $packageLabel = $payment->enrollment?->package?->label ?? '—';
@endphp

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Payment Info --}}
        <div class="card">
            <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4">Detail Pembayaran</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Anak</p>
                    <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $childName }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Orang Tua</p>
                    <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $parentName }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Tipe</p>
                    <p class="font-bold text-gray-700 dark:text-imumu-dark-text">
                        {{ $paymentTypeLabels[$payment->payment_type] ?? ucfirst($payment->payment_type) }}
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Paket</p>
                    <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $packageLabel }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Nominal</p>
                    <p class="font-bold text-2xl" style="color: #09b1ab">Rp
                        {{ number_format($payment->amount, 0, ',', '.') }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Metode</p>
                    <p class="font-bold text-gray-700 dark:text-imumu-dark-text">
                        {{ $payment->payment_method === 'cash' ? '💵 Cash' : '🏦 Transfer' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                    <p class="text-sm text-gray-400">Status</p>
                    <span
                        class="px-2 py-1 rounded-full text-xs font-bold
          {{ match ($payment->status) {
              'paid' => 'bg-green-100 text-green-700',
              'pending' => 'bg-yellow-100 text-yellow-700',
              'review' => 'bg-blue-100 text-blue-700',
              default => 'bg-gray-100 text-gray-600',
          } }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>

                @if ($payment->dates->isNotEmpty())
                    <div class="col-span-2 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4">
                        <p class="text-sm text-gray-400 mb-2">Tanggal</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($payment->dates as $pd)
                                <span class="px-2 py-1 rounded-lg text-xs font-bold bg-teal-100 text-teal-700">
                                    {{ $pd->date->format('d M Y') }}
                                </span>
                            @endforeach
                            <p class="text-xs text-gray-400 mt-2 w-full">
                                Total: {{ $payment->dates->count() }} hari
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Verification Form --}}
        @if ($payment->status === 'pending')
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4">Verifikasi Pembayaran</h3>
                <form action="{{ route('dashboard.pembayaran.mark-paid', $payment) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2">Upload Bukti
                            Transfer (arsip)</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="bukti_transfer" accept="image/*" class="input-field" id="buktiInput"
                                onchange="previewImage(this)">
                        </div>
                        <div id="imagePreview" class="mt-3 hidden">
                            <img src="" alt="Preview"
                                class="max-w-xs rounded-xl border-2 border-gray-200 dark:border-imumu-dark-border">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Screenshot bukti transfer dari WhatsApp (opsional, untuk
                            arsip)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Tanggal
                            Bayar</label>
                        <input type="date" name="payment_date" value="{{ now()->format('Y-m-d') }}"
                            class="input-field w-48">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Catatan</label>
                        <textarea name="notes" rows="2" class="input-field resize-none" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('dashboard.pembayaran') }}" class="btn-secondary flex-1 text-sm">Batal</a>
                        <button type="submit" class="btn-success flex-1 text-sm py-3">✓ Verifikasi - Lunas</button>
                    </div>
                </form>
            </div>
        @else
            <div class="card text-center py-8">
                <svg class="w-16 h-16 mx-auto text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">Pembayaran sudah diverifikasi</p>
                <p class="text-sm text-gray-400 mt-1">Status: {{ ucfirst($payment->status) }}</p>
                @if ($payment->verified_at)
                    <p class="text-xs text-gray-400 mt-2">Diverifikasi pada:
                        {{ $payment->verified_at->format('d M Y H:i') }}</p>
                @endif
                <a href="{{ route('dashboard.pembayaran') }}" class="btn-primary mt-4 inline-block">Kembali ke
                    Pembayaran</a>
            </div>
        @endif
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
