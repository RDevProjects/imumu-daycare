@extends('layouts.dashboard')

@php
    $activePage = 'pengaturan';
    $title = 'Pengaturan';
    $subtitle = 'Kelola akun dan preferensi';

    $settings = $settings ?? [];
    $banks = $banks ?? collect();
@endphp

@section('content')
    <div x-data="{
        activeSection: '{{ request('section', session('active_section', 'profil')) }}',
        tarif: {
            pendaftaran: {{ (int) ($settings['tarif_pendaftaran'] ?? 250000) }},
        }
    }">

        {{-- Settings Tabs --}}
        <div class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-sm p-1.5 mb-6">
            <div class="flex gap-1 overflow-x-auto">
                <button @click="activeSection = 'profil'"
                    :class="activeSection === 'profil' ? 'bg-imumu-pink-dark text-white' :
                        'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'"
                    class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Profil</button>
                <button @click="activeSection = 'daycare'"
                    :class="activeSection === 'daycare' ? 'bg-imumu-blue text-white' :
                        'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'"
                    class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Daycare</button>
                <button @click="activeSection = 'tarif'"
                    :class="activeSection === 'tarif' ? 'bg-green-500 text-white' :
                        'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'"
                    class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Tarif
                    & Paket</button>
                <button @click="activeSection = 'rekening'"
                    :class="activeSection === 'rekening' ? 'bg-imumu-purple text-white' :
                        'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'"
                    class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Rekening
                    Bank</button>
                <button @click="activeSection = 'notifikasi'"
                    :class="activeSection === 'notifikasi' ? 'bg-imumu-orange text-white' :
                        'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface'"
                    class="flex-1 py-2.5 px-4 rounded-lg font-semibold text-sm transition-all whitespace-nowrap cursor-pointer">Notifikasi</button>
            </div>
        </div>

        {{-- ===== PROFIL ===== --}}
        <div x-show="activeSection === 'profil'" class="max-w-2xl space-y-6">
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Profil Admin</h3>
                <form action="{{ route('dashboard.pengaturan.profile') }}" method="POST">
                    @csrf
                    <div class="flex items-center gap-5 mb-6">
                        <div
                            class="w-20 h-20 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">{{ Auth::user()->name }}
                            </h4>
                            <p class="text-sm text-gray-400 dark:text-gray-400">Administrator</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama
                                Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                class="input-field @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                class="input-field @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Telepon</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}"
                                class="input-field">
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
                            <h4 class="font-semibold text-gray-700 dark:text-imumu-dark-text mb-3">Ubah Password</h4>
                            <div class="space-y-3">
                                <div>
                                    <input type="password" name="current_password" placeholder="Password saat ini"
                                        class="input-field @error('current_password') border-red-500 @enderror">
                                    @error('current_password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <input type="password" name="new_password" placeholder="Password baru"
                                    class="input-field @error('new_password') border-red-500 @enderror">
                                @error('new_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <input type="password" name="new_password_confirmation"
                                    placeholder="Konfirmasi password baru" class="input-field">
                            </div>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn-primary flex-1 text-sm py-2">Simpan Profil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===== DAYCARE ===== --}}
        <div x-show="activeSection === 'daycare'" class="max-w-2xl space-y-6">
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Informasi Daycare
                </h3>
                <form action="{{ route('dashboard.pengaturan.update') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama
                                Daycare</label>
                            <input type="text" name="daycare_name"
                                value="{{ old('daycare_name', $settings['daycare_name'] ?? 'IMUMU Daycare') }}"
                                class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Alamat</label>
                            <textarea name="daycare_address" rows="2" class="input-field resize-none">{{ old('daycare_address', $settings['daycare_address'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">No
                                    WhatsApp</label>
                                <input type="tel" name="daycare_wa"
                                    value="{{ old('daycare_wa', $settings['daycare_wa'] ?? '') }}" class="input-field"
                                    placeholder="628xxxxxxxxxx">
                                <p class="text-xs text-gray-400 mt-1">Format: 628xxxxxxxxxx</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Kontak
                                    WhatsApp</label>
                                <input type="text" name="wa_contact_name"
                                    value="{{ old('wa_contact_name', $settings['wa_contact_name'] ?? '') }}"
                                    class="input-field" placeholder="Kosongkan → tampil 'Bunda'">
                                <p class="text-xs text-gray-400 mt-1">Contoh: "Anjani" → tampil "Bunda Anjani"</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="daycare_email"
                                value="{{ old('daycare_email', $settings['daycare_email'] ?? '') }}" class="input-field">
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
                            <h4 class="font-semibold text-gray-700 dark:text-imumu-dark-text mb-3">Jam Operasional</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Buka</label>
                                    <input type="time" name="daycare_open_time"
                                        value="{{ old('daycare_open_time', $settings['daycare_open_time'] ?? '08:00') }}"
                                        class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Tutup</label>
                                    <input type="time" name="daycare_close_time"
                                        value="{{ old('daycare_close_time', $settings['daycare_close_time'] ?? '16:00') }}"
                                        class="input-field">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn-primary flex-1 text-sm py-2">Simpan Pengaturan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===== TARIF & PAKET ===== --}}
        <div x-show="activeSection === 'tarif'" x-data="{
            formatIDR(value) { return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.'); },
                unformatIDR(value) { return value.replace(/\./g, ''); }
        }" class="max-w-3xl space-y-6">
            {{-- Tarif Pendaftaran --}}
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-2 font-poppins">Biaya Pendaftaran
                </h3>
                <p class="text-sm text-gray-400 dark:text-gray-400 mb-4">Tarif biaya pendaftaran (sekali bayar)</p>
                <form action="{{ route('dashboard.pengaturan.update') }}" method="POST" id="tarifForm">
                    @csrf
                    <div
                        class="bg-imumu-yellow-light/50 dark:bg-imumu-dark-yellow/10 rounded-xl p-5 border border-imumu-yellow/30">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                            <input type="text" id="tarif_pendaftaran_display"
                                value="{{ number_format(old('tarif_pendaftaran', $settings['tarif_pendaftaran'] ?? 250000), 0, ',', '.') }}"
                                class="input-field w-48 text-lg font-bold"
                                onfocus="this.value=this.value.replace(/\./g,'')"
                                onblur="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')">
                            <input type="hidden" name="tarif_pendaftaran" id="tarif_pendaftaran"
                                value="{{ old('tarif_pendaftaran', $settings['tarif_pendaftaran'] ?? 250000) }}">
                        </div>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="btn-primary flex-1 text-sm py-2">Simpan Tarif</button>
                    </div>
                </form>
            </div>

            {{-- Daftar Paket --}}
            <div class="card">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">Paket Penitipan
                        </h3>
                        <p class="text-sm text-gray-400 dark:text-gray-400">Paket yang tampil di landing page</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach ($packages ?? \App\Models\Package::orderBy('name')->orderBy('type')->get() as $pkg)
                        <form action="{{ route('dashboard.packages.update', $pkg) }}" method="POST"
                            class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-imumu-dark-surface rounded-xl">
                            @csrf
                            @method('PATCH')
                            <div class="flex-1 grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <input type="text" name="name" value="{{ $pkg->name }}"
                                    class="input-field text-sm" placeholder="Nama Paket">
                                <select name="type" class="input-field text-sm">
                                    <option value="harian" {{ $pkg->type === 'harian' ? 'selected' : '' }}>Harian</option>
                                    <option value="bulanan" {{ $pkg->type === 'bulanan' ? 'selected' : '' }}>Bulanan
                                    </option>
                                </select>
                                <input type="text" value="{{ number_format((int) $pkg->price, 0, ',', '.') }}"
                                    class="input-field text-sm pkg-price-display"
                                    onfocus="this.value=this.value.replace(/\./g,'')"
                                    onblur="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')"
                                    data-hidden="pkg_price_{{ $pkg->id }}">
                                <input type="hidden" name="price" id="pkg_price_{{ $pkg->id }}"
                                    value="{{ (int) $pkg->price }}">
                                <div class="flex items-center gap-2">
                                    <button type="submit" class="btn-primary text-sm py-2 flex-1">Simpan</button>
                                    <button type="button"
                                        onclick="if(confirm('Hapus paket ini?')) fetch('{{ route('dashboard.packages.destroy', $pkg) }}', {method: 'DELETE', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}).then(() => location.reload())"
                                        class="px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

                {{-- Tambah Paket Baru --}}
                <form action="{{ route('dashboard.packages.store') }}" method="POST"
                    class="mt-4 pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
                    @csrf
                    <div
                        class="flex items-center gap-4 p-4 bg-green-50 dark:bg-green-900/10 rounded-xl border border-green-200 dark:border-green-800">
                        <div class="flex-1 grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <select name="name" class="input-field text-sm">
                                <option value="PAUD IMUMU">PAUD IMUMU</option>
                                <option value="Non-PAUD">Non-PAUD</option>
                            </select>
                            <select name="type" class="input-field text-sm">
                                <option value="harian">Harian</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                            <input type="text" class="input-field text-sm" placeholder="Harga"
                                onfocus="this.value=this.value.replace(/\./g,'')"
                                onblur="this.value=this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.')"
                                onchange="document.getElementById('new_pkg_price').value=this.value.replace(/\./g,'')">
                            <input type="hidden" name="price" id="new_pkg_price">
                            <button type="submit" class="btn-success text-sm py-2">+ Tambah Paket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Script to sync display and hidden values on form submit --}}
        <script>
            document.getElementById('tarifForm')?.addEventListener('submit', function(e) {
                const display = document.getElementById('tarif_pendaftaran_display');
                const hidden = document.getElementById('tarif_pendaftaran');
                hidden.value = display.value.replace(/\./g, '');
            });

            document.querySelectorAll('.pkg-price-display').forEach(input => {
                input.addEventListener('blur', function() {
                    const hiddenId = this.dataset.hidden;
                    const hidden = document.getElementById(hiddenId);
                    if (hidden) hidden.value = this.value.replace(/\./g, '');
                });
            });
        </script>

        {{-- ===== REKENING BANK ===== --}}
        <div x-show="activeSection === 'rekening'" class="max-w-3xl space-y-6">
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-2 font-poppins">Rekening Bank</h3>
                <p class="text-sm text-gray-400 dark:text-gray-400 mb-6">Rekening untuk pembayaran transfer. Ditampilkan
                    saat konfirmasi pendaftaran.</p>

                <div class="space-y-3">
                    @forelse($banks as $bank)
                        <form action="{{ route('dashboard.banks.update', $bank) }}" method="POST"
                            class="flex items-center gap-4 p-4 {{ $bank->is_active ? 'bg-gray-50 dark:bg-imumu-dark-surface' : 'bg-gray-100 dark:bg-gray-800 opacity-60' }} rounded-xl">
                            @csrf
                            @method('PATCH')
                            <div class="flex-1 grid grid-cols-1 sm:grid-cols-4 gap-3">
                                <input type="text" name="bank_name" value="{{ $bank->bank_name }}"
                                    class="input-field text-sm" placeholder="Nama Bank">
                                <input type="text" name="account_number" value="{{ $bank->account_number }}"
                                    class="input-field text-sm" placeholder="No Rekening">
                                <input type="text" name="account_name" value="{{ $bank->account_name }}"
                                    class="input-field text-sm" placeholder="Nama Pemilik">
                                <div class="flex items-center gap-2">
                                    <button type="submit" class="btn-primary text-sm py-2 flex-1">Simpan</button>
                                    <button type="button"
                                        onclick="fetch('{{ route('dashboard.banks.toggle', $bank) }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}).then(() => location.reload())"
                                        class="px-2 py-2 text-xs rounded-lg {{ $bank->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500' }}"
                                        title="{{ $bank->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        {{ $bank->is_active ? '✓' : '✗' }}
                                    </button>
                                    <button type="button"
                                        onclick="if(confirm('Hapus rekening ini?')) fetch('{{ route('dashboard.banks.destroy', $bank) }}', {method: 'DELETE', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}).then(() => location.reload())"
                                        class="px-2 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <p>Belum ada rekening bank</p>
                        </div>
                    @endforelse
                </div>

                {{-- Tambah Rekening Baru --}}
                <form action="{{ route('dashboard.banks.store') }}" method="POST"
                    class="mt-4 pt-4 border-t border-gray-100 dark:border-imumu-dark-border">
                    @csrf
                    <div
                        class="flex items-center gap-4 p-4 bg-green-50 dark:bg-green-900/10 rounded-xl border border-green-200 dark:border-green-800">
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-4 gap-3">
                            <input type="text" name="bank_name" class="input-field text-sm"
                                placeholder="Nama Bank (BCA, Mandiri, dll)" required>
                            <input type="text" name="account_number" class="input-field text-sm"
                                placeholder="No Rekening" required>
                            <input type="text" name="account_name" class="input-field text-sm"
                                placeholder="Nama Pemilik Rekening" required>
                            <button type="submit" class="btn-success text-sm py-2">+ Tambah Rekening</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===== NOTIFIKASI ===== --}}
        <div x-show="activeSection === 'notifikasi'" class="max-w-2xl space-y-6">
            <div class="card">
                <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-6 font-poppins">Template WhatsApp
                </h3>
                <form action="{{ route('dashboard.pengaturan.update') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Template
                                Konfirmasi Pendaftaran</label>
                            <p class="text-xs text-gray-400 dark:text-gray-400 mb-2">Placeholder: {parent_name}, {parent_title}, {child_name}, {package_name}, {amount}, {bank_info}, {tracking_url}</p>
                            <textarea name="wa_template_konfirmasi" rows="6" class="input-field resize-none text-sm font-mono">{{ old('wa_template_konfirmasi', $settings['wa_template_konfirmasi'] ?? '') }}</textarea>
                        </div>
                        <div class="border-t border-gray-100 dark:border-imumu-dark-border pt-6">
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Template
                                Tagihan Harian</label>
                            <p class="text-xs text-gray-400 dark:text-gray-400 mb-2">Placeholder: {parent_name}, {parent_title}, {child_name}, {dates}, {amount}, {bank_info}, {payment_type}</p>
                            <textarea name="wa_template_harian" rows="6" class="input-field resize-none text-sm font-mono">{{ old('wa_template_harian', $settings['wa_template_harian'] ?? "Assalamu'alaikum {parent_title} {parent_name}!\n\nPembayaran harian untuk {child_name}:\nTanggal: {dates}\nBiaya: {amount}\n\nTransfer ke:\n{bank_info}\n\nSetelah transfer, kirimkan buktinya ke sini ya.") }}</textarea>
                        </div>
                        <div class="border-t border-gray-100 dark:border-imumu-dark-border pt-6">
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Template
                                Tagihan Bulanan</label>
                            <p class="text-xs text-gray-400 dark:text-gray-400 mb-2">Placeholder: {parent_name}, {parent_title}, {child_name}, {month}, {amount}, {bank_info}, {payment_type}</p>
                            <textarea name="wa_template_bulanan" rows="6" class="input-field resize-none text-sm font-mono">{{ old('wa_template_bulanan', $settings['wa_template_bulanan'] ?? "Assalamu'alaikum {parent_title} {parent_name}!\n\nPembayaran bulanan untuk {child_name} bulan ini:\nBiaya: {amount}\n\nTransfer ke:\n{bank_info}\n\nSetelah transfer, kirimkan buktinya ke sini ya.") }}</textarea>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn-primary w-full text-sm py-2">Simpan Template</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
