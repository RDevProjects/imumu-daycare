@extends('layouts.dashboard')

@php
  $activePage = 'jadwal';
  $title = 'Jadwal';
  $subtitle = 'Kelola jadwal harian daycare';
@endphp

@section('content')
<div class="card">
  <div class="text-center py-12">
    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mt-4">Halaman Jadwal</h3>
    <p class="text-gray-400 dark:text-gray-400 mt-2">Coming Soon - Fitur jadwal sedang dalam pengembangan.</p>
  </div>
</div>
@endsection
