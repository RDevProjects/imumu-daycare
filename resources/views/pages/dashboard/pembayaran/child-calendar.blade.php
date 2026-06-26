@extends('layouts.dashboard')

@php
    $activePage = 'pembayaran';
    $title = 'Pembayaran - ' . $child->name;
    $subtitle = $child->parent_name . ' • ' . ($child->enrollment?->package?->label ?? '—');

    $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
@endphp

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Child Info --}}
        <div class="card">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-teal/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-700 dark:text-imumu-dark-text">{{ $child->name }}</h2>
                    <p class="text-sm text-gray-400">{{ $child->parent_name }} • {{ $child->parent_phone }}</p>
                    <p class="text-xs text-gray-400">
                        Paket: {{ $child->enrollment?->package?->label ?? '—' }}
                        • Rp {{ number_format($dailyRate, 0, ',', '.') }}/{{ $packageType === 'harian' ? 'hari' : 'bulan' }}
                    </p>
                </div>
            </div>
        </div>

        @if ($packageType === 'bulanan')
            {{-- BULANAN: Fixed payment --}}
            <div x-data="{ showWaModal: false, waMessage: '' }" class="card text-center py-10">
                <div class="mb-6">
                    <div class="w-20 h-20 mx-auto bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-imumu-dark-text mb-2">Pembayaran Bulanan</h3>
                    <p class="text-4xl font-black text-teal">Rp {{ number_format($dailyRate, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-400 mt-1">Biaya tetap per bulan</p>
                </div>
                <button @click="
                    const banks = @json(\App\Models\Bank::active()->get()->map(fn($b) => $b->bank_name . ' - ' . $b->account_number . ' a.n. ' . $b->account_name)->join('\n'));
                    const phone = '{{ $child->parent_phone }}';
                    const cleanPhone = phone.replace(/[^0-9+]/g, '').replace(/^0/, '62');
                    const msg = `Assalamu\\u0027alaikum Bapak/Ibu {{ $child->parent_name }}!\\n\\nPembayaran bulanan untuk {{ $child->name }}:\\nBiaya: Rp {{ number_format($dailyRate, 0, ',', '.') }}\\n\\nTransfer ke:\\n${banks}\\n\\nSetelah transfer, kirimkan buktinya ke sini ya.`;
                    window.open('https://wa.me/' + cleanPhone + '?text=' + encodeURIComponent(msg), '_blank');
                " class="btn-primary px-8 py-3 text-sm">💸 Tagih via WhatsApp</button>
            </div>

        @else
            {{-- HARIAN: Calendar with date selection --}}
            <div x-data="calendarApp()">

                {{-- Calendar Card --}}
                <div class="card">
                    {{-- Month Navigation --}}
                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('dashboard.pembayaran.child', ['child' => $child, 'month' => $month - 1 < 1 ? 12 : $month - 1, 'year' => $month - 1 < 1 ? $year - 1 : $year]) }}"
                            class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-imumu-dark-surface hover:bg-gray-200 dark:hover:bg-gray-700 font-semibold text-sm transition-colors no-underline text-gray-700 dark:text-gray-200">
                            ‹ {{ $monthNames[($month - 2 < 0 ? 11 : $month - 2)] }}
                        </a>
                        <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">
                            {{ $monthNames[$month - 1] }} {{ $year }}
                        </h3>
                        <a href="{{ route('dashboard.pembayaran.child', ['child' => $child, 'month' => $month + 1 > 12 ? 1 : $month + 1, 'year' => $month + 1 > 12 ? $year + 1 : $year]) }}"
                            class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-imumu-dark-surface hover:bg-gray-200 dark:hover:bg-gray-700 font-semibold text-sm transition-colors no-underline text-gray-700 dark:text-gray-200">
                            {{ $monthNames[$month % 12] }} ›
                        </a>
                    </div>

                    {{-- Legend --}}
                    <div class="flex flex-wrap gap-4 mb-4 text-xs font-semibold text-gray-600 dark:text-gray-300">
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded bg-blue-500 dark:bg-blue-600"></span> Lunas
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded bg-yellow-400 dark:bg-yellow-500"></span> Pending
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded bg-teal-500 dark:bg-teal-600"></span> Dipilih
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded border-2 border-gray-300 dark:border-gray-500"></span> Tersedia
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded bg-gray-200 dark:bg-gray-600"></span> Nonaktif
                        </span>
                    </div>

                    {{-- Max 10 hari notice --}}
                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-3">Maksimal 10 hari dapat dipilih</p>

                    {{-- Calendar Grid --}}
                    <div class="grid grid-cols-7 gap-1 text-center" x-init="initCalendar()">
                        @foreach ($dayNames as $day)
                            <div class="py-2 text-xs font-bold text-gray-400 dark:text-gray-500">{{ $day }}</div>
                        @endforeach

                        <template x-for="(week, weekIdx) in weeks" :key="'week-' + weekIdx">
                            <template x-for="(day, dayIdx) in week" :key="day.dateStr || dayIdx">
                                <button x-show="day.date"
                                    @click="toggleDate(day)"
                                    :disabled="day.status === 'paid' || day.status === 'pending' || day.status === 'disabled'"
                                    :class="{
                                        'bg-blue-500 dark:bg-blue-600 text-white hover:bg-blue-600 dark:hover:bg-blue-700': day.status === 'paid',
                                        'bg-yellow-400 dark:bg-yellow-500 text-white': day.status === 'pending',
                                        'bg-teal-500 dark:bg-teal-600 text-white hover:bg-teal-600 dark:hover:bg-teal-700': day.status === 'selected',
                                        'bg-white dark:bg-imumu-dark-card hover:bg-teal-50 dark:hover:bg-teal-900/20 border-2 border-gray-200 dark:border-gray-600 hover:border-teal-400 dark:hover:border-teal-500': day.status === 'available',
                                        'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500': day.status === 'disabled',
                                        'opacity-0 pointer-events-none': !day.date,
                                        'cursor-pointer': day.status === 'available' || day.status === 'selected',
                                        'cursor-not-allowed': day.status === 'paid' || day.status === 'pending' || day.status === 'disabled',
                                    }"
                                    class="w-full aspect-square rounded-lg text-sm font-bold transition-all flex items-center justify-center"
                                    x-text="day.date">
                                </button>
                            </template>
                        </template>
                    </div>
                </div>

                {{-- Summary & Action --}}
                <div class="card">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-400 dark:text-gray-300">Tanggal dipilih: <strong class="text-gray-700 dark:text-gray-200" x-text="selectedCount + ' hari'"></strong></p>
                            <p class="text-lg font-bold text-teal" x-text="'Total: Rp ' + formatIDR(selectedCount * {{ (int) $dailyRate }})"></p>
                        </div>
                        <div class="flex gap-3">
                            <button @click="clearSelection()" class="btn-secondary px-4 py-2 text-sm">Reset</button>
                            <button @click="tagihWA()" :disabled="selectedCount === 0"
                                :class="selectedCount === 0 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
                                class="btn-primary px-6 py-2 text-sm flex items-center gap-2">
                                💸 Tagih via WhatsApp
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Hidden form for store recurring --}}
                <form id="storePaymentForm" action="{{ route('dashboard.pembayaran.child.store', $child) }}" method="POST" enctype="multipart/form-data" class="space-y-4 hidden">
                    @csrf
                    <input type="hidden" name="dates" id="datesInput">
                    <input type="hidden" name="amount" id="amountInput">
                    <input type="hidden" name="payment_method" value="transfer">
                </form>

                {{-- WA Preview Modal --}}
                <div id="waModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden" @click.self="if(event.target === $el) document.getElementById('waModal').classList.add('hidden')">
                    <div class="bg-white dark:bg-imumu-dark-card rounded-2xl shadow-xl max-w-lg w-full mx-4 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-gray-700 dark:text-imumu-dark-text">💬 Preview Pesan WhatsApp</h3>
                            <button @click="document.getElementById('waModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl">&times;</button>
                        </div>
                        <pre id="waMessagePreview" class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4 text-sm whitespace-pre-wrap font-sans text-gray-700 dark:text-gray-200 max-h-60 overflow-y-auto"></pre>
                        <div class="flex gap-3 mt-4">
                            <button @click="document.getElementById('waModal').classList.add('hidden')" class="btn-secondary flex-1 text-sm py-2">Batal</button>
                            <a id="waSendLink" href="#" target="_blank" class="btn-primary flex-1 text-sm py-2 text-center no-underline" style="background:#25d366">
                                💬 Buka WhatsApp
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-2 font-semibold">Setelah ortu kirim bukti, upload di sini:</p>
                            <div class="flex gap-2 items-center">
                                <input type="file" id="buktiUpload" accept="image/*" class="input-field text-sm flex-1">
                                <button @click="confirmAndStore()" :disabled="!document.getElementById('buktiUpload').files.length"
                                    :class="!document.getElementById('buktiUpload').files.length ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
                                    class="btn-success text-sm py-2 px-4">
                                    ✓ Simpan & Lunas
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Upload screenshot bukti transfer dari WhatsApp</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        function calendarApp() {
            return {
                paidDates: {{ json_encode($paidDates) }},
                pendingDates: {{ json_encode($pendingDates) }},
                selectedDates: [],
                cells: [],
                selectedCount: 0,

                initCalendar() {
                    this.buildCalendar();
                },

                buildCalendar() {
                    const year = {{ $year }};
                    const month = {{ $month }} - 1;
                    const firstDay = new Date(year, month, 1).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    const minDate = new Date(today);
                    minDate.setDate(today.getDate() - 10);

                    const cells = [];

                    for (let i = 0; i < firstDay; i++) {
                        cells.push({ date: null, dateStr: null, status: null });
                    }

                    for (let d = 1; d <= daysInMonth; d++) {
                        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                        const cellDate = new Date(year, month, d);
                        let status = 'available';

                        if (this.paidDates.includes(dateStr)) {
                            status = 'paid';
                        } else if (this.pendingDates.includes(dateStr)) {
                            status = 'pending';
                        } else if (this.selectedDates.includes(dateStr)) {
                            status = 'selected';
                        } else if (cellDate < minDate || cellDate > today) {
                            status = 'disabled';
                        }

                        cells.push({ date: d, dateStr: dateStr, status: status });
                    }

                    this.cells = cells;
                    this.updateCount();
                },

                toggleDate(day) {
                    if (day.status === 'paid' || day.status === 'pending' || day.status === 'disabled' || !day.date) return;

                    const idx = this.selectedDates.indexOf(day.dateStr);
                    if (idx > -1) {
                        this.selectedDates.splice(idx, 1);
                        day.status = 'available';
                    } else {
                        if (this.selectedDates.length >= 10) return;
                        this.selectedDates.push(day.dateStr);
                        day.status = 'selected';
                    }
                    this.updateCount();
                },

                updateCount() {
                    this.selectedCount = this.selectedDates.length;
                },

                clearSelection() {
                    this.selectedDates = [];
                    this.buildCalendar();
                },

                formatIDR(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },

                tagihWA() {
                    if (this.selectedCount === 0) return;

                    const dates = this.selectedDates.sort();
                    const amount = this.selectedCount * {{ (int) $dailyRate }};

                    fetch('{{ route('dashboard.pembayaran.child.wa', $child) }}?dates=' + encodeURIComponent(JSON.stringify(dates)) + '&amount=' + amount)
                        .then(r => r.json())
                        .then(data => {
                            document.getElementById('waMessagePreview').textContent = data.message;
                            document.getElementById('waSendLink').href = data.wa_url;
                            document.getElementById('waModal').classList.remove('hidden');
                        });
                },

                confirmAndStore() {
                    const buktiInput = document.getElementById('buktiUpload');
                    if (!buktiInput.files.length) return;

                    const form = document.getElementById('storePaymentForm');
                    document.getElementById('datesInput').value = JSON.stringify(this.selectedDates.sort());
                    document.getElementById('amountInput').value = this.selectedCount * {{ (int) $dailyRate }};

                    const formData = new FormData(form);
                    formData.append('bukti_transfer', buktiInput.files[0]);

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(r => {
                        if (r.redirected) {
                            window.location.href = r.url;
                        } else {
                            window.location.reload();
                        }
                    }).catch(() => {
                        form.submit();
                    });
                }
            }
        }
    </script>
@endsection
