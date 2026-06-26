@extends('layouts.dashboard')

@php
    $activePage = 'pembayaran';
    $title = 'Pembayaran - ' . $child->name;
    $subtitle = $child->parent_name . ' • ' . ($child->enrollment?->package?->label ?? '—');

    $monthNames = [
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
    $dayNames = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
@endphp

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Child Info --}}
        <div class="card">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-teal/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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
            {{-- BULANAN: Calendar preview + start date picker --}}
            <div x-data="bulananApp()" class="space-y-6">

                {{-- Start Date Picker --}}
                <div class="card">
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-gray-700 dark:text-imumu-dark-text mb-1">Pilih Tanggal Mulai
                                Pencatatan</h3>
                            <p class="text-xs text-gray-400">Kalender akan menampilkan 1 bulan ke depan (Minggu tidak
                                dihitung)</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="date" x-model="startDateInput" @change="onStartDateChange()"
                                class="input-field text-sm px-3 py-2">
                            <button @click="startDateInput = ''; calMonths = []; selectedDates = []" x-show="startDateInput"
                                class="btn-secondary text-xs px-3 py-2">Reset</button>
                        </div>
                    </div>
                </div>

                {{-- Calendar Preview --}}
                <template x-if="calMonths.length > 0">
                    <div class="space-y-4">
                        <template x-for="(calMonth, mIdx) in calMonths" :key="mIdx">
                            <div class="card">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text" x-text="calMonth.label">
                                    </h4>
                                    <span class="text-xs text-gray-400" x-text="calMonth.count + ' hari kerja'"></span>
                                </div>
                                {{-- Legend --}}
                                <div
                                    class="flex flex-wrap gap-4 mb-3 text-xs font-semibold text-gray-600 dark:text-gray-300">
                                    <span class="flex items-center gap-1.5">
                                        <span class="inline-block w-4 h-4 rounded bg-teal-500 dark:bg-teal-600"></span>
                                        Terhitung
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <span
                                            class="inline-block w-4 h-4 rounded bg-red-100 dark:bg-red-900/40 border border-red-300"></span>
                                        Minggu (tidak dihitung)
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <span class="inline-block w-4 h-4 rounded bg-gray-200 dark:bg-gray-700"></span> Di
                                        luar periode
                                    </span>
                                </div>
                                <div class="grid grid-cols-7 gap-1 text-center">
                                    @foreach ($dayNames as $day)
                                        <div
                                            class="py-2 text-xs font-bold {{ $loop->last ? 'text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $day }}</div>
                                    @endforeach
                                    <template x-for="(week, wIdx) in calMonth.weeks" :key="wIdx">
                                        <template x-for="(day, dIdx) in week" :key="dIdx">
                                            <button x-show="day.date || !day.date" disabled
                                                class="w-full aspect-square rounded-lg text-sm font-bold flex items-center justify-center transition-all"
                                                :class="{
                                                    'bg-teal-500 dark:bg-teal-600 text-white': day.status === 'selected',
                                                    'bg-red-100 dark:bg-red-900/40 text-red-400 border border-red-200 dark:border-red-800': day.status === 'sunday',
                                                    'bg-gray-100 dark:bg-gray-700/50 text-gray-300 dark:text-gray-600': day.status === 'outside',
                                                    'opacity-0 pointer-events-none': !day.date,
                                                }"
                                                x-text="day.date">
                                            </button>
                                        </template>
                                    </template>
                                </div>
                            </div>
                        </template>

                        {{-- Summary & Action --}}
                        <div class="card">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm text-gray-400 dark:text-gray-300">Total hari terhitung: <strong
                                            class="text-gray-700 dark:text-gray-200"
                                            x-text="selectedDates.length + ' hari'"></strong></p>
                                    <p class="text-lg font-bold text-teal"
                                        x-text="'Biaya: Rp {{ number_format($dailyRate, 0, ',', '.') }} (flat bulanan)'">
                                    </p>
                                </div>
                                <button @click="tagihWA()" :disabled="selectedDates.length === 0"
                                    :class="selectedDates.length === 0 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
                                    class="btn-primary px-6 py-2 text-sm flex items-center gap-2">
                                    💸 Tagih via WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Hidden form --}}
                <form id="storePaymentFormBulanan" action="{{ route('dashboard.pembayaran.child.store', $child) }}"
                    method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="hidden" name="dates" id="datesInputBulanan">
                    <input type="hidden" name="amount" id="amountInputBulanan" value="{{ $dailyRate }}">
                    <input type="hidden" name="payment_method" value="transfer">
                </form>

                {{-- WA Modal --}}
                <div id="waModalBulanan" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
                    <div class="bg-white dark:bg-imumu-dark-card rounded-2xl shadow-xl max-w-lg w-full mx-4 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-gray-700 dark:text-imumu-dark-text">💬 Preview Pesan WhatsApp</h3>
                            <button @click="document.getElementById('waModalBulanan').classList.add('hidden')"
                                class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                        </div>
                        <pre id="waMessagePreviewBulanan"
                            class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4 text-sm whitespace-pre-wrap font-sans text-gray-700 dark:text-gray-200 max-h-60 overflow-y-auto"></pre>
                        <div class="flex gap-3 mt-4">
                            <button @click="document.getElementById('waModalBulanan').classList.add('hidden')"
                                class="btn-secondary flex-1 text-sm py-2">Batal</button>
                            <a id="waSendLinkBulanan" href="#" target="_blank"
                                class="btn-primary flex-1 text-sm py-2 text-center no-underline" style="background:#25d366">
                                💬 Buka WhatsApp
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-400 mb-2 font-semibold">Setelah ortu kirim bukti, upload di sini:
                            </p>
                            <div class="flex gap-2 items-center">
                                <input type="file" id="buktiUploadBulanan" accept="image/*"
                                    class="input-field text-sm flex-1">
                                <button @click="confirmAndStore()"
                                    :disabled="!document.getElementById('buktiUploadBulanan').files.length"
                                    :class="!document.getElementById('buktiUploadBulanan').files.length ?
                                        'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
                                    class="btn-success text-sm py-2 px-4">
                                    ✓ Simpan & Lunas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                            ‹ {{ $monthNames[$month - 2 < 0 ? 11 : $month - 2] }}
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
                            <span
                                class="inline-block w-4 h-4 rounded border-2 border-gray-300 dark:border-gray-500 ring-2 ring-offset-1 ring-orange-400"></span>
                            Hari ini
                        </span>
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
                            <span
                                class="inline-block w-4 h-4 rounded border-2 border-gray-300 dark:border-gray-500"></span>
                            Tersedia
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block w-4 h-4 rounded bg-gray-200 dark:bg-gray-600"></span> Nonaktif
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span
                                class="inline-block w-4 h-4 rounded bg-red-100 dark:bg-red-900/40 border border-red-300"></span>
                            Minggu
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
                                <button x-show="day.date" @click="toggleDate(day)"
                                    :disabled="day.status === 'paid' || day.status === 'pending' || day
                                        .status === 'disabled' || day.status === 'sunday'"
                                    :class="{
                                        'ring-2 ring-offset-1 ring-orange-400 dark:ring-orange-400': day.isToday,
                                        'bg-red-100 dark:bg-red-900/40 text-red-400 border border-red-200 dark:border-red-800': day
                                            .status === 'sunday',
                                        'bg-blue-500 dark:bg-blue-600 text-white hover:bg-blue-600 dark:hover:bg-blue-700': day
                                            .status === 'paid',
                                        'bg-yellow-400 dark:bg-yellow-500 text-white': day.status === 'pending',
                                        'bg-teal-500 dark:bg-teal-600 text-white hover:bg-teal-600 dark:hover:bg-teal-700': day
                                            .status === 'selected',
                                        'bg-white dark:bg-imumu-dark-card hover:bg-teal-50 dark:hover:bg-teal-900/20 border-2 border-gray-200 dark:border-gray-600 hover:border-teal-400 dark:hover:border-teal-500': day
                                            .status === 'available',
                                        'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500': day
                                            .status === 'disabled',
                                        'opacity-0 pointer-events-none': !day.date,
                                        'cursor-pointer': day.status === 'available' || day.status === 'selected',
                                        'cursor-not-allowed': day.status === 'paid' || day
                                            .status === 'pending' || day.status === 'disabled' || day
                                            .status === 'sunday',
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
                            <p class="text-sm text-gray-400 dark:text-gray-300">Tanggal dipilih: <strong
                                    class="text-gray-700 dark:text-gray-200" x-text="selectedCount + ' hari'"></strong>
                            </p>
                            <p class="text-lg font-bold text-teal"
                                x-text="'Total: Rp ' + formatIDR(selectedCount * {{ (int) $dailyRate }})"></p>
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
                <form id="storePaymentForm" action="{{ route('dashboard.pembayaran.child.store', $child) }}"
                    method="POST" enctype="multipart/form-data" class="space-y-4 hidden">
                    @csrf
                    <input type="hidden" name="dates" id="datesInput">
                    <input type="hidden" name="amount" id="amountInput">
                    <input type="hidden" name="payment_method" value="transfer">
                </form>

                {{-- WA Preview Modal --}}
                <div id="waModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden"
                    @click.self="if(event.target === $el) document.getElementById('waModal').classList.add('hidden')">
                    <div class="bg-white dark:bg-imumu-dark-card rounded-2xl shadow-xl max-w-lg w-full mx-4 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-gray-700 dark:text-imumu-dark-text">💬 Preview Pesan WhatsApp</h3>
                            <button @click="document.getElementById('waModal').classList.add('hidden')"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl">&times;</button>
                        </div>
                        <pre id="waMessagePreview"
                            class="bg-gray-50 dark:bg-imumu-dark-surface rounded-xl p-4 text-sm whitespace-pre-wrap font-sans text-gray-700 dark:text-gray-200 max-h-60 overflow-y-auto"></pre>
                        <div class="flex gap-3 mt-4">
                            <button @click="document.getElementById('waModal').classList.add('hidden')"
                                class="btn-secondary flex-1 text-sm py-2">Batal</button>
                            <a id="waSendLink" href="#" target="_blank"
                                class="btn-primary flex-1 text-sm py-2 text-center no-underline"
                                style="background:#25d366">
                                💬 Buka WhatsApp
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-2 font-semibold">Setelah ortu kirim
                                bukti, upload di sini:</p>
                            <div class="flex gap-2 items-center">
                                <input type="file" id="buktiUpload" accept="image/*"
                                    class="input-field text-sm flex-1">
                                <button @click="confirmAndStore()"
                                    :disabled="!document.getElementById('buktiUpload').files.length"
                                    :class="!document.getElementById('buktiUpload').files.length ?
                                        'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
                                    class="btn-success text-sm py-2 px-4">
                                    ✓ Simpan & Lunas
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Upload screenshot bukti transfer dari
                                WhatsApp</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        function bulananApp() {
            const monthNames = @json($monthNames);

            function buildMonthGrid(year, month, startDate, endDate) {
                const firstDay = new Date(year, month, 1).getDay();
                const paddingCount = firstDay === 0 ? 6 : firstDay - 1;
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const cells = [];
                let count = 0;

                for (let i = 0; i < paddingCount; i++) cells.push({
                    date: null,
                    status: 'outside'
                });

                for (let d = 1; d <= daysInMonth; d++) {
                    const cur = new Date(year, month, d);
                    const isSunday = cur.getDay() === 0;
                    const inRange = cur >= startDate && cur <= endDate;
                    let status = 'outside';
                    if (isSunday && inRange) status = 'sunday';
                    else if (inRange) {
                        status = 'selected';
                        count++;
                    }
                    cells.push({
                        date: d,
                        status
                    });
                }

                const weeks = [];
                for (let i = 0; i < cells.length; i += 7) weeks.push(cells.slice(i, i + 7));
                return {
                    weeks,
                    count,
                    label: monthNames[month] + ' ' + year
                };
            }

            return {
                startDateInput: '',
                calMonths: [],
                selectedDates: [],

                onStartDateChange() {
                    if (!this.startDateInput) {
                        this.calMonths = [];
                        this.selectedDates = [];
                        return;
                    }
                    const start = new Date(this.startDateInput + 'T00:00:00');
                    const end = new Date(start);
                    end.setMonth(end.getMonth() + 1);
                    end.setDate(end.getDate() - 1);

                    const dates = [];
                    const cur = new Date(start);
                    while (cur <= end) {
                        if (cur.getDay() !== 0) {
                            const y = cur.getFullYear();
                            const mo = String(cur.getMonth() + 1).padStart(2, '0');
                            const dy = String(cur.getDate()).padStart(2, '0');
                            dates.push(`${y}-${mo}-${dy}`);
                        }
                        cur.setDate(cur.getDate() + 1);
                    }
                    this.selectedDates = dates;

                    const months = [];
                    let y = start.getFullYear(),
                        m = start.getMonth();
                    while (y < end.getFullYear() || (y === end.getFullYear() && m <= end.getMonth())) {
                        months.push(buildMonthGrid(y, m, start, end));
                        m++;
                        if (m > 11) {
                            m = 0;
                            y++;
                        }
                    }
                    this.calMonths = months;
                    this.weeks = [true];
                },

                tagihWA() {
                    if (!this.selectedDates.length) return;
                    const amount = {{ (int) $dailyRate }};
                    fetch('{{ route('dashboard.pembayaran.child.wa', $child) }}?dates=' + encodeURIComponent(JSON
                            .stringify(this.selectedDates)) + '&amount=' + amount)
                        .then(r => r.json())
                        .then(data => {
                            document.getElementById('waMessagePreviewBulanan').textContent = data.message;
                            document.getElementById('waSendLinkBulanan').href = data.wa_url;
                            document.getElementById('datesInputBulanan').value = JSON.stringify(this.selectedDates);
                            document.getElementById('waModalBulanan').classList.remove('hidden');
                        });
                },

                confirmAndStore() {
                    const bukti = document.getElementById('buktiUploadBulanan');
                    if (!bukti.files.length) return;
                    const form = document.getElementById('storePaymentFormBulanan');
                    const fd = new FormData(form);
                    fd.append('bukti_transfer', bukti.files[0]);
                    fetch(form.action, {
                            method: 'POST',
                            body: fd,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => r.redirected ? window.location.href = r.url : window.location.reload())
                        .catch(() => form.submit());
                },
            };
        }

        function calendarApp() {
            return {
                paidDates: {{ json_encode($paidDates) }},
                pendingDates: {{ json_encode($pendingDates) }},
                selectedDates: [],
                cells: [],
                weeks: [],
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
                    minDate.setDate(today.getDate() - 7);
                    const maxDate = new Date(today);
                    maxDate.setDate(today.getDate() + 14);

                    const cells = [];

                    const paddingCount = (firstDay + 6) % 7;
                    for (let i = 0; i < paddingCount; i++) {
                        cells.push({
                            date: null,
                            dateStr: null,
                            status: null
                        });
                    }

                    for (let d = 1; d <= daysInMonth; d++) {
                        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                        const cellDate = new Date(year, month, d);
                        let status = 'available';

                        if (cellDate.getDay() === 0) {
                            status = 'sunday';
                        } else if (this.paidDates.includes(dateStr)) {
                            status = 'paid';
                        } else if (this.pendingDates.includes(dateStr)) {
                            status = 'pending';
                        } else if (this.selectedDates.includes(dateStr)) {
                            status = 'selected';
                        } else if (cellDate < minDate || cellDate > maxDate) {
                            status = 'disabled';
                        }

                        cells.push({
                            date: d,
                            dateStr: dateStr,
                            status: status,
                            isToday: cellDate.getTime() === today.getTime()
                        });
                    }

                    this.cells = cells;
                    const weeks = [];
                    for (let i = 0; i < cells.length; i += 7) weeks.push(cells.slice(i, i + 7));
                    this.weeks = weeks;
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

                    fetch('{{ route('dashboard.pembayaran.child.wa', $child) }}?dates=' + encodeURIComponent(JSON
                            .stringify(dates)) + '&amount=' + amount)
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
