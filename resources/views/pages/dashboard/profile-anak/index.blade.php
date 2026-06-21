@extends('layouts.dashboard')

@php
    $activePage = 'profile-anak';
    $title = 'Profile Anak';
    $subtitle = 'Kelola data anak terdaftar';

    $statusColors = [
        'aktif' => [
            'bg' => 'bg-green-100 dark:bg-green-900/30',
            'text' => 'text-green-600 dark:text-green-400',
            'label' => 'Aktif',
        ],
        'cuti' => [
            'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
            'text' => 'text-yellow-600 dark:text-yellow-400',
            'label' => 'Cuti',
        ],
        'sakit' => [
            'bg' => 'bg-red-100 dark:bg-red-900/30',
            'text' => 'text-red-600 dark:text-red-400',
            'label' => 'Sakit',
        ],
        'pindah' => [
            'bg' => 'bg-gray-100 dark:bg-gray-800',
            'text' => 'text-gray-600 dark:text-gray-400',
            'label' => 'Pindah',
        ],
        'lulus' => [
            'bg' => 'bg-blue-100 dark:bg-blue-900/30',
            'text' => 'text-blue-600 dark:text-blue-400',
            'label' => 'Lulus',
        ],
    ];

    $paymentLabels = [
        'pending' => 'Menunggu',
        'verified' => 'Terverifikasi',
        'paid' => 'Lunas',
        'cash' => 'Tunai',
        'overdue' => 'Jatuh Tempo',
        'review' => 'Direview',
    ];
@endphp

@section('content')
    <div class="space-y-6" x-data="{ showAddModal: false }">

        {{-- Filter & Add Button --}}
        <div class="flex flex-wrap gap-3 items-center justify-between">
            <div class="flex-1">
                <form method="GET" class="flex flex-wrap gap-3">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="🔍 Cari nama anak / orang tua..." class="input-field w-full">
                    </div>
                    <button type="submit" class="btn-primary px-6">Filter</button>
                    <a href="{{ route('dashboard.profile-anak') }}" class="btn-secondary px-4">Reset</a>
                </form>
            </div>
            <a href="{{ route('dashboard.pendaftaran') }}" class="btn-primary px-4 py-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Anak
            </a>
        </div>

        {{-- Children Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($children as $child)
                @php
                    $status = $statusColors[$child->status] ?? $statusColors['aktif'];
                @endphp
                <div x-data="{ expanded: false }" @click="expanded = ! expanded"
                    class="bg-white dark:bg-imumu-dark-card rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 dark:border-imumu-dark-border cursor-pointer">

                    <div class="p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-imumu-pink-light/50 dark:bg-imumu-dark-pink/20 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-700 dark:text-imumu-dark-text">{{ $child->name }}</h4>
                                    @if ($child->birth_date)
                                        <p class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($child->birth_date)->locale('id')->diffForHumans(['short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-bold {{ $status['bg'] }} {{ $status['text'] }}">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-gray-100 dark:border-imumu-dark-border">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Nama Orang Tua:{{ $child->parent_name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Telepon Orang Tua:{{ $child->parent_phone }}</span>
                            </div>
                            @if ($child->allergies)
                                <div class="flex items-start gap-2 p-2 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                    <svg class="w-4 h-4 text-red-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $child->allergies }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Detail lengkap --}}
                        <div x-show="expanded" x-transition:enter.duration.200ms
                            class="mt-4 pt-4 border-t border-gray-100 dark:border-imumu-dark-border grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-400 text-xs">Tanggal Lahir</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $child->birth_date?->format('d M Y') ?? '—' }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Jenis Kelamin</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $child->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Usia</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    @if ($child->birth_date)
                                        {{ \Carbon\Carbon::parse($child->birth_date)->locale('id')->diffForHumans(['parts' => 2, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                                    @else
                                        —
                                    @endif
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Terdaftar Sejak</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $child->created_at?->format('d M Y') ?? '—' }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Paket</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    {{ optional(optional($child->enrollment)->package)->name ?? '—' }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Status Pembayaran</span>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    @php
                                        $payStatus = optional(optional($child->enrollment)->payment)->status;
                                    @endphp
                                    {{ $payStatus ? $paymentLabels[$payStatus] ?? ucfirst($payStatus) : '—' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="font-semibold">Belum ada anak terdaftar</p>
                </div>
            @endforelse
        </div>

        @if ($children->hasPages())
            <div class="card">
                {{ $children->links() }}
            </div>
        @endif
    </div>
@endsection
