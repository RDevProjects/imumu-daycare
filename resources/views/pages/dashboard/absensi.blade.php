@extends('layouts.dashboard')

@php
  $activePage = 'absensi';
  $title = 'Absensi';
  $subtitle = 'Kelola kehadiran anak didik';
@endphp

@section('content')
<div class="card">
  <div class="text-center py-12">
    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
    </svg>
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mt-4">Halaman Absensi</h3>
    <p class="text-gray-400 dark:text-gray-400 mt-2">Coming Soon - Fitur absensi sedang dalam pengembangan.</p>
  </div>
</div>
@endsection
