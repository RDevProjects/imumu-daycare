@extends('layouts.dashboard')

@php
  $activePage = 'pembayaran';
  $title = 'Laporan Keuangan';
  $subtitle = 'Export laporan keuangan dalam format Excel (CSV)';
@endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  {{-- Info Card --}}
  <div class="card">
    <div class="flex items-center gap-4 mb-4">
      <div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">Export Laporan Keuangan</h3>
        <p class="text-sm text-gray-400">Download data pembayaran dalam format CSV (bisa dibuka di Excel)</p>
      </div>
    </div>
  </div>

  {{-- Filter Form --}}
  <div class="card">
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4">Filter Laporan</h3>
    <form action="{{ route('dashboard.reports.finance.export') }}" method="GET" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Bulan</label>
          <select name="month" class="input-field">
            <option value="">Semua Bulan</option>
            @for($m = 1; $m <= 12; $m++)
              <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
            @endfor
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Tahun</label>
          <select name="year" class="input-field">
            <option value="">Semua Tahun</option>
            @for($y = date('Y'); $y >= 2024; $y--)
              <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Status</label>
          <select name="status" class="input-field">
            <option value="">Semua Status</option>
            <option value="paid">Lunas</option>
            <option value="pending">Pending</option>
            <option value="overdue">Overdue</option>
            <option value="review">Review</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Metode Bayar</label>
          <select name="payment_method" class="input-field">
            <option value="">Semua Metode</option>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
          </select>
        </div>
      </div>

      <div class="flex gap-3 pt-4">
        <button type="submit" class="btn-success flex-1 text-sm py-3">📥 Export Excel (CSV)</button>
      </div>
    </form>
  </div>

  {{-- Quick Export Buttons --}}
  <div class="card">
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4">Export Cepat</h3>
    <div class="grid grid-cols-2 gap-3">
      <a href="{{ route('dashboard.reports.finance.export', ['month' => date('n'), 'year' => date('Y')]) }}" class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors no-underline">
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <div>
          <p class="font-bold text-green-700 dark:text-green-400 text-sm">Bulan Ini</p>
          <p class="text-xs text-gray-400">{{ date('F Y') }}</p>
        </div>
      </a>
      <a href="{{ route('dashboard.reports.finance.export', ['year' => date('Y')]) }}" class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors no-underline">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <div>
          <p class="font-bold text-blue-700 dark:text-blue-400 text-sm">Tahun Ini</p>
          <p class="text-xs text-gray-400">{{ date('Y') }}</p>
        </div>
      </a>
      <a href="{{ route('dashboard.reports.finance.export', ['status' => 'paid']) }}" class="flex items-center gap-3 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors no-underline">
        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
          <p class="font-bold text-purple-700 dark:text-purple-400 text-sm">Yang Lunas</p>
          <p class="text-xs text-gray-400">Semua waktu</p>
        </div>
      </a>
      <a href="{{ route('dashboard.reports.finance.export', ['status' => 'pending']) }}" class="flex items-center gap-3 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition-colors no-underline">
        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
          <p class="font-bold text-yellow-700 dark:text-yellow-400 text-sm">Yang Pending</p>
          <p class="text-xs text-gray-400">Semua waktu</p>
        </div>
      </a>
    </div>
  </div>
</div>
@endsection
