@extends('layouts.dashboard')

@php
  $activePage = 'pembayaran';
  $title = 'Pembayaran';
  $subtitle = 'Kelola dan verifikasi pembayaran';
@endphp

@section('content')
<div class="space-y-6">

  {{-- Summary Cards --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="stat-card border-l-4 border-green-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-400 font-medium">Terkumpul</p>
          <p class="text-xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
        </div>
        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
      </div>
    </div>
    <div class="stat-card border-l-4 border-yellow-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-400 font-medium">Pending</p>
          <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">{{ $totalPending }}</p>
        </div>
        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
      </div>
    </div>
    <div class="stat-card border-l-4 border-red-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-400 font-medium">Overdue</p>
          <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">{{ $totalOverdue }}</p>
        </div>
        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        </div>
      </div>
    </div>
    <div class="stat-card border-l-4 border-blue-500">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-400 font-medium">Review</p>
          <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">{{ $totalReview }}</p>
        </div>
        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        </div>
      </div>
    </div>
  </div>

  {{-- Filter --}}
  <div class="bg-white dark:bg-imumu-dark-card rounded-xl shadow-sm p-4">
    <form method="GET" class="flex flex-wrap gap-3">
      <div class="flex-1 min-w-[200px]">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Cari nama anak..." class="input-field w-full">
      </div>
      <select name="status" class="input-field w-40">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
        <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
        <option value="review" {{ request('status') === 'review' ? 'selected' : '' }}>Review</option>
      </select>
      <button type="submit" class="btn-primary px-6">Filter</button>
      <a href="{{ route('dashboard.pembayaran') }}" class="btn-secondary px-4">Reset</a>
      <a href="{{ route('dashboard.reports.finance') }}" class="btn-success px-4 flex items-center gap-2">📥 Export Excel</a>
    </form>
  </div>

  {{-- Payment List --}}
  <div class="card overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="border-b border-gray-100 dark:border-imumu-dark-border">
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Anak</th>
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Paket</th>
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Nominal</th>
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Due Date</th>
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Status</th>
          <th class="text-left py-3 px-4 font-semibold text-gray-500">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($payments as $payment)
        @php
          $cleanPhone = preg_replace('/[^0-9+]/', '', $payment->enrollment->parent_phone);
          $cleanPhone = ltrim($cleanPhone, '+');
          if (str_starts_with($cleanPhone, '0')) $cleanPhone = '62' . substr($cleanPhone, 1);

          $parentTitle = 'Bapak/Ibu';
          $trackerUrl = $payment->enrollment->history_url;

          if ($payment->status === 'paid') {
            $waMsg = "Assalamu'alaikum {$parentTitle} {$payment->enrollment->parent_name}!\n\nPembayaran untuk {$payment->enrollment->child_name} telah kami konfirmasi.\n\n[Detail]\n- Paket: {$payment->enrollment->package->label}\n- Total: Rp " . number_format($payment->amount, 0, ',', '.') . "\n- Status: LUNAS\n\n[Tracker] Cek status pendaftaran:\n{$trackerUrl}\n\nJazakumullahu khairan.\nWassalamu'alaikum Wr. Wb.";
            $waUrl = "https://wa.me/{$cleanPhone}?text=" . rawurlencode($waMsg);
          }
        @endphp
        <tr class="border-b border-gray-50 dark:border-imumu-dark-border hover:bg-gray-50 dark:hover:bg-imumu-dark-surface">
          <td class="py-3 px-4">
            <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $payment->enrollment->child_name }}</p>
            <p class="text-xs text-gray-400">{{ $payment->enrollment->parent_name }}</p>
          </td>
          <td class="py-3 px-4 text-xs">{{ $payment->enrollment->package->label }}</td>
          <td class="py-3 px-4 font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
          <td class="py-3 px-4 text-xs text-gray-400">{{ $payment->due_date->format('d M Y') }}</td>
          <td class="py-3 px-4">
            <span class="px-2 py-1 rounded-full text-xs font-bold
              {{ match($payment->status) {
                'paid' => 'bg-green-100 text-green-700',
                'pending' => 'bg-yellow-100 text-yellow-700',
                'overdue' => 'bg-red-100 text-red-700',
                'review' => 'bg-blue-100 text-blue-700',
                default => 'bg-gray-100 text-gray-600'
              } }}">
              {{ ucfirst($payment->status) }}
            </span>
          </td>
          <td class="py-3 px-4">
            <div class="flex gap-2 flex-wrap">
              @if($payment->status === 'pending')
              <a href="{{ route('dashboard.pembayaran.verify', $payment) }}" class="px-3 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded-lg hover:bg-blue-600 no-underline">
                Verifikasi
              </a>
              <form action="{{ route('dashboard.pembayaran.mark-cash', $payment) }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 cursor-pointer">
                  💵 Cash
                </button>
              </form>
              @endif

              @if($payment->status === 'paid')
              <a href="{{ $waUrl ?? '#' }}" target="_blank" class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200 no-underline flex items-center gap-1">
                💬 Chat WA
              </a>
              <a href="{{ $trackerUrl }}" target="_blank" class="px-3 py-1.5 bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg hover:bg-blue-200 no-underline">
                🔗 Tracker
              </a>
              @if($payment->invoice)
              <a href="{{ route('public.invoice.show', $payment->invoice->slug) }}" target="_blank" class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-semibold rounded-lg hover:bg-gray-200 no-underline">
                📄 Invoice
              </a>
              @endif
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="py-12 text-center text-gray-400">
            <p class="font-semibold">Belum ada pembayaran</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>

    @if($payments->hasPages())
    <div class="px-4 py-3 border-t border-gray-100 dark:border-imumu-dark-border">
      {{ $payments->links() }}
    </div>
    @endif
  </div>
</div>
@endsection
