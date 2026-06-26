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
    <div class="space-y-6" x-data="{ showAddModal: false, editModal: false, editChild: {} }">

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
                    $packageType = $child->enrollment?->package?->type ?? '';
                @endphp
                <div x-data="{ expanded: false }"
                    class="bg-white dark:bg-imumu-dark-card rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 dark:border-imumu-dark-border">

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
                                        @php
                                            $bday = \Carbon\Carbon::parse($child->birth_date);
                                            $ageY = (int) $bday->diffInYears(\Carbon\Carbon::now());
                                            $ageM = (int) $bday->copy()->addYears($ageY)->diffInMonths(\Carbon\Carbon::now());
                                        @endphp
                                        <p class="text-xs text-gray-400">{{ $ageY }} tahun {{ $ageM }} bulan</p>
                                    @endif
                                </div>
                            </div>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-bold {{ $status['bg'] }} {{ $status['text'] }}">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="space-y-2 pt-3 border-t border-gray-100 dark:border-imumu-dark-border">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $child->parent_name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $child->parent_phone }}</span>
                            </div>
                            @if ($child->enrollment?->package)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $child->enrollment->package->name }} • {{ ucfirst($child->enrollment->package->type) }}
                                    </span>
                                </div>
                            @endif
                            @if ($child->allergies)
                                <div class="flex items-start gap-2 p-2 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                    <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $child->allergies }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-imumu-dark-border flex gap-2">
                            <button @click="editModal = true; editChild = {{ json_encode([
                                'id' => $child->id,
                                'name' => $child->name,
                                'birth_date' => $child->birth_date?->format('Y-m-d') ?? '',
                                'gender' => $child->gender,
                                'parent_name' => $child->parent_name,
                                'parent_phone' => $child->parent_phone,
                                'allergies' => $child->allergies ?? '',
                                'status' => $child->status,
                                'package_id' => $child->enrollment?->package_id ?? '',
                            ]) }}"
                                class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg hover:bg-blue-100 transition-colors cursor-pointer">
                                ✏️ Edit
                            </button>
                            @if ($child->status === 'aktif')
                                <a href="{{ route('dashboard.pembayaran.child', $child) }}"
                                    class="flex-1 px-3 py-2 bg-teal-50 text-teal-600 text-xs font-bold rounded-lg hover:bg-teal-100 transition-colors text-center no-underline">
                                    💰 Bayar
                                </a>
                            @endif
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

        {{-- Edit Modal --}}
        <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" @click.self="editModal = false">
            <div class="bg-white dark:bg-imumu-dark-card rounded-2xl shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text">✏️ Edit Data Anak</h3>
                        <button @click="editModal = false" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                    </div>

                    <form :action="'{{ route('dashboard.profile-anak.update', ['child' => '_CHILD_ID_']) }}'.replace('_CHILD_ID_', editChild.id)" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Anak</label>
                                <input type="text" name="name" x-model="editChild.name" required class="input-field w-full">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" x-model="editChild.birth_date" class="input-field w-full">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                                    <select name="gender" x-model="editChild.gender" required class="input-field w-full">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Orang Tua</label>
                                <input type="text" name="parent_name" x-model="editChild.parent_name" required class="input-field w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">No HP Orang Tua</label>
                                <input type="tel" name="parent_phone" x-model="editChild.parent_phone" required class="input-field w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Alergi <span class="text-gray-400 font-normal">(opsional)</span></label>
                                <textarea name="allergies" x-model="editChild.allergies" rows="2" class="input-field w-full resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Paket</label>
                                <select name="package_id" x-model="editChild.package_id" class="input-field w-full">
                                    <option value="">— Pilih Paket —</option>
                                    @foreach ($packages as $pkg)
                                        <option value="{{ $pkg->id }}">{{ $pkg->name }} - {{ ucfirst($pkg->type) }} ({{ $pkg->formatted_price }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" x-model="editChild.status" required class="input-field w-full">
                                    <option value="aktif">Aktif</option>
                                    <option value="cuti">Cuti</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="pindah">Pindah</option>
                                    <option value="lulus">Lulus</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-6">
                            <button type="button" @click="editModal = false" class="btn-secondary flex-1 text-sm py-2">Batal</button>
                            <button type="submit" class="btn-primary flex-1 text-sm py-2">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
