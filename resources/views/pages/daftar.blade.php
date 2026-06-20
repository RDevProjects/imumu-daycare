@extends('layouts.front', ['activePage' => 'daftar'])

@section('title', 'Pendaftaran - IMUMU Daycare Surakarta')
@section('description', 'Daftarkan anak Anda di IMUMU Daycare. Isi formulir pendaftaran online.')

@section('content')

    <!-- Page Hero -->
    <section class="px-4 py-12 md:py-16 relative overflow-hidden"
        style="background: linear-gradient(135deg, #e0f7fa 0%, #fff9c4 100%)">
        <div class="absolute top-0 left-0 w-64 h-64 rounded-full opacity-5 -translate-y-12 -translate-x-12"
            style="background:#e83f7d"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 rounded-full opacity-5 translate-y-10 translate-x-10"
            style="background:#b85bd6"></div>

        <div class="relative mx-auto max-w-3xl text-center">
            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-teal-100 text-teal-800 mb-4">📝 Formulir
                Pendaftaran</span>
            <h1 class="font-display font-black text-ink drop-shadow-md"
                style="font-size: clamp(2rem, 5vw, 3rem); line-height:1.2">
                Daftarkan Si Kecil 🌟
            </h1>
            <p class="section-subtitle mt-4 max-w-2xl mx-auto">
                Isi formulir di bawah ini. Kami akan menghubungi Anda via WhatsApp untuk konfirmasi.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 md:py-16">
        <div class="grid gap-12 lg:grid-cols-5 lg:gap-14">

            <!-- Form (3/5) -->
            <div class="lg:col-span-3">
                <div class="rounded-xl p-8 border border-teal-200 bg-white shadow-lg">
                    <h2 class="font-display text-2xl font-black text-ink mb-6 border-b border-teal-200 pb-2">
                        <span class="inline-block w-1 h-5 bg-teal-500 mr-2 align-middle rounded-full"></span>📝 Data
                        Pendaftaran
                    </h2>
                    <form action="{{ route('daftar.store') }}" method="POST" class="space-y-5" novalidate>
                        @csrf

                        {{-- Data Orang Tua --}}
                        <div>
                            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-teal text-white flex items-center justify-center text-sm font-bold">1</span>
                                Data Orang Tua / Wali
                            </h3>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="parent_name" class="block text-sm font-black text-ink mb-1.5">Nama Lengkap
                                        <span class="text-pink">*</span></label>
                                    <input type="text" id="parent_name" name="parent_name"
                                        value="{{ old('parent_name') }}"
                                        class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70 @error('parent_name') border-red-500 @enderror"
                                        placeholder="Nama lengkap Ayah/Bunda" required aria-required="true">
                                    @error('parent_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="parent_phone" class="block text-sm font-black text-ink mb-1.5">No HP /
                                        WhatsApp <span class="text-pink">*</span></label>
                                    <input type="tel" id="parent_phone" name="parent_phone"
                                        value="{{ old('parent_phone') }}"
                                        class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70 @error('parent_phone') border-red-500 @enderror"
                                        placeholder="08xx-xxxx-xxxx" required aria-required="true">
                                    @error('parent_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5">
                                <label for="parent_email" class="block text-sm font-black text-ink mb-1.5">Email <span
                                        class="text-gray-400 font-normal">(opsional)</span></label>
                                <input type="email" id="parent_email" name="parent_email"
                                    value="{{ old('parent_email') }}"
                                    class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70"
                                    placeholder="email@contoh.com">
                            </div>
                        </div>

                        {{-- Data Anak --}}
                        <div>
                            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-pink text-white flex items-center justify-center text-sm font-bold">2</span>
                                Data Anak
                            </h3>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="child_name" class="block text-sm font-black text-ink mb-1.5">Nama Anak <span
                                            class="text-pink">*</span></label>
                                    <input type="text" id="child_name" name="child_name" value="{{ old('child_name') }}"
                                        class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70 @error('child_name') border-red-500 @enderror"
                                        placeholder="Nama lengkap anak" required aria-required="true">
                                    @error('child_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div x-data="{
                                    birthDate: '{{ old('child_birth_date') }}',
                                    get agePreview() {
                                        if (!this.birthDate) return '';
                                        const b = new Date(this.birthDate), t = new Date();
                                        let y = t.getFullYear() - b.getFullYear(), m = t.getMonth() - b.getMonth();
                                        if (m < 0) { y--; m += 12; }
                                        return 'Usia: ' + y + ' tahun ' + m + ' bulan';
                                    }
                                }">
                                    <label for="child_birth_date" class="block text-sm font-black text-ink mb-1.5">Tanggal Lahir Anak <span
                                            class="text-pink">*</span></label>
                                    <input type="date" id="child_birth_date" name="child_birth_date"
                                        value="{{ old('child_birth_date') }}" x-model="birthDate"
                                        class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 @error('child_birth_date') border-red-500 @enderror"
                                        required aria-required="true" max="{{ date('Y-m-d') }}">
                                    <p x-show="birthDate" class="text-sm text-teal-600 mt-1 font-semibold" x-text="agePreview"></p>
                                    @error('child_birth_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-sm font-black text-ink mb-1.5">Jenis Kelamin <span
                                        class="text-gray-400 font-normal">(opsional)</span></label>
                                <div class="flex gap-4">
                                    <label
                                        class="flex items-center gap-2 cursor-pointer p-3 rounded-lg border border-gray-200 hover:border-teal-400 transition-all {{ old('child_gender') === 'L' ? 'bg-teal-50 border-teal-500' : '' }}">
                                        <input type="radio" name="child_gender" value="L"
                                            {{ old('child_gender') === 'L' ? 'checked' : '' }} class="w-4 h-4 text-teal">
                                        <span class="font-semibold text-ink">Laki-laki</span>
                                    </label>
                                    <label
                                        class="flex items-center gap-2 cursor-pointer p-3 rounded-lg border border-gray-200 hover:border-teal-400 transition-all {{ old('child_gender') === 'P' ? 'bg-teal-50 border-teal-500' : '' }}">
                                        <input type="radio" name="child_gender" value="P"
                                            {{ old('child_gender') === 'P' ? 'checked' : '' }} class="w-4 h-4 text-teal">
                                        <span class="font-semibold text-ink">Perempuan</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Paket & Pembayaran --}}
                        <div>
                            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-yellow text-ink flex items-center justify-center text-sm font-bold">3</span>
                                Paket & Pembayaran
                            </h3>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="package_id" class="block text-sm font-black text-ink mb-1.5">Pilih Paket
                                        <span class="text-pink">*</span></label>
                                    <select id="package_id" name="package_id"
                                        class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 @error('package_id') border-red-500 @enderror"
                                        required>
                                        <option value="">Pilih paket…</option>
                                        @foreach ($packages as $pkg)
                                            <option value="{{ $pkg->id }}" data-price="{{ $pkg->price }}"
                                                {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                                                {{ $pkg->name }} - {{ ucfirst($pkg->type) }}
                                                ({{ $pkg->formatted_price }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('package_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-black text-ink mb-1.5">Metode Pembayaran <span
                                            class="text-pink">*</span></label>
                                    <div class="flex gap-4 mt-2">
                                        <label
                                            class="flex items-center gap-2 cursor-pointer p-3 rounded-lg border border-gray-200 hover:border-teal-400 transition-all {{ old('payment_method') === 'cash' ? 'border-teal-500 bg-teal-50' : '' }}">
                                            <input type="radio" name="payment_method" value="cash"
                                                {{ old('payment_method') === 'cash' ? 'checked' : '' }}
                                                class="w-4 h-4 text-teal" onchange="updatePaymentStyle(this)">
                                            <span class="font-semibold text-ink">💵 Cash</span>
                                        </label>
                                        <label
                                            class="flex items-center gap-2 cursor-pointer p-3 rounded-lg border border-gray-200 hover:border-teal-400 transition-all {{ old('payment_method') === 'transfer' ? 'border-teal-500 bg-teal-50' : '' }}">
                                            <input type="radio" name="payment_method" value="transfer"
                                                {{ old('payment_method') === 'transfer' ? 'checked' : '' }}
                                                class="w-4 h-4 text-teal" onchange="updatePaymentStyle(this)">
                                            <span class="font-semibold text-ink">🏦 Transfer</span>
                                        </label>
                                    </div>
                                    @error('payment_method')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Alamat & Catatan --}}
                        <div>
                            <label for="address" class="block text-sm font-black text-ink mb-1.5">Alamat Rumah <span
                                    class="text-gray-400 font-normal">(opsional)</span></label>
                            <textarea id="address" name="address" rows="2"
                                class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70 resize-none h-24"
                                placeholder="Jalan, kelurahan, kecamatan…">{{ old('address') }}</textarea>
                        </div>
                        <div>
                            <label for="notes" class="block text-sm font-black text-ink mb-1.5">Catatan / Pertanyaan
                                <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full rounded-md border border-gray-300 focus:border-teal-500 focus:ring-1 focus:ring-teal-200 px-3 py-2 placeholder-opacity-70 resize-none h-32"
                                placeholder="Ada yang ingin ditanyakan?">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-md transition-colors shadow-md">🌟
                            Kirim Pendaftaran</button>
                        <p class="text-xs text-center font-semibold" style="color:#5c5555">Atau hubungi langsung via <a
                                href="https://wa.me/{{ \App\Models\Setting::get('daycare_wa', '') }}"
                                class="text-teal font-black no-underline hover:underline">WhatsApp
                                {{ \App\Models\Setting::get('daycare_wa', '') ? '0' . substr(\App\Models\Setting::get('daycare_wa', ''), 2) : '' }}</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Info (2/5) -->
            <div class="lg:col-span-2 mt-8 lg:mt-0 space-y-6">
                <div class="p-6 rounded-xl bg-white border border-yellow-200 shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-yellow-100 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="w-6 h-6">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </span>
                        <h3 class="font-display text-lg font-black text-ink">Jam Operasional</h3>
                    </div>
                    <div class="space-y-3 text-sm font-semibold">
                        <div class="flex justify-between items-center p-3 rounded-lg bg-teal-50 border border-teal-100">
                            <span class="text-ink">Senin – Sabtu</span><span class="font-black text-teal-600">08.00 –
                                16.00</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg bg-pink-50 border border-pink-100">
                            <span class="text-ink">Minggu &amp; Merah</span><span
                                class="font-black text-pink-600">TUTUP</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-xl border border-yellow-300 bg-yellow-50 shadow-sm">
                    <h3 class="font-display text-base font-black text-ink mb-3 flex items-center gap-2">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-200 text-yellow-700">📋</span>
                        Siapkan Dokumen
                    </h3>
                    <ul class="space-y-2 text-sm font-semibold text-ink">
                        <li class="flex items-start gap-2">
                            <span
                                class="mt-0.5 flex-shrink-0 inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-100 text-teal-700 text-xs font-bold">✓</span>
                            <span>FC KK & KTP Orang Tua</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span
                                class="mt-0.5 flex-shrink-0 inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-100 text-teal-700 text-xs font-bold">✓</span>
                            <span>Foto 3×4 sebanyak 3 lembar</span>
                        </li>
                    </ul>
                    <p class="text-xs mt-4 font-medium text-gray-500 leading-relaxed">Dokumen dibawa saat datang ke IMUMU
                        Daycare setelah pendaftaran dikonfirmasi.</p>
                </div>
            </div>

        </div>
    </section>

    <script>
        function updatePaymentStyle(radio) {
            document.querySelectorAll('[name="payment_method"]').forEach(r => {
                const label = r.closest('label');
                if (r.checked) {
                    label.classList.add('border-teal-500', 'bg-teal-50');
                    label.classList.remove('border-gray-200');
                } else {
                    label.classList.remove('border-teal-500', 'bg-teal-50');
                    label.classList.add('border-gray-200');
                }
            });
        }
    </script>

@endsection
