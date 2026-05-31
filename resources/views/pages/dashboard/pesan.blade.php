@extends('layouts.dashboard')

@php
  $activePage = 'pesan';
  $title = 'Pesan';
  $subtitle = 'Komunikasi dengan orang tua';
@endphp

@section('content')
<div class="card">
  <div class="text-center py-12">
    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
    </svg>
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mt-4">Halaman Pesan</h3>
    <p class="text-gray-400 dark:text-gray-400 mt-2">Coming Soon - Fitur pesan sedang dalam pengembangan.</p>
  </div>
</div>
@endsection
