@extends('layouts.dashboard')

{{-- ===== META ===== --}}
@php
    $activePage = 'pembayaran';
    $title = 'Pembayaran';
    $subtitle = 'Kelola pembayaran orang tua';
    $headerActions = '
    <div class="relative" x-data="{ showExport: false }" @click.outside="showExport = false">
      <button @click="showExport = !showExport" class="btn-secondary text-sm py-2 px-4">📥 Export</button>
      <div x-show="showExport" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-lg border border-gray-100 py-2 z-50">
        <button @click="$parent.exportCSV(); showExport = false" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">📄 Export CSV</button>
        <button @click="$parent.exportExcel(); showExport = false" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">📊 Export Excel</button>
      </div>
    </div>
    <button @click="$dispatch(\'open-add-payment\')" class="btn-primary text-sm py-2 px-4">+ Tambah</button>
  ';
@endphp

{{-- ===== DATA ===== --}}
@php
    $children = [
        [
            'id' => 1,
            'name' => 'Aisyah Putri',
            'kelas' => 'Bunga',
            'ortu' => 'Ibu Sari',
            'phone' => '6281234567890',
            'paket' => 'PAUD',
            'tipe' => 'Bulanan',
            'nominal' => 500000,
            'status' => 'lunas',
            'tglBayar' => '2025-01-05',
            'dueDate' => '2025-01-05',
            'bukti' => 'https://placehold.co/300x200/e2e8f0/475569?text=Bukti+Transfer',
            'buktiStatus' => 'verified',
            'metode' => 'Transfer Bank',
        ],
        [
            'id' => 2,
            'name' => 'Raka Pratama',
            'kelas' => 'Matahari',
            'ortu' => 'Bapak Ahmad',
            'phone' => '6281234567891',
            'paket' => 'PAUD',
            'tipe' => 'Bulanan',
            'nominal' => 500000,
            'status' => 'pending',
            'tglBayar' => '-',
            'dueDate' => '2025-01-05',
            'bukti' => null,
            'buktiStatus' => 'none',
            'metode' => '-',
        ],
        [
            'id' => 3,
            'name' => 'Nadia Safitri',
            'kelas' => 'Bintang',
            'ortu' => 'Ibu Dewi',
            'phone' => '6281234567892',
            'paket' => 'Non-PAUD',
            'tipe' => 'Bulanan',
            'nominal' => 1000000,
            'status' => 'lunas',
            'tglBayar' => '2025-01-03',
            'dueDate' => '2025-01-03',
            'bukti' => 'https://placehold.co/300x200/e2e8f0/475569?text=Bukti+Transfer',
            'buktiStatus' => 'verified',
            'metode' => 'Cash',
        ],
        [
            'id' => 4,
            'name' => 'Dimas Aditya',
            'kelas' => 'Bulan',
            'ortu' => 'Ibu Rina',
            'phone' => '6281234567893',
            'paket' => 'PAUD',
            'tipe' => 'Harian',
            'nominal' => 35000,
            'status' => 'belum',
            'tglBayar' => '-',
            'dueDate' => '2025-01-03',
            'bukti' => null,
            'buktiStatus' => 'none',
            'metode' => '-',
        ],
        [
            'id' => 5,
            'name' => 'Zahra Aulia',
            'kelas' => 'Bunga',
            'ortu' => 'Bapak Budi',
            'phone' => '6281234567894',
            'paket' => 'Non-PAUD',
            'tipe' => 'Harian',
            'nominal' => 50000,
            'status' => 'lunas',
            'tglBayar' => '2025-01-06',
            'dueDate' => '2025-01-06',
            'bukti' => 'https://placehold.co/300x200/e2e8f0/475569?text=Bukti+Transfer',
            'buktiStatus' => 'pending',
            'metode' => 'Transfer Bank',
        ],
        [
            'id' => 6,
            'name' => 'Farhan Rizki',
            'kelas' => 'Matahari',
            'ortu' => 'Ibu Mega',
            'phone' => '6281234567895',
            'paket' => 'PAUD',
            'tipe' => 'Bulanan',
            'nominal' => 500000,
            'status' => 'terlambat',
            'tglBayar' => '-',
            'dueDate' => '2025-01-01',
            'bukti' => 'https://placehold.co/300x200/e2e8f0/475569?text=Bukti+Transfer',
            'buktiStatus' => 'rejected',
            'metode' => '-',
        ],
    ];

    $transactions = [
        [
            'child' => 'Aisyah Putri',
            'amount' => 500000,
            'date' => '2025-01-05',
            'method' => 'Transfer Bank',
            'status' => 'success',
        ],
        [
            'child' => 'Nadia Safitri',
            'amount' => 1000000,
            'date' => '2025-01-03',
            'method' => 'Cash',
            'status' => 'success',
        ],
        [
            'child' => 'Zahra Aulia',
            'amount' => 50000,
            'date' => '2025-01-06',
            'method' => 'Transfer Bank',
            'status' => 'pending',
        ],
        ['child' => 'Farhan Rizki', 'amount' => 500000, 'date' => '-', 'method' => '-', 'status' => 'overdue'],
    ];

    $months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
@endphp

{{-- ===== CONTENT ===== --}}
@section('content')
    <div x-data="{
        searchQuery: '',
        filterStatus: 'semua',
        filterBulan: new Date().getMonth(),
        showAddModal: false,
        showConfirmModal: false,
        showCancelModal: false,
        showExportModal: false,
        showWaModal: false,
        selectedPayment: null,
        selectedChildren: [],
        previewImage: null,
        waMessage: '',
        months: @js($months),
        get filteredChildren() {
            let result = {{ Js::from($children) }}.filter(c => c.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            if (this.filterStatus !== 'semua') {
                if (this.filterStatus === 'review') result = result.filter(c => c.buktiStatus === 'pending');
                else result = result.filter(c => c.status === this.filterStatus);
            }
            return result;
        },
        get selectedCount() { return this.selectedChildren.length; },
        get allSelected() { return this.filteredChildren.length > 0 && this.selectedCount === this.filteredChildren.length; },
        toggleSelectAll() {
            if (this.allSelected) this.selectedChildren = [];
            else this.selectedChildren = this.filteredChildren.map(c => c.id);
        },
        toggleSelect(id) {
            const idx = this.selectedChildren.indexOf(id);
            if (idx === -1) this.selectedChildren.push(id);
            else this.selectedChildren.splice(idx, 1);
        },
        formatRupiah(num) { return 'Rp ' + num.toLocaleString('id-ID'); },
        isOverdue(child) { return child.status !== 'lunas' && new Date(child.dueDate) < new Date(); },
        confirmPayment(child) {
            this.selectedPayment = child;
            this.showConfirmModal = true;
        },
        executePayment() {
            const child = {{ Js::from($children) }}.find(c => c.id === this.selectedPayment.id);
            child.status = 'lunas';
            child.tglBayar = new Date().toISOString().split('T')[0];
            this.showConfirmModal = false;
            this.showToast = true;
            this.toastMessage = 'Pembayaran ' + child.name + ' dikonfirmasi!';
        },
        rejectPayment(child) {
            child.buktiStatus = 'rejected';
            this.showToast = true;
            this.toastMessage = 'Bukti transfer ' + child.name + ' ditolak.';
        },
        approvePayment(child) {
            child.buktiStatus = 'verified';
            this.showToast = true;
            this.toastMessage = 'Bukti transfer ' + child.name + ' disetujui!';
        },
        confirmSelected() {
            this.selectedChildren.forEach(id => {
                const child = {{ Js::from($children) }}.find(c => c.id === id);
                if (child && child.status !== 'lunas') {
                    child.status = 'lunas';
                    child.tglBayar = new Date().toISOString().split('T')[0];
                }
            });
            this.showToast = true;
            this.toastMessage = this.selectedCount + ' pembayaran dikonfirmasi!';
            this.selectedChildren = [];
        },
        openWaModal(child) {
            this.selectedPayment = child;
            this.waMessage = 'Halo ' + child.ortu + '! Reminder pembayaran ' + child.name + ' bulan ' + this.months[new Date().getMonth()] + ' ' + this.formatRupiah(child.nominal) + '. Jatuh tempo: ' + child.dueDate;
            this.showWaModal = true;
        },
        sendWa() {
            window.open('https://wa.me/' + this.selectedPayment.phone + '?text=' + encodeURIComponent(this.waMessage), '_blank');
            this.showWaModal = false;
        },
        exportCSV() {
            this.showToast = true;
            this.toastMessage = 'Export CSV berhasil!';
        },
        exportExcel() {
            this.showToast = true;
            this.toastMessage = 'Export Excel berhasil!';
        },
    }" @open-add-payment.window="showAddModal = true">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="stat-card border-l-4 border-green-500 cursor-pointer" @click="filterStatus = 'lunas'">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Terkumpul</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1"
                            x-text="formatRupiah(1550000)"></p>
                        <p class="text-xs text-green-500 mt-1">3 anak lunas</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-yellow-500 cursor-pointer" @click="filterStatus = 'pending'">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Pending</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1"
                            x-text="formatRupiah(500000)"></p>
                        <p class="text-xs text-yellow-500 mt-1">1 anak menunggu</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-red-500 cursor-pointer" @click="filterStatus = 'terlambat'">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Overdue</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1">2 anak</p>
                        <p class="text-xs text-red-500 mt-1">Perlu ditagih</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center"><svg
                            class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg></div>
                </div>
            </div>
            <div class="stat-card border-l-4 border-imumu-blue cursor-pointer" @click="filterStatus = 'semua'">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400 dark:text-gray-400 font-medium">Outstanding</p>
                        <p class="text-2xl font-bold text-gray-700 dark:text-imumu-dark-text mt-1"
                            x-text="formatRupiah(1085000)"></p>
                        <p class="text-xs text-blue-500 mt-1">Total belum dibayar</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-imumu-blue-light/50 dark:bg-imumu-dark-blue/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-imumu-blue dark:text-imumu-dark-blue" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-400"><svg
                            class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg></span>
                    <input x-model="searchQuery" type="text" placeholder="Cari nama anak..." class="input-field pl-9">
                </div>
                <select x-model="filterStatus" class="input-field md:w-44">
                    <option value="semua">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="pending">Pending</option>
                    <option value="belum">Belum Bayar</option>
                    <option value="terlambat">Overdue</option>
                    <option value="review">Menunggu Review</option>
                </select>
                <select x-model="filterBulan" class="input-field md:w-36">
                    <template x-for="(m, i) in months" :key="i">
                        <option :value="i" x-text="m"></option>
                    </template>
                </select>
            </div>
        </div>

        {{-- Bulk Actions Bar --}}
        <div x-show="selectedCount > 0" x-transition
            class="bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/10 rounded-xl p-3 mb-4 flex items-center justify-between border border-imumu-pink/30 dark:border-imumu-dark-pink/30">
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-imumu-pink-dark dark:text-imumu-dark-pink"
                    x-text="selectedCount + ' dipilih'"></span>
                <button @click="confirmSelected()"
                    class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 transition-colors cursor-pointer">✅
                    Konfirmasi Selected</button>
                <button
                    @click="selectedChildren.forEach(id => { const c = filteredChildren.find(x => x.id === id); if (c) openWaModal(c); }); selectedChildren = [];"
                    class="px-3 py-1.5 bg-imumu-blue text-white text-xs font-semibold rounded-lg hover:bg-blue-500 transition-colors cursor-pointer">💬
                    Tagih Selected</button>
            </div>
            <button @click="selectedChildren = []"
                class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 cursor-pointer">Batal</button>
        </div>

        {{-- Main Table --}}
        <div class="card overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-imumu-pink-light/50 dark:bg-imumu-dark-surface">
                            <th class="px-4 py-3 text-center w-10"><input type="checkbox" @change="toggleSelectAll()"
                                    :checked="allSelected"
                                    class="w-4 h-4 text-imumu-pink-dark rounded border-gray-300 focus:ring-imumu-pink-dark cursor-pointer">
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nama
                                Anak</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kelas
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Paket
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Due
                                Date</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600 dark:text-gray-300">Nominal
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Bukti
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Status
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300 w-20">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="child in filteredChildren" :key="child.id">
                            <tr
                                class="border-b border-gray-50 dark:border-imumu-dark-border hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                                <td class="px-4 py-3 text-center"><input type="checkbox" :value="child.id"
                                        @change="toggleSelect(child.id)" :checked="selectedChildren.includes(child.id)"
                                        class="w-4 h-4 text-imumu-pink-dark rounded border-gray-300 focus:ring-imumu-pink-dark cursor-pointer">
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-imumu-pink-dark dark:text-imumu-dark-pink"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div><span class="font-medium text-gray-700 dark:text-imumu-dark-text text-sm"
                                                x-text="child.name"></span>
                                            <p class="text-xs text-gray-400 dark:text-gray-400" x-text="child.ortu"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400" x-text="child.kelas"></td>
                                <td class="px-4 py-3">
                                    <div class="text-sm"><span
                                            :class="child.paket === 'PAUD' ? 'badge-teal' : 'badge-purple'"
                                            x-text="child.paket"></span><span
                                            class="text-xs text-gray-400 dark:text-gray-400 ml-1"
                                            x-text="'- ' + child.tipe"></span></div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div>
                                        <p class="text-sm font-mono text-gray-700 dark:text-imumu-dark-text"
                                            x-text="new Date(child.dueDate).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })">
                                        </p>
                                        <template x-if="isOverdue(child)"><span
                                                class="text-[10px] text-red-500 font-semibold">OVERDUE</span></template>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-imumu-dark-text"
                                    x-text="formatRupiah(child.nominal)"></td>
                                <td class="px-4 py-3 text-center">
                                    <template x-if="child.bukti">
                                        <div class="flex items-center justify-center gap-2">
                                            <img :src="child.bukti" @click="previewImage = child.bukti"
                                                class="w-14 h-9 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity border border-gray-200 dark:border-imumu-dark-border"
                                                alt="Bukti">
                                            <template x-if="child.buktiStatus === 'verified'"><span
                                                    class="text-green-500 text-xs">✓</span></template>
                                            <template x-if="child.buktiStatus === 'pending'"><span
                                                    class="text-yellow-500 text-xs">⏳</span></template>
                                            <template x-if="child.buktiStatus === 'rejected'"><span
                                                    class="text-red-500 text-xs">✗</span></template>
                                        </div>
                                    </template>
                                    <template x-if="!child.bukti"><span
                                            class="text-gray-300 dark:text-gray-600 text-xs">-</span></template>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <template x-if="child.status === 'lunas'"><span
                                            class="badge badge-success">Lunas</span></template>
                                    <template x-if="child.status === 'pending'"><span
                                            class="badge badge-warning">Pending</span></template>
                                    <template x-if="child.status === 'belum'"><span class="badge badge-danger">Belum
                                            Bayar</span></template>
                                    <template x-if="child.status === 'terlambat'"><span
                                            class="badge badge-danger">Overdue</span></template>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                        <button @click="open = !open"
                                            class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-imumu-dark-surface rounded-lg transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <div x-show="open" x-transition
                                            class="absolute right-0 mt-1 w-44 bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-lg shadow-lg border border-gray-100 py-1 z-40">
                                            <template x-if="child.status !== 'lunas'">
                                                <button @click="confirmPayment(child); open = false"
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                                                    <svg class="w-4 h-4 text-green-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg> Konfirmasi
                                                </button>
                                            </template>
                                            <template x-if="child.bukti">
                                                <button @click="previewImage = child.bukti; open = false"
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                                                    <svg class="w-4 h-4 text-blue-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg> Lihat Bukti
                                                </button>
                                            </template>
                                            <template x-if="child.status !== 'lunas'">
                                                <button @click="openWaModal(child); open = false"
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                                                    <svg class="w-4 h-4 text-green-600" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                                    </svg> Kirim Reminder
                                                </button>
                                            </template>
                                            <template x-if="child.bukti && child.buktiStatus === 'pending'">
                                                <div class="border-t border-gray-100 dark:border-imumu-dark-border my-1">
                                                </div>
                                            </template>
                                            <template x-if="child.bukti && child.buktiStatus === 'pending'">
                                                <div class="px-3 py-1">
                                                    <div class="flex gap-2">
                                                        <button @click="approvePayment(child); open = false"
                                                            class="flex-1 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-600 rounded text-xs font-semibold hover:bg-green-200 cursor-pointer">✓
                                                            Approve</button>
                                                        <button @click="rejectPayment(child); open = false"
                                                            class="flex-1 px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 rounded text-xs font-semibold hover:bg-red-200 cursor-pointer">✗
                                                            Reject</button>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div x-show="filteredChildren.length === 0" class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-gray-400 dark:text-gray-400 mt-4">Tidak ada data pembayaran</p>
            </div>
        </div>

        {{-- Transaction History --}}
        <div class="card mt-6">
            <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text mb-4 font-poppins">📋 Riwayat Transaksi
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-imumu-dark-surface">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Anak
                            </th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600 dark:text-gray-300">Nominal
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">
                                Tanggal</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Metode
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(tx, index) in {{ Js::from($transactions) }}" :key="index">
                            <tr
                                class="border-b border-gray-50 dark:border-imumu-dark-border hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
                                <td class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-imumu-dark-text"
                                    x-text="tx.child"></td>
                                <td class="px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-imumu-dark-text"
                                    x-text="formatRupiah(tx.amount)"></td>
                                <td class="px-4 py-3 text-center text-sm font-mono text-gray-500 dark:text-gray-400"
                                    x-text="tx.date"></td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400"
                                    x-text="tx.method"></td>
                                <td class="px-4 py-3 text-center">
                                    <template x-if="tx.status === 'success'"><span
                                            class="badge badge-success">Berhasil</span></template>
                                    <template x-if="tx.status === 'pending'"><span
                                            class="badge badge-warning">Pending</span></template>
                                    <template x-if="tx.status === 'overdue'"><span
                                            class="badge badge-danger">Overdue</span></template>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== MODALS ===== --}}

        {{-- Preview Image Modal --}}
        <div x-show="previewImage" x-transition.opacity
            class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" @click.self="previewImage = null">
            <div class="bg-white dark:bg-imumu-dark-card rounded-xl shadow-xl max-w-lg w-full p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">Bukti Transfer</h4>
                    <button @click="previewImage = null" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg></button>
                </div>
                <img :src="previewImage"
                    class="w-full max-h-80 object-contain rounded-lg border border-gray-200 dark:border-imumu-dark-border"
                    alt="Bukti Transfer">
            </div>
        </div>

        {{-- Confirmation Modal --}}
        <div x-show="showConfirmModal" x-transition.opacity
            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div @click.away="showConfirmModal = false"
                class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-xl w-full max-w-sm overflow-hidden">
                <div class="bg-imumu-pink-dark p-4">
                    <h3 class="text-lg font-bold text-white">Konfirmasi Pembayaran</h3>
                </div>
                <div class="p-5 space-y-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Konfirmasi pembayaran untuk:</p>
                    <div class="bg-gray-50 dark:bg-imumu-dark-surface rounded-lg p-3 space-y-2">
                        <div class="flex justify-between text-sm"><span
                                class="text-gray-500 dark:text-gray-400">Nama</span><span
                                class="font-semibold text-gray-700 dark:text-imumu-dark-text"
                                x-text="selectedPayment?.name"></span></div>
                        <div class="flex justify-between text-sm"><span
                                class="text-gray-500 dark:text-gray-400">Nominal</span><span
                                class="font-semibold text-green-600"
                                x-text="selectedPayment ? formatRupiah(selectedPayment.nominal) : ''"></span></div>
                        <div class="flex justify-between text-sm"><span
                                class="text-gray-500 dark:text-gray-400">Paket</span><span
                                class="font-semibold text-gray-700 dark:text-imumu-dark-text"
                                x-text="selectedPayment ? selectedPayment.paket + ' - ' + selectedPayment.tipe : ''"></span>
                        </div>
                    </div>
                </div>
                <div class="p-4 pt-0 flex gap-2">
                    <button @click="showConfirmModal = false" class="btn-secondary flex-1 text-sm py-2">Batal</button>
                    <button @click="executePayment()" class="btn-success flex-1 text-sm py-2">Ya, Konfirmasi</button>
                </div>
            </div>
        </div>

        {{-- Add Payment Modal --}}
        <div x-show="showAddModal" x-transition.opacity
            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div x-show="showAddModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                @click.away="showAddModal = false"
                class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-xl w-full max-w-md overflow-hidden">
                <div class="bg-imumu-pink-dark p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Tambah Pembayaran</h3>
                        <button @click="showAddModal = false" class="text-white/80 hover:text-white"><svg class="w-5 h-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                </div>
                <div class="p-5 space-y-4">
                    <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Pilih
                            Anak</label><select class="input-field">
                            <option value="">-- Pilih Anak --</option><template
                                x-for="child in {{ Js::from($children) }}" :key="child.id">
                                <option :value="child.id" x-text="child.name + ' (' + child.kelas + ')'"></option>
                            </template>
                        </select></div>
                    <div class="grid grid-cols-2 gap-3">
                        <div><label
                                class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Bulan</label><select
                                class="input-field"><template x-for="(m, i) in months" :key="i">
                                    <option :value="i" x-text="m"></option>
                                </template></select></div>
                        <div><label
                                class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Tahun</label><input
                                type="number" value="2025" class="input-field"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div><label
                                class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Paket</label><select
                                class="input-field">
                                <option value="paud-bulanan">PAUD - Bulanan</option>
                                <option value="paud-harian">PAUD - Harian</option>
                                <option value="nonpaud-bulanan">Non-PAUD - Bulanan</option>
                                <option value="nonpaud-harian">Non-PAUD - Harian</option>
                            </select></div>
                        <div><label
                                class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nominal</label><input
                                type="text" value="Rp 500.000" class="input-field"></div>
                    </div>
                    <div><label
                            class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Metode</label><select
                            class="input-field">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet</option>
                        </select></div>
                    <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Upload Bukti
                            (opsional)</label>
                        <div
                            class="border-2 border-dashed border-gray-300 dark:border-imumu-dark-border rounded-xl p-6 text-center hover:border-imumu-pink-dark transition-colors cursor-pointer">
                            <svg class="w-8 h-8 mx-auto text-gray-400 dark:text-gray-500 mb-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-gray-400">Klik atau drag file ke sini</p>
                            <p class="text-xs text-gray-300 dark:text-gray-500 mt-1">Max 2MB (JPG, PNG)</p>
                        </div>
                    </div>
                    <div><label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Catatan</label>
                        <textarea rows="2" placeholder="Opsional..." class="input-field resize-none"></textarea>
                    </div>
                </div>
                <div class="p-4 pt-0 flex gap-2">
                    <button @click="showAddModal = false" class="btn-secondary flex-1 text-sm py-2">Batal</button>
                    <button
                        @click="showAddModal = false; showToast = true; toastMessage = 'Pembayaran berhasil ditambahkan!'"
                        class="btn-success flex-1 text-sm py-2">Simpan</button>
                </div>
            </div>
        </div>

        {{-- WhatsApp Reminder Modal --}}
        <div x-show="showWaModal" x-transition.opacity
            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div @click.away="showWaModal = false"
                class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-xl w-full max-w-md overflow-hidden">
                <div class="bg-green-500 p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">💬 Kirim Reminder WhatsApp</h3>
                        <button @click="showWaModal = false" class="text-white/80 hover:text-white"><svg class="w-5 h-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                </div>
                <div class="p-5 space-y-3">
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3">
                        <p class="text-sm font-semibold text-green-700 dark:text-green-400">Kepada: <span
                                x-text="selectedPayment?.ortu"></span></p>
                        <p class="text-sm text-green-600 dark:text-green-400">Untuk pembayaran: <span
                                x-text="selectedPayment?.name"></span></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Preview
                            Pesan</label>
                        <textarea x-model="waMessage" rows="8" class="input-field resize-none font-mono text-sm"></textarea>
                    </div>
                </div>
                <div class="p-4 pt-0 flex gap-2">
                    <button @click="showWaModal = false" class="btn-secondary flex-1 text-sm py-2">Batal</button>
                    <button @click="sendWa()" class="btn-success flex-1 text-sm py-2">💬 Kirim via WhatsApp</button>
                </div>
            </div>
        </div>
    </div>
@endsection
