@extends('layouts.dashboard')

@section('title', 'Dashboard - IMUMU Daycare')

@php
    $title = 'Dashboard';
    $subtitle = 'Selamat datang kembali!';
    $activePage = 'dashboard';
@endphp

@section('content')
    <!-- Welcome Card -->
    <div class="bg-imumu-pink dark:bg-imumu-dark-pink rounded-2xl p-6 md:p-8 mb-8 shadow-sm relative overflow-hidden">
        <div class="absolute top-4 right-4 opacity-20">
            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
            </svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-2 font-poppins">Selamat Datang di IMUMU Daycare!</h2>
            <p class="text-white/80 mb-4">Hari ini ada <strong class="text-white">{{ $anakAktif ?? 0 }} anak</strong> yang
                aktif. Semangat!</p>
            <div class="flex gap-3">
                <a href="{{ route('dashboard.pendaftaran') }}"
                    class="bg-white/90 text-imumu-pink-dark font-semibold px-5 py-2 rounded-full hover:bg-white transition-colors shadow-sm text-sm">Lihat
                    Pendaftaran</a>
                <a href="{{ route('dashboard.profile-anak') }}"
                    class="bg-white/20 text-white font-semibold px-5 py-2 rounded-full hover:bg-white/30 transition-colors border border-white/30 text-sm">Data
                    Anak</a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="stat-card border-l-4 border-imumu-pink-dark">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 font-medium">Total Anak</p>
                    <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">{{ $totalAnak ?? 0 }}</p>
                    <p class="text-xs text-green-500 mt-1">{{ $anakAktif ?? 0 }} aktif</p>
                </div>
                <div
                    class="w-12 h-12 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="stat-card border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 font-medium">Pendaftaran Pending</p>
                    <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">
                        {{ $enrollmentsPending ?? 0 }}</p>
                    <p class="text-xs text-yellow-500 mt-1">Perlu konfirmasi</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="stat-card border-l-4 border-imumu-blue">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 font-medium">Pembayaran Pending</p>
                    <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">{{ $paymentsPending ?? 0 }}
                    </p>
                    <p class="text-xs text-blue-500 mt-1">Perlu verifikasi</p>
                </div>
                <div
                    class="w-12 h-12 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-imumu-blue dark:text-imumu-dark-blue" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="stat-card border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 font-medium">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">Rp
                        {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-500 mt-1">{{ $paymentsPaid ?? 0 }} lunas</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        {{-- Recent Enrollments --}}
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">Pendaftaran Terbaru</h3>
                <a href="{{ route('dashboard.pendaftaran') }}"
                    class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Lihat Semua
                    →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentEnrollments as $enr)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
                        <div>
                            <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">{{ $enr->child_name }}</p>
                            <p class="text-xs text-gray-400">{{ $enr->parent_name }} • {{ $enr->registration_number }}</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-bold
          {{ match ($enr->status) {
              'pending' => 'bg-yellow-100 text-yellow-700',
              'confirmed' => 'bg-blue-100 text-blue-700',
              'paid' => 'bg-green-100 text-green-700',
              default => 'bg-gray-100 text-gray-600',
          } }}">
                            {{ ucfirst($enr->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-400 py-4">Belum ada pendaftaran</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Payments --}}
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">Pembayaran Terbaru</h3>
                <a href="{{ route('dashboard.pembayaran') }}"
                    class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Lihat Semua
                    →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentPayments as $payment)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
                        <div>
                            <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">
                                {{ $payment->child?->name ?? $payment->enrollment?->child_name ?? '—' }}</p>
                            <p class="text-xs text-gray-400">
                                {{ $payment->payment_method === 'cash' ? '💵 Cash' : '🏦 Transfer' }} • Rp
                                {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-bold
          {{ match ($payment->status) {
              'paid' => 'bg-green-100 text-green-700',
              'pending' => 'bg-yellow-100 text-yellow-700',
              default => 'bg-gray-100 text-gray-600',
          } }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-400 py-4">Belum ada pembayaran</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
