@extends('layouts.dashboard')

{{-- ===== META ===== --}}
@php
    $activePage = 'profile-anak';
    $title = 'Profile Anak';
    $subtitle = 'Data lengkap semua anak didik';
    $headerActions =
        '<button @click="$dispatch(\'open-add-child-modal\')" class="btn-primary text-sm py-2 px-5">Tambah Anak</button>';
@endphp

{{-- ===== DATA ===== --}}
@php
    $children = [
        [
            'name' => 'Aisyah Putri',
            'age' => 3,
            'kelas' => 'bunga',
            'color' => 'pink',
            'parent' => 'Ibu Sari',
            'status' => 'aktif',
        ],
        [
            'name' => 'Raka Pratama',
            'age' => 4,
            'kelas' => 'matahari',
            'color' => 'blue',
            'parent' => 'Bapak Ahmad',
            'status' => 'aktif',
        ],
        [
            'name' => 'Nadia Safitri',
            'age' => 2,
            'kelas' => 'bintang',
            'color' => 'yellow',
            'parent' => 'Ibu Dewi',
            'status' => 'aktif',
        ],
        [
            'name' => 'Dimas Aditya',
            'age' => 5,
            'kelas' => 'bulan',
            'color' => 'green',
            'parent' => 'Ibu Rina',
            'status' => 'cuti',
        ],
        [
            'name' => 'Zahra Aulia',
            'age' => 3,
            'kelas' => 'bunga',
            'color' => 'purple',
            'parent' => 'Bapak Budi',
            'status' => 'aktif',
        ],
        [
            'name' => 'Farhan Rizki',
            'age' => 4,
            'kelas' => 'matahari',
            'color' => 'teal',
            'parent' => 'Ibu Mega',
            'status' => 'sakit',
        ],
        [
            'name' => 'Cantika Dewi',
            'age' => 2,
            'kelas' => 'bintang',
            'color' => 'rose',
            'parent' => 'Bapak Eko',
            'status' => 'aktif',
        ],
        [
            'name' => 'Aldi Firmansyah',
            'age' => 5,
            'kelas' => 'bulan',
            'color' => 'indigo',
            'parent' => 'Ibu Wati',
            'status' => 'pindah',
        ],
    ];

    $statusBadge = [
        'aktif' => ['class' => 'badge-success', 'label' => 'Aktif'],
        'cuti' => ['class' => 'badge-warning', 'label' => 'Cuti'],
        'sakit' => ['class' => 'badge-danger', 'label' => 'Sakit'],
        'pindah' => ['class' => 'badge-gray', 'label' => 'Pindah'],
    ];

    $colorMap = [
        'pink' => 'bg-pink-500',
        'blue' => 'bg-blue-500',
        'yellow' => 'bg-yellow-500',
        'green' => 'bg-green-500',
        'purple' => 'bg-purple-500',
        'teal' => 'bg-teal-500',
        'rose' => 'bg-rose-500',
        'indigo' => 'bg-indigo-500',
    ];
@endphp

{{-- ===== CONTENT ===== --}}
@section('content')
    <div x-data="{ searchQuery: '', filterKelas: 'semua', showAddModal: false }" @open-add-child-modal.window="showAddModal = true">
        {{-- Search & Filter --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="flex-1 relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input x-model="searchQuery" type="text" placeholder="Cari nama anak..." class="input-field pl-12">
            </div>
            <select x-model="filterKelas" class="input-field sm:w-48">
                <option value="semua">Semua Kelas</option>
                <option value="bunga">Kelas Bunga</option>
                <option value="matahari">Kelas Matahari</option>
                <option value="bintang">Kelas Bintang</option>
                <option value="bulan">Kelas Bulan</option>
            </select>
        </div>

        {{-- Kids Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($children as $child)
                @php
                    $badge = $statusBadge[$child['status']] ?? ['class' => 'badge-gray', 'label' => $child['status']];
                @endphp
                <div class="card overflow-hidden group hover:-translate-y-2 transition-all duration-300">
                    {{-- Colored Header --}}
                    <div class="{{ $colorMap[$child['color']] }} p-4 -mx-6 -mt-6 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-14 h-14 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg">{{ $child['name'] }}</h4>
                                    <p class="text-white/70 text-sm">{{ $child['age'] }} tahun</p>
                                </div>
                            </div>
                            <span class="badge {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Kelas: </span>
                            <span class="font-semibold text-gray-700 dark:text-imumu-dark-text capitalize">Kelas
                                {{ $child['kelas'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Orang Tua: </span>
                            <span
                                class="font-semibold text-gray-700 dark:text-imumu-dark-text">{{ $child['parent'] }}</span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-imumu-dark-border">
                            <button
                                class="flex-1 py-2 text-sm font-semibold text-imumu-pink-dark bg-imumu-pink-light rounded-lg hover:bg-imumu-pink transition-colors cursor-pointer">Edit</button>
                            <button
                                class="flex-1 py-2 text-sm font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors cursor-pointer">Detail</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ===== MODAL: Tambah Anak ===== --}}
        <div x-show="showAddModal" x-transition.opacity
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div x-show="showAddModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                @click.away="showAddModal = false"
                class="bg-white dark:bg-imumu-dark-card rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

                <div class="bg-imumu-pink-dark p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white font-poppins">Tambah Data Anak</h3>
                        <button @click="showAddModal = false" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama
                            Lengkap</label>
                        <input type="text" placeholder="Masukkan nama lengkap" class="input-field">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Usia
                                (tahun)</label>
                            <input type="number" placeholder="3" class="input-field" min="1" max="6">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Jenis
                                Kelamin</label>
                            <select class="input-field">
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Kelas</label>
                        <select class="input-field">
                            <option value="">Pilih Kelas</option>
                            <option value="bunga">Kelas Bunga</option>
                            <option value="matahari">Kelas Matahari</option>
                            <option value="bintang">Kelas Bintang</option>
                            <option value="bulan">Kelas Bulan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Orang
                            Tua</label>
                        <input type="text" placeholder="Nama ayah/ibu" class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">No. Telepon Orang
                            Tua</label>
                        <input type="tel" placeholder="08xxxxxxxxxx" class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Alergi / Catatan
                            Khusus</label>
                        <textarea rows="2" placeholder="Tidak ada" class="input-field resize-none"></textarea>
                    </div>
                </div>

                <div class="p-6 pt-0 flex gap-3">
                    <button @click="showAddModal = false" class="btn-secondary flex-1">Batal</button>
                    <button @click="showAddModal = false" class="btn-success flex-1">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
