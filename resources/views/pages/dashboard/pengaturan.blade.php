@extends('layouts.dashboard')

{{-- ===== META ===== --}}
@php
  $activePage = 'pengaturan';
  $title = 'Pengaturan';
  $subtitle = 'Kelola akun dan preferensi';
@endphp

{{-- ===== DATA ===== --}}
@php
$defaultTarif = [
    'pendaftaran' => 250000,
    'paudHarian' => 35000,
    'paudBulanan' => 500000,
    'nonPaudHarian' => 50000,
    'nonPaudBulanan' => 1000000,
];
@endphp

{{-- ===== CONTENT ===== --}}
@section('content')
<div x-data="{
    activeSection: 'profil',
    notifEmail: true,
    notifWA: false,
    notifAbsensi: true,
    notifPembayaran: true,
    tarif: @js($defaultTarif),
    formatRupiah(num) { return 'Rp ' + num.toLocaleString('id-ID'); }
  }">

  {{-- Settings Tabs --}}
  <div class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-sm p-1.5 mb-6">
    <div class="flex gap-1 overflow-x-auto">
      <button @click="activeSection = 'profil'" :class="activeSection === 'profil' ? 'bg-imumu-pink-dark text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'" class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Profil</button>
      <button @click="activeSection = 'daycare'" :class="activeSection === 'daycare' ? 'bg-imumu-blue text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'" class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Daycare</button>
      <button @click="activeSection = 'tarif'" :class="activeSection === 'tarif' ? 'bg-green-500 text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'" class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Tarif & Paket</button>
      <button @click="activeSection = 'notifikasi'" :class="activeSection === 'notifikasi' ? 'bg-imumu-orange text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'" class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Notifikasi</button>
      <button @click="activeSection = 'backup'" :class="activeSection === 'backup' ? 'bg-imumu-purple text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'" class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Backup</button>
    </div>
  </div>

  {{-- ===== PROFIL ===== --}}
  <div x-show="activeSection === 'profil'" class="max-w-2xl space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Profil Admin</h3>
      <div class="flex items-center gap-5 mb-6">
        <div class="w-20 h-20 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-full flex items-center justify-center">
          <svg class="w-10 h-10 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
          <h4 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">{{ Auth::user()->name ?? 'Admin IMUMU' }}</h4>
          <p class="text-sm text-gray-400 dark:text-gray-400">Administrator</p>
          <button class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold mt-1 hover:underline cursor-pointer">Ubah Foto</button>
        </div>
      </div>
      <div class="space-y-4">
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Lengkap</label><input type="text" value="{{ Auth::user()->name ?? 'Admin IMUMU' }}" class="input-field"></div>
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label><input type="email" value="{{ Auth::user()->email ?? 'admin@imumu.com' }}" class="input-field"></div>
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Telepon</label><input type="tel" value="081234567890" class="input-field"></div>
        <div class="pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
          <h4 class="font-semibold text-gray-700 dark:text-imumu-dark-text mb-3">Ubah Password</h4>
          <div class="space-y-3">
            <input type="password" placeholder="Password saat ini" class="input-field">
            <input type="password" placeholder="Password baru" class="input-field">
            <input type="password" placeholder="Konfirmasi password baru" class="input-field">
          </div>
        </div>
        <div class="flex gap-3 pt-4">
          <button class="btn-secondary flex-1 text-sm py-2">Batal</button>
          <button @click="showToast = true; toastMessage = 'Profil berhasil diperbarui!'" class="btn-primary flex-1 text-sm py-2">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== DAYCARE ===== --}}
  <div x-show="activeSection === 'daycare'" class="max-w-2xl space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Informasi Daycare</h3>
      <div class="space-y-4">
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Daycare</label><input type="text" value="IMUMU Daycare" class="input-field"></div>
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Alamat</label><textarea rows="2" class="input-field resize-none">Jl. Ceria No. 123, Jakarta Selatan</textarea></div>
        <div class="grid grid-cols-2 gap-4">
          <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Telepon</label><input type="tel" value="021-1234567" class="input-field"></div>
          <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">WhatsApp</label><input type="tel" value="081234567890" class="input-field"></div>
        </div>
        <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label><input type="email" value="info@imumu.com" class="input-field"></div>
        <div class="pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
          <h4 class="font-semibold text-gray-700 dark:text-imumu-dark-text mb-3">Jam Operasional</h4>
          <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Buka</label><input type="time" value="07:00" class="input-field"></div>
            <div><label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Tutup</label><input type="time" value="16:00" class="input-field"></div>
          </div>
        </div>
        <div class="flex gap-3 pt-4">
          <button class="btn-secondary flex-1 text-sm py-2">Batal</button>
          <button @click="showToast = true; toastMessage = 'Info daycare berhasil diperbarui!'" class="btn-primary flex-1 text-sm py-2">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== TARIF & PAKET ===== --}}
  <div x-show="activeSection === 'tarif'" class="max-w-3xl space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-2 font-poppins">Tarif & Paket</h3>
      <p class="text-sm text-gray-400 dark:text-gray-400 mb-6">Kelola tarif untuk setiap jenis paket daycare</p>

      {{-- Pendaftaran --}}
      <div class="bg-imumu-yellow-light/50 dark:bg-imumu-dark-yellow/10 rounded-xl p-5 mb-6 border border-imumu-yellow/30">
        <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text mb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-imumu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Biaya Pendaftaran (sekali)
        </h4>
        <div class="flex items-center gap-3">
          <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
          <input type="number" x-model.number="tarif.pendaftaran" class="input-field w-40 text-lg font-bold">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- PAUD --}}
        <div class="bg-teal-50 dark:bg-teal-900/10 rounded-xl p-5 border border-teal-200 dark:border-teal-800">
          <h4 class="font-bold text-teal-700 dark:text-teal-400 mb-4 flex items-center gap-2">
            <span class="w-3 h-3 bg-teal-500 rounded-full"></span>
            Murid PAUD IMUMU
            <span class="badge badge-teal text-[10px] ml-auto">Populer</span>
          </h4>
          <div class="space-y-4">
            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Harian</label>
              <div class="flex items-center gap-2">
                <span class="text-gray-400 dark:text-gray-400 text-sm">Rp</span>
                <input type="number" x-model.number="tarif.paudHarian" class="input-field text-lg font-bold">
              </div>
            </div>
            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Bulanan</label>
              <div class="flex items-center gap-2">
                <span class="text-gray-400 dark:text-gray-400 text-sm">Rp</span>
                <input type="number" x-model.number="tarif.paudBulanan" class="input-field text-lg font-bold">
              </div>
            </div>
          </div>
        </div>

        {{-- Non-PAUD --}}
        <div class="bg-purple-50 dark:bg-purple-900/10 rounded-xl p-5 border border-purple-200 dark:border-purple-800">
          <h4 class="font-bold text-purple-700 dark:text-purple-400 mb-4 flex items-center gap-2">
            <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
            Murid Non-PAUD
          </h4>
          <div class="space-y-4">
            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Harian</label>
              <div class="flex items-center gap-2">
                <span class="text-gray-400 dark:text-gray-400 text-sm">Rp</span>
                <input type="number" x-model.number="tarif.nonPaudHarian" class="input-field text-lg font-bold">
              </div>
            </div>
            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Bulanan</label>
              <div class="flex items-center gap-2">
                <span class="text-gray-400 dark:text-gray-400 text-sm">Rp</span>
                <input type="number" x-model.number="tarif.nonPaudBulanan" class="input-field text-lg font-bold">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-3 pt-6 mt-6 border-t border-gray-100 dark:border-imumu-dark-border">
        <button class="btn-secondary flex-1 text-sm py-2">Reset Default</button>
        <button @click="showToast = true; toastMessage = 'Tarif berhasil disimpan!'" class="btn-success flex-1 text-sm py-2">Simpan Tarif</button>
      </div>
    </div>
  </div>

  {{-- ===== NOTIFIKASI ===== --}}
  <div x-show="activeSection === 'notifikasi'" class="max-w-2xl space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Preferensi Notifikasi</h3>
      <div class="space-y-4">
        {{-- Email --}}
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <div><p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Notifikasi Email</p><p class="text-sm text-gray-400 dark:text-gray-400">Terima notifikasi via email</p></div>
          </div>
          <button @click="notifEmail = !notifEmail" :class="notifEmail ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600'" class="relative w-11 h-6 rounded-full transition-colors cursor-pointer"><span :class="notifEmail ? 'translate-x-5' : 'translate-x-0.5'" class="absolute top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform"></span></button>
        </div>
        {{-- WhatsApp --}}
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-400 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.386 0-4.592-.832-6.332-2.225l-.44-.358-3.275 1.098 1.098-3.275-.358-.44A9.958 9.958 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
            <div><p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Notifikasi WhatsApp</p><p class="text-sm text-gray-400 dark:text-gray-400">Kirim notifikasi ke WhatsApp orang tua</p></div>
          </div>
          <button @click="notifWA = !notifWA" :class="notifWA ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600'" class="relative w-11 h-6 rounded-full transition-colors cursor-pointer"><span :class="notifWA ? 'translate-x-5' : 'translate-x-0.5'" class="absolute top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform"></span></button>
        </div>
        {{-- Absensi --}}
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            <div><p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Absensi</p><p class="text-sm text-gray-400 dark:text-gray-400">Notifikasi saat anak absen masuk/pulang</p></div>
          </div>
          <button @click="notifAbsensi = !notifAbsensi" :class="notifAbsensi ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600'" class="relative w-11 h-6 rounded-full transition-colors cursor-pointer"><span :class="notifAbsensi ? 'translate-x-5' : 'translate-x-0.5'" class="absolute top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform"></span></button>
        </div>
        {{-- Pembayaran --}}
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <div><p class="font-semibold text-gray-700 dark:text-imumu-dark-text">Pembayaran</p><p class="text-sm text-gray-400 dark:text-gray-400">Reminder pembayaran tertunda</p></div>
          </div>
          <button @click="notifPembayaran = !notifPembayaran" :class="notifPembayaran ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600'" class="relative w-11 h-6 rounded-full transition-colors cursor-pointer"><span :class="notifPembayaran ? 'translate-x-5' : 'translate-x-0.5'" class="absolute top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform"></span></button>
        </div>
        <div class="flex gap-3 pt-4">
          <button @click="showToast = true; toastMessage = 'Preferensi notifikasi disimpan!'" class="btn-primary w-full text-sm py-2">Simpan Preferensi</button>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== BACKUP ===== --}}
  <div x-show="activeSection === 'backup'" class="max-w-2xl space-y-6">
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Backup & Export Data</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="p-5 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/10 rounded-xl text-center hover:shadow-md transition-all cursor-pointer" @click="showToast = true; toastMessage = 'Export data anak dimulai...'">
          <svg class="w-10 h-10 mx-auto text-imumu-pink-dark dark:text-imumu-dark-pink mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">Data Anak</h4><p class="text-sm text-gray-400 dark:text-gray-400 mt-1">Export semua data anak</p>
          <button class="btn-primary text-sm mt-4 w-full py-2">Export</button>
        </div>
        <div class="p-5 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/10 rounded-xl text-center hover:shadow-md transition-all cursor-pointer" @click="showToast = true; toastMessage = 'Export data absensi dimulai...'">
          <svg class="w-10 h-10 mx-auto text-imumu-blue dark:text-imumu-dark-blue mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
          <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">Data Absensi</h4><p class="text-sm text-gray-400 dark:text-gray-400 mt-1">Export riwayat absensi</p>
          <button class="btn-primary text-sm mt-4 w-full py-2">Export</button>
        </div>
        <div class="p-5 bg-imumu-yellow-light/50 dark:bg-imumu-dark-yellow/10 rounded-xl text-center hover:shadow-md transition-all cursor-pointer" @click="showToast = true; toastMessage = 'Export data pembayaran dimulai...'">
          <svg class="w-10 h-10 mx-auto text-yellow-600 dark:text-imumu-dark-yellow mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
          <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">Data Pembayaran</h4><p class="text-sm text-gray-400 dark:text-gray-400 mt-1">Export riwayat transaksi</p>
          <button class="btn-primary text-sm mt-4 w-full py-2">Export</button>
        </div>
        <div class="p-5 bg-green-100/50 dark:bg-green-900/20 rounded-xl text-center hover:shadow-md transition-all cursor-pointer" @click="showToast = true; toastMessage = 'Full backup dimulai...'">
          <svg class="w-10 h-10 mx-auto text-green-600 dark:text-green-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
          <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">Full Backup</h4><p class="text-sm text-gray-400 dark:text-gray-400 mt-1">Backup semua data</p>
          <button class="btn-success text-sm mt-4 w-full py-2">Backup</button>
        </div>
      </div>
    </div>
    <div class="card">
      <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4 font-poppins">Tentang Aplikasi</h3>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between py-2 border-b border-gray-100 dark:border-imumu-dark-border"><span class="text-gray-400 dark:text-gray-400">Aplikasi</span><span class="font-semibold text-gray-700 dark:text-imumu-dark-text">IMUMU Daycare Admin</span></div>
        <div class="flex justify-between py-2 border-b border-gray-100 dark:border-imumu-dark-border"><span class="text-gray-400 dark:text-gray-400">Versi</span><span class="font-semibold text-gray-700 dark:text-imumu-dark-text">1.0.0</span></div>
        <div class="flex justify-between py-2"><span class="text-gray-400 dark:text-gray-400">Kontak Support</span><span class="font-semibold text-imumu-pink-dark dark:text-imumu-dark-pink">support@imumu.com</span></div>
      </div>
    </div>
  </div>
</div>
@endsection
