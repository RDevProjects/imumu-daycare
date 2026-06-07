@extends('layouts.front', ['activePage' => 'daftar'])

@section('title', 'Pendaftaran - IMUMU Daycare Surakarta')
@section('description', 'Daftarkan anak Anda di IMUMU Daycare. Isi formulir pendaftaran online.')

@section('content')

<!-- Page Hero -->
<section class="px-4 py-12 md:py-16 relative overflow-hidden" style="background: linear-gradient(135deg, #d8f7f5 0%, #fff8e8 50%, #fff4a8 100%)">
  <div class="absolute top-0 left-0 w-64 h-64 rounded-full opacity-15 -translate-y-12 -translate-x-12" style="background:#e83f7d"></div>
  <div class="absolute bottom-0 right-0 w-48 h-48 rounded-full opacity-12 translate-y-10 translate-x-10" style="background:#b85bd6"></div>

  <div class="relative mx-auto max-w-3xl text-center">
    <span class="badge badge-teal mb-4">📝 Formulir Pendaftaran</span>
    <h1 class="font-display font-black text-ink" style="font-size: clamp(2rem, 5vw, 3rem); line-height:1.1">
      Daftarkan Si Kecil 🌟
    </h1>
    <p class="section-subtitle mt-4 max-w-2xl mx-auto">
      Isi formulir di bawah ini. Kami akan menghubungi Anda via WhatsApp untuk konfirmasi.
    </p>
  </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-12 md:py-16">
  <div class="grid gap-10 lg:grid-cols-5 lg:gap-14">

    <!-- Form (3/5) -->
    <div class="lg:col-span-3">
      <div class="rounded-card p-8 border-2" style="background:white; border-color:#09b1ab; box-shadow: 6px 6px 0 #d8f7f5">
        <h2 class="font-display text-2xl font-black text-ink mb-6">📝 Data Pendaftaran</h2>
        <form action="{{ route('daftar.store') }}" method="POST" class="space-y-5" novalidate>
          @csrf

          {{-- Data Orang Tua --}}
          <div>
            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
              <span class="w-8 h-8 rounded-full bg-teal text-white flex items-center justify-center text-sm font-bold">1</span>
              Data Orang Tua / Wali
            </h3>
            <div class="grid gap-5 sm:grid-cols-2">
              <div>
                <label for="parent_name" class="block text-sm font-black text-ink mb-1.5">Nama Lengkap <span class="text-pink">*</span></label>
                <input type="text" id="parent_name" name="parent_name" value="{{ old('parent_name') }}" class="input-field @error('parent_name') border-red-500 @enderror" placeholder="Nama lengkap Ayah/Bunda" required>
                @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
              <div>
                <label for="parent_phone" class="block text-sm font-black text-ink mb-1.5">No HP / WhatsApp <span class="text-pink">*</span></label>
                <input type="tel" id="parent_phone" name="parent_phone" value="{{ old('parent_phone') }}" class="input-field @error('parent_phone') border-red-500 @enderror" placeholder="08xx-xxxx-xxxx" required>
                @error('parent_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>
            <div class="mt-5">
              <label for="parent_email" class="block text-sm font-black text-ink mb-1.5">Email <span class="text-gray-400 font-normal">(opsional)</span></label>
              <input type="email" id="parent_email" name="parent_email" value="{{ old('parent_email') }}" class="input-field" placeholder="email@contoh.com">
            </div>
          </div>

          {{-- Data Anak --}}
          <div>
            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
              <span class="w-8 h-8 rounded-full bg-pink text-white flex items-center justify-center text-sm font-bold">2</span>
              Data Anak
            </h3>
            <div class="grid gap-5 sm:grid-cols-2">
              <div>
                <label for="child_name" class="block text-sm font-black text-ink mb-1.5">Nama Anak <span class="text-pink">*</span></label>
                <input type="text" id="child_name" name="child_name" value="{{ old('child_name') }}" class="input-field @error('child_name') border-red-500 @enderror" placeholder="Nama lengkap anak" required>
                @error('child_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
              <div>
                <label for="child_age" class="block text-sm font-black text-ink mb-1.5">Usia Anak <span class="text-pink">*</span></label>
                <input type="text" id="child_age" name="child_age" value="{{ old('child_age') }}" class="input-field @error('child_age') border-red-500 @enderror" placeholder="Contoh: 2 tahun 3 bulan" required>
                @error('child_age') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>
            <div class="mt-5">
              <label class="block text-sm font-black text-ink mb-1.5">Jenis Kelamin <span class="text-gray-400 font-normal">(opsional)</span></label>
              <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="child_gender" value="L" {{ old('child_gender') === 'L' ? 'checked' : '' }} class="w-4 h-4 text-teal">
                  <span class="font-semibold text-ink">Laki-laki</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="child_gender" value="P" {{ old('child_gender') === 'P' ? 'checked' : '' }} class="w-4 h-4 text-teal">
                  <span class="font-semibold text-ink">Perempuan</span>
                </label>
              </div>
            </div>
          </div>

          {{-- Paket & Pembayaran --}}
          <div>
            <h3 class="font-display text-lg font-bold text-ink mb-4 flex items-center gap-2">
              <span class="w-8 h-8 rounded-full bg-yellow text-ink flex items-center justify-center text-sm font-bold">3</span>
              Paket & Pembayaran
            </h3>
            <div class="grid gap-5 sm:grid-cols-2">
              <div>
                <label for="package_id" class="block text-sm font-black text-ink mb-1.5">Pilih Paket <span class="text-pink">*</span></label>
                <select id="package_id" name="package_id" class="input-field @error('package_id') border-red-500 @enderror" required>
                  <option value="">Pilih paket…</option>
                  @foreach($packages as $pkg)
                    <option value="{{ $pkg->id }}" data-price="{{ $pkg->price }}" {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                      {{ $pkg->name }} - {{ ucfirst($pkg->type) }} ({{ $pkg->formatted_price }})
                    </option>
                  @endforeach
                </select>
                @error('package_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
              <div>
                <label class="block text-sm font-black text-ink mb-1.5">Metode Pembayaran <span class="text-pink">*</span></label>
                <div class="flex gap-4 mt-2">
                  <label class="flex items-center gap-2 cursor-pointer p-3 rounded-xl border-2 transition-all {{ old('payment_method') === 'cash' ? 'border-teal bg-teal/10' : 'border-gray-200' }}">
                    <input type="radio" name="payment_method" value="cash" {{ old('payment_method') === 'cash' ? 'checked' : '' }} class="w-4 h-4 text-teal" onchange="updatePaymentStyle(this)">
                    <span class="font-semibold text-ink">💵 Cash</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer p-3 rounded-xl border-2 transition-all {{ old('payment_method') === 'transfer' ? 'border-teal bg-teal/10' : 'border-gray-200' }}">
                    <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }} class="w-4 h-4 text-teal" onchange="updatePaymentStyle(this)">
                    <span class="font-semibold text-ink">🏦 Transfer</span>
                  </label>
                </div>
                @error('payment_method') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- Alamat & Catatan --}}
          <div>
            <label for="address" class="block text-sm font-black text-ink mb-1.5">Alamat Rumah <span class="text-gray-400 font-normal">(opsional)</span></label>
            <textarea id="address" name="address" rows="2" class="input-field resize-none" placeholder="Jalan, kelurahan, kecamatan…">{{ old('address') }}</textarea>
          </div>
          <div>
            <label for="notes" class="block text-sm font-black text-ink mb-1.5">Catatan / Pertanyaan <span class="text-gray-400 font-normal">(opsional)</span></label>
            <textarea id="notes" name="notes" rows="3" class="input-field resize-none" placeholder="Ada yang ingin ditanyakan?">{{ old('notes') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary w-full btn-lg font-black">🌟 Kirim Pendaftaran</button>
          <p class="text-xs text-center font-semibold" style="color:#5c5555">Atau hubungi langsung via <a href="https://wa.me/{{ \App\Models\Setting::get('daycare_wa', '') }}" class="text-teal font-black no-underline hover:underline">WhatsApp {{ \App\Models\Setting::get('daycare_wa', '') ? '0' . substr(\App\Models\Setting::get('daycare_wa', ''), 2) : '' }}</a></p>
        </form>
      </div>
    </div>

    <!-- Info (2/5) -->
    <div class="lg:col-span-2 space-y-5">
      <div class="card" style="border-color:#ffd900; background: linear-gradient(135deg, white 60%, #fff4a8 100%); box-shadow: 5px 5px 0 #ffd900">
        <div class="flex items-center gap-3 mb-3"><span class="text-3xl">🕐</span><h3 class="font-display text-lg font-black text-ink">Jam Operasional</h3></div>
        <div class="space-y-2 text-sm font-semibold">
          <div class="flex justify-between items-center p-2.5 rounded-soft" style="background:#d8f7f5">
            <span class="text-ink">Senin – Sabtu</span><span class="font-black" style="color:#09b1ab">08.00 – 16.00</span>
          </div>
          <div class="flex justify-between items-center p-2.5 rounded-soft" style="background:#ffd6e5">
            <span class="text-ink">Minggu &amp; Merah</span><span class="font-black" style="color:#e83f7d">TUTUP</span>
          </div>
        </div>
      </div>

      <div class="rounded-soft p-5 border-2 border-dashed" style="background:#fff4a8; border-color:#ffd900">
        <div class="font-display text-base font-black text-ink mb-2">📋 Siapkan Dokumen</div>
        <ul class="space-y-1.5 text-sm font-semibold text-ink">
          <li class="flex items-center gap-2"><span style="color:#09b1ab">✓</span>FC KK & KTP Orang Tua</li>
          <li class="flex items-center gap-2"><span style="color:#09b1ab">✓</span>Foto 3×4 sebanyak 3 lembar</li>
        </ul>
        <p class="text-xs mt-3 font-semibold" style="color:#5c5555">Dokumen dibawa saat datang ke IMUMU Daycare setelah pendaftaran dikonfirmasi.</p>
      </div>
    </div>

  </div>
</section>

<script>
function updatePaymentStyle(radio) {
  document.querySelectorAll('[name="payment_method"]').forEach(r => {
    const label = r.closest('label');
    if (r.checked) {
      label.classList.add('border-teal', 'bg-teal/10');
      label.classList.remove('border-gray-200');
    } else {
      label.classList.remove('border-teal', 'bg-teal/10');
      label.classList.add('border-gray-200');
    }
  });
}
</script>

@endsection
