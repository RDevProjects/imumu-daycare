@extends('layouts.dashboard')

@section('title', 'Dashboard - IMUMU Daycare')

@php
  $title = 'Dashboard';
  $subtitle = 'Selamat datang kembali!';
  $activePage = 'dashboard';
@endphp

@section('content')
<!-- Welcome Card -->
<div class="bg-imumu-pink dark:bg-imumu-dark-pink rounded-2xl p-6 md:p-8 mb-8 shadow-sm relative overflow-hidden slide-up">
  <div class="absolute top-4 right-4 opacity-20">
    <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
      <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
    </svg>
  </div>
  <div class="relative z-10">
    <h2 class="text-xl md:text-2xl font-bold text-white mb-2 font-poppins">Selamat Datang di IMUMU Daycare!</h2>
    <p class="text-white/80 mb-4">Hari ini ada <strong class="text-white">24 anak</strong> yang hadir. Semangat!</p>
    <div class="flex gap-3">
      <a href="{{ route('dashboard.absensi') }}" class="bg-white/90 text-imumu-pink-dark font-semibold px-5 py-2 rounded-full hover:bg-white transition-colors shadow-sm text-sm cursor-pointer">Input Absensi</a>
      <a href="{{ route('dashboard.profile-anak') }}" class="bg-white/20 text-white font-semibold px-5 py-2 rounded-full hover:bg-white/30 transition-colors border border-white/30 text-sm cursor-pointer">Lihat Data Anak</a>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="stat-card border-l-4 border-imumu-pink-dark">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Total Anak</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">48</p>
        <p class="text-xs text-green-500 mt-1">+3 bulan ini</p>
      </div>
      <div class="w-12 h-12 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-xl flex items-center justify-center">
        <svg class="w-6 h-6 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
    </div>
  </div>
  <div class="stat-card border-l-4 border-green-500">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Hadir Hari Ini</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">24</p>
        <p class="text-xs text-green-500 mt-1">50% kehadiran</p>
      </div>
      <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>
  </div>
  <div class="stat-card border-l-4 border-imumu-blue">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Jadwal Hari Ini</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">6</p>
        <p class="text-xs text-blue-500 mt-1">3 sudah selesai</p>
      </div>
      <div class="w-12 h-12 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/20 rounded-xl flex items-center justify-center">
        <svg class="w-6 h-6 text-imumu-blue dark:text-imumu-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
      </div>
    </div>
  </div>
  <div class="stat-card border-l-4 border-imumu-orange">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Pembayaran Pending</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">8</p>
        <p class="text-xs text-orange-500 mt-1">Rp 4.800.000</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center">
        <svg class="w-6 h-6 text-orange-500 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
      </div>
    </div>
  </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

  <!-- Jadwal Hari Ini -->
  <div class="lg:col-span-2 card">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">Jadwal Hari Ini</h3>
      <a href="{{ route('dashboard.jadwal') }}" class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline cursor-pointer">Lihat Semua →</a>
    </div>

    <div class="space-y-3">
      <div class="flex items-center gap-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
        <div class="w-14 text-center">
          <p class="text-sm font-bold text-gray-700 dark:text-imumu-dark-text">07:00</p>
          <p class="text-xs text-gray-400 dark:text-gray-400">Selesai</p>
        </div>
        <div class="w-1 h-10 bg-green-400 rounded-full"></div>
        <div class="flex-1">
          <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Penyambutan Anak</p>
          <p class="text-sm text-gray-400 dark:text-gray-400">Menyambut kedatangan anak-anak</p>
        </div>
        <span class="badge badge-success">Selesai</span>
      </div>

      <div class="flex items-center gap-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
        <div class="w-14 text-center">
          <p class="text-sm font-bold text-gray-700 dark:text-imumu-dark-text">08:00</p>
          <p class="text-xs text-gray-400 dark:text-gray-400">Selesai</p>
        </div>
        <div class="w-1 h-10 bg-blue-400 rounded-full"></div>
        <div class="flex-1">
          <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Sarapan Bersama</p>
          <p class="text-sm text-gray-400 dark:text-gray-400">Makan pagi bersama teman-teman</p>
        </div>
        <span class="badge badge-success">Selesai</span>
      </div>

      <div class="flex items-center gap-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
        <div class="w-14 text-center">
          <p class="text-sm font-bold text-gray-700 dark:text-imumu-dark-text">09:00</p>
          <p class="text-xs text-yellow-600 dark:text-yellow-400 font-semibold">Berlangsung</p>
        </div>
        <div class="w-1 h-10 bg-imumu-yellow rounded-full animate-pulse"></div>
        <div class="flex-1">
          <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Senam Pagi</p>
          <p class="text-sm text-gray-400 dark:text-gray-400">Olahraga ringan dan gerakan ceria</p>
        </div>
        <span class="badge badge-warning">Berlangsung</span>
      </div>

      <div class="flex items-center gap-4 p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl border border-gray-200 dark:border-imumu-dark-border">
        <div class="w-14 text-center">
          <p class="text-sm font-bold text-gray-700 dark:text-imumu-dark-text">10:00</p>
          <p class="text-xs text-gray-400 dark:text-gray-400">Akan datang</p>
        </div>
        <div class="w-1 h-10 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
        <div class="flex-1">
          <p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Belajar Menggambar</p>
          <p class="text-sm text-gray-400 dark:text-gray-400">Aktivitas kreatif dan seni</p>
        </div>
        <span class="badge badge-info">Akan datang</span>
      </div>
    </div>
  </div>

  <!-- Quick Actions & Anak Baru -->
  <div class="space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4 font-poppins">Aksi Cepat</h3>
      <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('dashboard.absensi') }}" class="flex flex-col items-center gap-2 p-4 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/10 rounded-xl hover:bg-imumu-pink-light dark:hover:bg-imumu-dark-pink/20 transition-colors cursor-pointer">
          <svg class="w-6 h-6 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
          </svg>
          <span class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Absensi</span>
        </a>
        <a href="{{ route('dashboard.profile-anak') }}" class="flex flex-col items-center gap-2 p-4 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/10 rounded-xl hover:bg-imumu-blue-light dark:hover:bg-imumu-dark-blue/20 transition-colors cursor-pointer">
          <svg class="w-6 h-6 text-imumu-blue dark:text-imumu-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
          </svg>
          <span class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Tambah Anak</span>
        </a>
        <a href="{{ route('dashboard.jadwal') }}" class="flex flex-col items-center gap-2 p-4 bg-imumu-yellow-light/50 dark:bg-imumu-dark-yellow/10 rounded-xl hover:bg-imumu-yellow-light dark:hover:bg-imumu-dark-yellow/20 transition-colors cursor-pointer">
          <svg class="w-6 h-6 text-yellow-600 dark:text-imumu-dark-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Jadwal</span>
        </a>
        <a href="{{ route('dashboard.pesan') }}" class="flex flex-col items-center gap-2 p-4 bg-green-100/50 dark:bg-green-900/20 rounded-xl hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors cursor-pointer">
          <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
          </svg>
          <span class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Pesan</span>
        </a>
      </div>
    </div>

    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4 font-poppins">Anak Baru</h3>
      <div class="space-y-3">
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
          <div class="w-10 h-10 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Aisyah Putri</p>
            <p class="text-xs text-gray-400 dark:text-gray-400">Usia 3 thn • Kelas Bunga</p>
          </div>
          <span class="badge badge-success">Baru</span>
        </div>
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
          <div class="w-10 h-10 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-imumu-blue dark:text-imumu-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Raka Pratama</p>
            <p class="text-xs text-gray-400 dark:text-gray-400">Usia 4 thn • Kelas Matahari</p>
          </div>
          <span class="badge badge-success">Baru</span>
        </div>
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
          <div class="w-10 h-10 bg-imumu-yellow-light/50 dark:bg-imumu-dark-yellow/20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-yellow-600 dark:text-imumu-dark-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">Nadia Safitri</p>
            <p class="text-xs text-gray-400 dark:text-gray-400">Usia 2 thn • Kelas Bintang</p>
          </div>
          <span class="badge badge-success">Baru</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Attendance Chart -->
<div class="card mb-8">
  <div class="flex items-center justify-between mb-6">
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">Kehadiran Minggu Ini</h3>
    <span class="text-sm text-gray-400 dark:text-gray-400">Senin - Jumat</span>
  </div>
  <div class="flex items-end justify-between gap-3 h-40">
    <div class="flex flex-col items-center gap-2 flex-1">
      <div class="w-full bg-imumu-pink-dark dark:bg-imumu-dark-pink rounded-t-lg" style="height: 70%"></div>
      <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">Sen</p>
      <p class="text-xs text-gray-400 dark:text-gray-400">34</p>
    </div>
    <div class="flex flex-col items-center gap-2 flex-1">
      <div class="w-full bg-imumu-blue dark:bg-imumu-dark-blue rounded-t-lg" style="height: 85%"></div>
      <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">Sel</p>
      <p class="text-xs text-gray-400 dark:text-gray-400">41</p>
    </div>
    <div class="flex flex-col items-center gap-2 flex-1">
      <div class="w-full bg-imumu-green dark:bg-imumu-dark-green rounded-t-lg" style="height: 60%"></div>
      <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">Rab</p>
      <p class="text-xs text-gray-400 dark:text-gray-400">29</p>
    </div>
    <div class="flex flex-col items-center gap-2 flex-1">
      <div class="w-full bg-imumu-yellow dark:bg-imumu-dark-yellow rounded-t-lg" style="height: 90%"></div>
      <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">Kam</p>
      <p class="text-xs text-gray-400 dark:text-gray-400">43</p>
    </div>
    <div class="flex flex-col items-center gap-2 flex-1">
      <div class="w-full bg-imumu-purple dark:bg-imumu-dark-purple rounded-t-lg" style="height: 50%"></div>
      <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">Jum</p>
      <p class="text-xs text-gray-400 dark:text-gray-400">24</p>
    </div>
  </div>
</div>

<!-- Payment Overview Section -->
<div class="card mb-8">
  <div class="flex items-center justify-between mb-6">
    <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">💰 Pembayaran Bulan Ini</h3>
    <a href="{{ route('dashboard.pembayaran') }}" class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline cursor-pointer">Lihat Semua →</a>
  </div>

  <!-- Payment Summary -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 border border-green-200 dark:border-green-800">
      <p class="text-sm text-green-600 dark:text-green-400 font-medium">Terkumpul</p>
      <p class="text-xl font-bold text-green-700 dark:text-green-400 mt-1">Rp 2.550.000</p>
      <p class="text-xs text-green-500 mt-1">3 anak lunas</p>
    </div>
    <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-4 border border-yellow-200 dark:border-yellow-800">
      <p class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Outstanding</p>
      <p class="text-xl font-bold text-yellow-700 dark:text-yellow-400 mt-1">Rp 1.535.000</p>
      <p class="text-xs text-yellow-500 mt-1">3 anak belum bayar</p>
    </div>
    <div class="bg-red-50 dark:bg-red-900/20 rounded-xl p-4 border border-red-200 dark:border-red-800">
      <p class="text-sm text-red-600 dark:text-red-400 font-medium">Overdue</p>
      <p class="text-xl font-bold text-red-700 dark:text-red-400 mt-1">2 anak</p>
      <p class="text-xs text-red-500 mt-1">Perlu ditagih</p>
    </div>
    <div class="bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/10 rounded-xl p-4 border border-imumu-pink dark:border-imumu-dark-pink/30">
      <p class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-medium">Lunas</p>
      <p class="text-xl font-bold text-imumu-pink-dark dark:text-imumu-dark-pink mt-1">50%</p>
      <p class="text-xs text-gray-400 dark:text-gray-400 mt-1">12 dari 24 anak</p>
    </div>
  </div>

  <!-- Recent Transactions + Overdue -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Recent Transactions -->
    <div>
      <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-3">Transaksi Terbaru</h4>
      <div class="space-y-2">
        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-lg">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700 dark:text-imumu-dark-text">Aisyah Putri</p>
              <p class="text-xs text-gray-400 dark:text-gray-400">5 Jan 2025</p>
            </div>
          </div>
          <div class="text-right">
            <p class="text-sm font-semibold text-green-600">Rp 500.000</p>
            <span class="badge badge-success text-[10px]">Lunas</span>
          </div>
        </div>
        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-lg">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700 dark:text-imumu-dark-text">Nadia Safitri</p>
              <p class="text-xs text-gray-400 dark:text-gray-400">3 Jan 2025</p>
            </div>
          </div>
          <div class="text-right">
            <p class="text-sm font-semibold text-green-600">Rp 1.000.000</p>
            <span class="badge badge-success text-[10px]">Lunas</span>
          </div>
        </div>
        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-imumu-dark-surface rounded-lg">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700 dark:text-imumu-dark-text">Raka Pratama</p>
              <p class="text-xs text-gray-400 dark:text-gray-400">Menunggu</p>
            </div>
          </div>
          <div class="text-right">
            <p class="text-sm font-semibold text-yellow-600">Rp 500.000</p>
            <span class="badge badge-warning text-[10px]">Pending</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Overdue / Perlu Ditagih -->
    <div>
      <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-3">⚠️ Perlu Ditagih</h4>
      <div class="space-y-2">
        <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700 dark:text-imumu-dark-text">Farhan Rizki</p>
              <p class="text-xs text-gray-400 dark:text-gray-400">Jatuh tempo: 1 Jan 2025</p>
            </div>
          </div>
          <a href="https://wa.me/6281234567890?text=Halo%20Ibu%20Mega!%20Reminder%20pembayaran%20Farhan%20Rizki%20bulan%20Januari%20Rp%20500.000" target="_blank" class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 transition-colors cursor-pointer">💬 Tagih</a>
        </div>
        <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700 dark:text-imumu-dark-text">Dimas Aditya</p>
              <p class="text-xs text-gray-400 dark:text-gray-400">Jatuh tempo: 3 Jan 2025</p>
            </div>
          </div>
          <a href="https://wa.me/6281234567891?text=Halo%20Ibu%20Rina!%20Reminder%20pembayaran%20Dimas%20Aditya%20bulan%20Januari%20Rp%2035.000" target="_blank" class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 transition-colors cursor-pointer">💬 Tagih</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
