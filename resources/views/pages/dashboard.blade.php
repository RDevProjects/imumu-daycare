@extends('layouts.auth')

@section('title', 'Dashboard - IMUMU Daycare')

@section('content')
<nav class="bg-white dark:bg-imumu-dark-card border-b border-gray-100 dark:border-imumu-dark-border px-6 py-4">
  <div class="flex items-center justify-between max-w-7xl mx-auto">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-imumu-pink-dark rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
      </div>
      <h1 class="text-xl font-bold text-imumu-pink-dark dark:text-imumu-dark-pink font-poppins">IMUMU Daycare</h1>
    </div>
    <div class="flex items-center gap-4">
      <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->name }}</span>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="text-sm text-red-500 hover:text-red-600 font-semibold">Logout</button>
      </form>
    </div>
  </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-12">
  <div class="text-center">
    <h2 class="text-3xl font-bold text-gray-700 dark:text-gray-200 mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-gray-400 dark:text-gray-400">Dashboard halaman placeholder. Silakan ganti dengan halaman dashboard Anda.</p>
  </div>
</div>
@endsection
