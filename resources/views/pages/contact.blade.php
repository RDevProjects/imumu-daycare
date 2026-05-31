@extends('layouts.front', ['activePage' => 'contact'])

@section('title', 'Daftar & Kontak – IMUMU Daycare Surakarta')
@section('description', 'Daftar anak Anda di IMUMU Daycare. Hubungi Bunda Anjani di 0858-7774-8008 atau kunjungi kami di Jl. Bone 3, Banyuanyar, Banjarsari, Surakarta.')

@section('content')

<!-- Page Hero -->
<section class="px-4 py-16 md:py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #d8f7f5 0%, #fff8e8 50%, #fff4a8 100%)">
  <div class="absolute top-0 left-0 w-64 h-64 rounded-full opacity-15 -translate-y-12 -translate-x-12" style="background:#e83f7d"></div>
  <div class="relative mx-auto max-w-3xl text-center">
    <span class="badge badge-teal mb-4">✍️ Pendaftaran Mudah</span>
    <h1 class="font-display font-black text-ink" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height:1.1">
      Daftarkan Si Kecil<br/>Sekarang! 🌟
    </h1>
    <p class="section-subtitle mt-4 max-w-2xl mx-auto">
      Isi formulir di bawah ini atau langsung hubungi <strong>Bunda Anjani</strong> via WhatsApp. Kami akan segera merespons!
    </p>
    <div class="mt-5">
      <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">
        💬 Chat Langsung – 0858-7774-8008
      </a>
    </div>
  </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 md:py-20 md:px-8">
  <div class="grid gap-10 lg:grid-cols-5 lg:gap-14">

    <!-- Form (3/5) -->
    <div class="lg:col-span-3">
      <div class="rounded-card p-8 border-2" style="background:white; border-color:#09b1ab; box-shadow: 6px 6px 0 #d8f7f5">
        <h2 class="font-display text-2xl font-black text-ink mb-6">📝 Formulir Pendaftaran</h2>
        <form action="#" method="POST" class="space-y-5" novalidate>
          <div class="grid gap-5 sm:grid-cols-2">
            <div>
              <label for="nama_ortu" class="block text-sm font-black text-ink mb-1.5">Nama Orang Tua / Wali <span class="text-pink">*</span></label>
              <input type="text" id="nama_ortu" name="nama_ortu" class="input-field" placeholder="Nama lengkap Ayah/Bunda" required aria-required="true" />
            </div>
            <div>
              <label for="hp" class="block text-sm font-black text-ink mb-1.5">Nomor HP / WhatsApp <span class="text-pink">*</span></label>
              <input type="tel" id="hp" name="hp" class="input-field" placeholder="08xx-xxxx-xxxx" required aria-required="true" />
            </div>
          </div>
          <div class="grid gap-5 sm:grid-cols-2">
            <div>
              <label for="nama_anak" class="block text-sm font-black text-ink mb-1.5">Nama Anak <span class="text-pink">*</span></label>
              <input type="text" id="nama_anak" name="nama_anak" class="input-field" placeholder="Nama lengkap anak" required aria-required="true" />
            </div>
            <div>
              <label for="usia" class="block text-sm font-black text-ink mb-1.5">Usia Anak <span class="text-pink">*</span></label>
              <input type="text" id="usia" name="usia" class="input-field" placeholder="Contoh: 2 tahun 3 bulan" required aria-required="true" />
            </div>
          </div>
          <div>
            <label for="paket" class="block text-sm font-black text-ink mb-1.5">Pilih Paket <span class="text-pink">*</span></label>
            <select id="paket" name="paket" class="input-field" required aria-required="true">
              <option value="">Pilih paket penitipan…</option>
              <option value="paud-harian">PAUD IMUMU – Harian (Rp 35.000)</option>
              <option value="paud-bulanan">PAUD IMUMU – Bulanan (Rp 500.000)</option>
              <option value="nonpaud-harian">Non-PAUD – Harian (Rp 50.000)</option>
              <option value="nonpaud-bulanan">Non-PAUD – Bulanan (Rp 1.000.000)</option>
              <option value="tanya">Belum yakin, mau tanya dulu</option>
            </select>
          </div>
          <div>
            <label for="alamat" class="block text-sm font-black text-ink mb-1.5">Alamat Rumah</label>
            <textarea id="alamat" name="alamat" rows="2" class="input-field" placeholder="Jalan, kelurahan, kecamatan…"></textarea>
          </div>
          <div>
            <label for="pesan" class="block text-sm font-black text-ink mb-1.5">Pesan / Pertanyaan</label>
            <textarea id="pesan" name="pesan" rows="3" class="input-field" placeholder="Ada yang ingin ditanyakan? Kami siap membantu."></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-full btn-lg font-black">🌟 Kirim Pendaftaran</button>
          <p class="text-xs text-center font-semibold" style="color:#5c5555">Atau hubungi langsung via <a href="https://wa.me/6285877748008" class="text-teal font-black no-underline hover:underline">WhatsApp 0858-7774-8008</a></p>
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

      <div class="card" style="border-color:#09b1ab; background: linear-gradient(135deg, white 60%, #d8f7f5 100%); box-shadow: 5px 5px 0 #09b1ab">
        <div class="flex items-center gap-3 mb-3"><span class="text-3xl">📱</span><h3 class="font-display text-lg font-black text-ink">Hubungi Kami</h3></div>
        <div class="space-y-3 text-sm">
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-soft no-underline transition-all hover:-translate-y-0.5" style="background:#18a058; color:white">
            <span class="text-xl">💬</span>
            <div><div class="font-black">WhatsApp</div><div class="text-xs opacity-80">0858-7774-8008 (Bunda Anjani)</div></div>
          </a>
          <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-soft no-underline transition-all hover:-translate-y-0.5" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">
            <span class="text-xl">📸</span>
            <div><div class="font-black">Instagram</div><div class="text-xs opacity-80">@imumu_daycare</div></div>
          </a>
        </div>
      </div>

      <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 60%, #ffe0c7 100%); box-shadow: 5px 5px 0 #f36b21">
        <div class="flex items-center gap-3 mb-3"><span class="text-3xl">📍</span><h3 class="font-display text-lg font-black text-ink">Lokasi</h3></div>
        <p class="text-sm font-semibold leading-relaxed" style="color:#5c5555">Jl. Bone 3 RT 01 RW 03<br/>Banyuanyar, Banjarsari<br/>Surakarta, Jawa Tengah</p>
        <a href="https://maps.google.com?q=Jl+Bone+3+RT01+RW03+Banyuanyar+Banjarsari+Surakarta" target="_blank" rel="noopener" class="btn btn-ghost btn-sm mt-4 w-full" style="border-color:#f36b21; color:#f36b21; box-shadow: 2px 2px 0 #ffe0c7">Lihat di Google Maps →</a>
      </div>

      <div class="rounded-soft p-5 border-2 border-dashed" style="background:#fff4a8; border-color:#ffd900">
        <div class="font-display text-base font-black text-ink mb-2">📋 Siapkan Dokumen</div>
        <ul class="space-y-1.5 text-sm font-semibold text-ink">
          <li class="flex items-center gap-2"><span style="color:#09b1ab">✓</span>FC KK &amp; KTP Orang Tua</li>
          <li class="flex items-center gap-2"><span style="color:#09b1ab">✓</span>Foto 3×4 sebanyak 3 lembar</li>
          <li class="flex items-center gap-2"><span style="color:#09b1ab">✓</span>Formulir pendaftaran (kami siapkan)</li>
        </ul>
      </div>
    </div>

  </div>
</section>

@endsection
