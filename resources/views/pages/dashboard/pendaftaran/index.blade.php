@extends('layouts.dashboard')

@php
    $activePage = 'pendaftaran';
    $title = 'Pendaftaran';
    $subtitle = 'Kelola data pendaftaran anak baru';
@endphp

@section('content')
    <div class="space-y-6">

        {{-- Filter Bar --}}
        <div class="bg-white dark:bg-imumu-dark-card rounded-xl shadow-sm p-4">
            <form method="GET" class="flex flex-wrap gap-3">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="🔍 Cari nama anak / ortu / no registrasi..." class="input-field w-full">
                </div>
                <select name="status" class="input-field w-40">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi
                    </option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button type="submit" class="btn-primary px-6">Filter</button>
                <a href="{{ route('dashboard.pendaftaran') }}" class="btn-secondary px-4">Reset</a>
            </form>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Pending</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">
                            {{ \App\Models\Enrollment::pending()->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Dikonfirmasi</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">
                            {{ \App\Models\Enrollment::confirmed()->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Lunas</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">
                            {{ \App\Models\Enrollment::paid()->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-imumu-pink-dark">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Total</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">
                            {{ \App\Models\Enrollment::count() }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enrollment List --}}
        <div class="card overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-imumu-dark-border">
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">No. Registrasi</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Anak / Orang Tua</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Paket</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Bayar</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Tanggal</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enr)
                        @php
                            $cleanPhone = preg_replace('/[^0-9+]/', '', $enr->parent_phone);
                            $cleanPhone = ltrim($cleanPhone, '+');
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }

                            // Default sapaan: Bapak/Ibu
                            $parentTitle = 'Bapak/Ibu';

                            $template = \App\Models\Setting::get('wa_template_konfirmasi');
                            if ($template) {
                                $banks = \App\Models\Bank::active()->get();
                                $bankInfo = $banks
                                    ->map(fn($b) => "{$b->bank_name} - {$b->account_number} a.n. {$b->account_name}")
                                    ->join("\n");

                                $waMsg = str_replace(
                                    [
                                        '{parent_title}',
                                        '{parent_name}',
                                        '{child_name}',
                                        '{package_name}',
                                        '{amount}',
                                        '{bank_info}',
                                        '{tracking_url}',
                                    ],
                                    [
                                        $parentTitle,
                                        $enr->parent_name,
                                        $enr->child_name,
                                        $enr->package->label,
                                        'Rp ' . number_format($enr->package->price, 0, ',', '.'),
                                        $bankInfo,
                                        $enr->history_url,
                                    ],
                                    $template,
                                );
                            } else {
                                $waMsg = "{$parentTitle} {$enr->parent_name}, pendaftaran {$enr->child_name} telah dikonfirmasi.";
                            }
                            $waUrl = "https://wa.me/{$cleanPhone}?text=" . rawurlencode($waMsg);
                        @endphp
                        <tr
                            class="border-b border-gray-50 dark:border-imumu-dark-border hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                            <td class="py-3 px-4">
                                <span
                                    class="font-mono text-xs font-bold text-gray-600 dark:text-gray-300">{{ $enr->registration_number }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <p class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $enr->child_name }}</p>
                                <p class="text-xs text-gray-400">{{ $enr->parent_name }} • {{ $enr->parent_phone }}</p>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-xs font-semibold">{{ $enr->package->label }}</span>
                                <p class="text-xs text-gray-400">Rp {{ number_format($enr->package->price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="text-xs {{ $enr->payment_method === 'cash' ? 'text-green-600' : 'text-blue-600' }}">
                                    {{ $enr->payment_method === 'cash' ? '💵 Cash' : '🏦 Transfer' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-xs text-gray-400">
                                {{ $enr->created_at->format('d M Y') }}
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-bold
              {{ match ($enr->status) {
                  'pending' => 'bg-yellow-100 text-yellow-700',
                  'confirmed' => 'bg-blue-100 text-blue-700',
                  'paid' => 'bg-green-100 text-green-700',
                  'rejected' => 'bg-red-100 text-red-700',
                  default => 'bg-gray-100 text-gray-600',
              } }}">
                                    {{ ucfirst($enr->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2 flex-wrap">
                                    @if ($enr->status === 'pending')
                                        {{-- Konfirmasi Form --}}
                                        <form action="{{ route('dashboard.pendaftaran.confirm', $enr) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Konfirmasi pendaftaran {{ $enr->child_name }}?')">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 cursor-pointer">
                                                ✓ Konfirmasi
                                            </button>
                                        </form>
                                    @endif

                                    @if ($enr->status === 'confirmed' || $enr->status === 'paid')
                                        <a href="{{ $waUrl }}" target="_blank"
                                            class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg hover:bg-green-200 flex items-center gap-1 no-underline">
                                            💬 Chat WA
                                        </a>
                                    @endif

                                    @if ($enr->status === 'confirmed')
                                        <a href="{{ route('dashboard.pembayaran') }}"
                                            class="px-3 py-1.5 bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg hover:bg-blue-200 no-underline">
                                            💰 Bayar
                                        </a>
                                    @endif

                                    <a href="{{ $enr->history_url }}" target="_blank"
                                        class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-semibold rounded-lg hover:bg-gray-200 no-underline">
                                        🔗 Riwayat
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">
                                <p class="font-semibold">Belum ada pendaftaran</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if ($enrollments->hasPages())
                <div class="px-4 py-3 border-t border-gray-100 dark:border-imumu-dark-border">
                    {{ $enrollments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
