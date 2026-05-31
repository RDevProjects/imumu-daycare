@extends('layouts.front', ['activePage' => 'home'])

@section('title', 'IMUMU Daycare – Penitipan Anak Terpercaya di Surakarta')
@section('description', 'IMUMU Daycare menyediakan penitipan anak yang aman, hangat, dan menyenangkan. Usia 3 bulan – 7 tahun. Senin–Sabtu 08.00–16.00.')

@section('content')

<!-- ===== HERO ===== -->
<section class="relative overflow-hidden" style="background: linear-gradient(135deg, #ffd900 0%, #fff4a8 50%, #fff8e8 100%)">
  <div class="absolute top-0 right-0 w-72 h-72 rounded-full opacity-20 -translate-y-16 translate-x-16" style="background:#09b1ab"></div>
  <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full opacity-20 translate-y-16 -translate-x-16" style="background:#e83f7d"></div>

  <div class="relative mx-auto max-w-7xl px-4 py-14 md:py-20 lg:py-28 md:flex md:items-center md:gap-16">
    <div class="md:w-1/2">
      <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full font-bold text-sm border-2 border-teal-dark rotate-[-1deg]" style="background:white; color:#087c7a">
        🕐 Senin–Sabtu &nbsp;|&nbsp; 08.00–16.00 WIB
      </div>

      <h1 class="font-display font-black text-ink leading-tight" style="font-size: clamp(2.5rem, 5vw, 4rem)">
        Tempat Si Kecil<br/>
        <span style="color:#09b1ab; -webkit-text-stroke: 2px #087c7a">Tumbuh &amp; Bahagia</span> ☀️
      </h1>
      <p class="mt-4 text-lg font-semibold leading-relaxed" style="color:#5c5555; max-width:480px">
        Daycare islami dengan tenaga pengasuh berpengalaman, program stimulasi tumbuh kembang, dan suasana belajar yang menyenangkan untuk anak <strong>usia 3 bulan – 7 tahun</strong>.
      </p>

      <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('daftar') }}" class="btn btn-primary btn-lg">🌟 Daftar Sekarang</a>
        <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">💬 Tanya Bunda Anjani</a>
      </div>

      <div class="mt-8 flex flex-wrap gap-3">
        <span class="badge badge-teal">✓ Tenaga Berpengalaman</span>
        <span class="badge badge-pink">✓ Program Islami</span>
        <span class="badge badge-orange">✓ Makan &amp; Mandi Sore</span>
      </div>
    </div>

    <div class="mt-12 md:mt-0 md:w-1/2 flex justify-center">
      <div class="relative">
        <div class="rounded-card bg-white p-8 w-80" style="box-shadow: 8px 8px 0 #09b1ab, 0 12px 30px rgba(47,43,43,0.12)">
          <div class="text-center">
            <div class="text-6xl mb-3">👶🍼</div>
            <div class="font-display text-2xl font-black text-ink">Usia 3 Bln – 7 Thn</div>
            <div class="mt-2 text-sm font-semibold" style="color:#5c5555">Kami siap menjaga si kecil dengan penuh kasih!</div>
          </div>
          <div class="mt-5 space-y-2.5">
            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#d8f7f5">
              <span class="text-xl">🎒</span>
              <span class="font-semibold text-sm text-ink">Stimulasi Perkembangan</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#ffd6e5">
              <span class="text-xl">🕌</span>
              <span class="font-semibold text-sm text-ink">Hafalan Do'a &amp; Surat</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#ffe0c7">
              <span class="text-xl">🍲</span>
              <span class="font-semibold text-sm text-ink">Makan Siang Bergizi</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#f0d7ff">
              <span class="text-xl">🩺</span>
              <span class="font-semibold text-sm text-ink">Pemeriksaan Kesehatan</span>
            </div>
          </div>
        </div>
        <div class="absolute -top-5 -right-5 flex h-16 w-16 items-center justify-center rounded-full font-display font-black text-xs text-center text-white rotate-12" style="background:#e83f7d; box-shadow: 3px 3px 0 rgba(47,43,43,0.2)">ISLAMI ✨</div>
      </div>
    </div>
  </div>
</section>

<!-- ===== PROGRAM & FASILITAS (2-col teaser) ===== -->
<section class="section-decorated bg-dot-pattern" style="--dot-color: rgba(9,177,171,0.07); --dot-size: 20px; --deco-opacity: 0.12">
  <!-- Floating decorative shapes -->
  <div class="deco-shape deco-circle" style="--deco-color: #e83f7d; --deco-rotate: 15deg; width: 80px; height: 80px; top: 10%; right: 5%;" aria-hidden="true"></div>
  <div class="deco-shape deco-blob animate-deco-float" style="--deco-color: #09b1ab; --deco-rotate: -8deg; --deco-duration: 7s; width: 60px; height: 70px; bottom: 15%; left: 3%;" aria-hidden="true"></div>
  <div class="deco-shape deco-star animate-deco-float" style="--deco-color: #ffd900; --deco-rotate: 20deg; --deco-duration: 5s; --deco-delay: 1s; width: 40px; height: 40px; top: 30%; left: 8%;" aria-hidden="true"></div>

  <div class="relative mx-auto max-w-7xl px-4 py-16 md:py-24 md:px-8">
    <div class="text-center mb-12">
      <h2 class="section-title">Program &amp; Fasilitas</h2>
      <p class="section-subtitle mt-2 max-w-2xl mx-auto">Dirancang oleh tim ahli untuk tumbuh kembang anak yang optimal, fisik maupun spiritual.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
      <div class="rounded-card overflow-hidden border-2" style="border-color:#e83f7d; box-shadow: 6px 6px 0 #ffd6e5">
        <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#e83f7d">🎒 Program Kegiatan</div>
        <div class="p-6 space-y-3" style="background:white">
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Stimulasi Perkembangan</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Hafalan Do'a &amp; Surat Pendek</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Praktek Wudhu &amp; Sholat</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Pemeriksaan Kesehatan Rutin</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Baby Massage</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Read Aloud &amp; Literasi</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Cooking Class</div>
          <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Taman Gizi</div>
        </div>
      </div>

      <div class="rounded-card overflow-hidden border-2" style="border-color:#f36b21; box-shadow: 6px 6px 0 #ffe0c7">
        <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#f36b21">🏠 Fasilitas Unggulan</div>
        <div class="p-6 space-y-3" style="background:white">
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Kasur Busa &amp; Tidur AC</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Tenaga Pengasuh Berpengalaman</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Sarana Bermain Edukatif</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Freezer ASI</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Sterilizer Peralatan Bayi</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Makan Siang Bergizi</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Mandi Sore</div>
          <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Lingkungan Bersih &amp; Aman</div>
        </div>
      </div>
    </div>

    <div class="mt-8 text-center">
      <a href="{{ route('programs') }}" class="btn btn-primary btn-lg">Lihat Detail Lengkap →</a>
    </div>
  </div>
</section>

<!-- Wavy Divider -->
<div class="wavy-divider" aria-hidden="true">
  <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <path d="M0 30C240 60 480 0 720 30C960 60 1200 0 1440 30V60H0V30Z" fill="#fff8e8"/>
    <path d="M0 30C240 60 480 0 720 30C960 60 1200 0 1440 30" stroke="#e83f7d" stroke-opacity="0.15" stroke-width="2"/>
  </svg>
</div>

<!-- ===== HARGA / TARIF ===== -->
<section class="section-decorated px-4 py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(180deg, #fff8e8 0%, #ddf7ff 100%); --deco-opacity: 0.1">
  <!-- Floating decorative shapes -->
  <div class="deco-shape deco-circle animate-deco-float" style="--deco-color: #ffd900; --deco-rotate: 10deg; --deco-duration: 8s; width: 50px; height: 50px; top: 8%; left: 4%;" aria-hidden="true"></div>
  <div class="deco-shape deco-blob" style="--deco-color: #b85bd6; --deco-rotate: -12deg; width: 70px; height: 60px; bottom: 20%; right: 6%;" aria-hidden="true"></div>
  <div class="deco-shape deco-star animate-deco-float" style="--deco-color: #e83f7d; --deco-rotate: 25deg; --deco-duration: 6s; --deco-delay: 2s; width: 35px; height: 35px; top: 45%; right: 10%;" aria-hidden="true"></div>
  <div class="deco-shape deco-diamond animate-deco-float" style="--deco-color: #09b1ab; --deco-rotate: 30deg; --deco-duration: 7s; --deco-delay: 0.5s; width: 24px; height: 24px; bottom: 10%; left: 8%;" aria-hidden="true"></div>

  <div class="relative mx-auto max-w-7xl">
    <div class="text-center mb-12">
      <span class="badge badge-teal mb-3">💰 Harga Terjangkau</span>
      <h2 class="section-title">Tarif Penitipan</h2>
      <p class="section-subtitle mt-2 max-w-xl mx-auto">Harga bersahabat, fasilitas dan program terlengkap.</p>
    </div>

@php
  $tarif = $tarifPendaftaran ?? '250000';
  $paudHarian = $packages->where('name', 'PAUD IMUMU')->where('type', 'harian')->first();
  $paudBulanan = $packages->where('name', 'PAUD IMUMU')->where('type', 'bulanan')->first();
  $nonPaudHarian = $packages->where('name', 'Non-PAUD')->where('type', 'harian')->first();
  $nonPaudBulanan = $packages->where('name', 'Non-PAUD')->where('type', 'bulanan')->first();

  function formatShortPrice($price) {
    $p = (int) $price;
    if ($p >= 1000000) return number_format($p / 1000000, 0, ',', '.') . ' Juta';
    if ($p >= 1000) return number_format($p / 1000, 0, ',', '.');
    return $p;
  }
@endphp

    <div class="grid gap-6 md:grid-cols-3">
      <div class="rounded-card text-center p-8 border-2" style="background:white; border-color:#ffd900; box-shadow: 6px 6px 0 #ffd900">
        <div class="text-5xl mb-3">📋</div>
        <div class="font-display text-xl font-black text-ink">Pendaftaran</div>
        <div class="mt-4 font-display font-black text-ink" style="font-size: 2.5rem; line-height:1">Rp {{ formatShortPrice($tarif) }}<span class="text-xl">.000</span></div>
        <div class="mt-1 text-sm font-semibold" style="color:#5c5555">Biaya satu kali</div>
        <div class="mt-5 space-y-2 text-sm text-left">
          <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>FC KK &amp; KTP Orang Tua</div>
          <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Foto 3×4 (3 lembar)</div>
          <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Formulir Pendaftaran</div>
        </div>
        <a href="{{ route('daftar') }}" class="btn btn-secondary w-full mt-6">Daftar Sekarang</a>
      </div>

      <div class="rounded-card text-center p-8 border-2 relative" style="background:#09b1ab; border-color:#087c7a; box-shadow: 6px 6px 0 #087c7a">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 badge badge-sunshine px-5 py-2 text-sm font-black whitespace-nowrap">⭐ PALING POPULER</div>
        <div class="text-5xl mt-2 mb-3">🎒</div>
        <div class="font-display text-xl font-black text-white">Murid PAUD IMUMU</div>
        <div class="mt-4 border-t border-white/30 pt-4 space-y-3">
          <div>
            <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Harian</div>
            <div class="font-display font-black text-white" style="font-size:2rem">Rp {{ $paudHarian ? formatShortPrice($paudHarian->price) : '35' }}<span class="text-lg">.000</span></div>
          </div>
          <div class="border-t border-white/30 pt-3">
            <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Bulanan</div>
            <div class="font-display font-black text-white" style="font-size:2rem">Rp {{ $paudBulanan ? formatShortPrice($paudBulanan->price) : '500' }}<span class="text-lg">.000</span></div>
          </div>
        </div>
        <a href="{{ route('daftar') }}" class="btn w-full mt-6 font-black" style="background:#ffd900; color:#2f2b2b; box-shadow: 3px 3px 0 rgba(47,43,43,0.25)">Pilih Paket Ini</a>
      </div>

      <div class="rounded-card text-center p-8 border-2" style="background:white; border-color:#b85bd6; box-shadow: 6px 6px 0 #b85bd6">
        <div class="text-5xl mb-3">🧸</div>
        <div class="font-display text-xl font-black text-ink">Murid Non-PAUD</div>
        <div class="mt-4 border-t border-border-default pt-4 space-y-3">
          <div>
            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Harian</div>
            <div class="font-display font-black text-ink" style="font-size:2rem">Rp {{ $nonPaudHarian ? formatShortPrice($nonPaudHarian->price) : '50' }}<span class="text-lg">.000</span></div>
          </div>
          <div class="border-t border-border-default pt-3">
            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Bulanan</div>
            <div class="font-display font-black text-ink" style="font-size:2rem">Rp {{ $nonPaudBulanan ? formatShortPrice($nonPaudBulanan->price) : '1 Juta' }}</div>
          </div>
        </div>
        <a href="{{ route('daftar') }}" class="btn btn-ghost w-full mt-6" style="box-shadow: 3px 3px 0 #b85bd6; border-color:#b85bd6; color:#b85bd6">Pilih Paket Ini</a>
      </div>
    </div>

    <div class="mt-10 rounded-soft p-6 border-2 border-dashed" style="background:#fff4a8; border-color:#ffd900">
      <div class="font-display text-lg font-black text-ink mb-3">📋 Syarat Pendaftaran</div>
      <div class="flex flex-wrap gap-4 text-sm font-semibold text-ink">
        <span class="flex items-center gap-2">📄 Fotokopi KK &amp; KTP Orang Tua</span>
        <span class="flex items-center gap-2">📸 Foto 3×4 sebanyak 3 lembar</span>
        <span class="flex items-center gap-2">📝 Formulir pendaftaran diisi lengkap</span>
      </div>
    </div>
  </div>
</section>

<!-- Wavy Divider -->
<div class="wavy-divider" aria-hidden="true">
  <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <path d="M0 30C180 0 360 60 540 30C720 0 900 60 1080 30C1260 0 1380 45 1440 30V60H0V30Z" fill="#eaf9fc"/>
    <path d="M0 30C180 0 360 60 540 30C720 0 900 60 1080 30C1260 0 1380 45 1440 30" stroke="#09b1ab" stroke-opacity="0.12" stroke-width="2"/>
  </svg>
</div>

<!-- ===== KENAPA PILIH IMUMU ===== -->
<section class="section-decorated bg-dot-pattern px-4 py-16 md:py-24 relative overflow-hidden" style="--dot-color: rgba(232,63,125,0.06); --dot-size: 22px; --deco-opacity: 0.12; background-color: #eaf9fc">
  <!-- Floating decorative shapes -->
  <div class="deco-shape deco-circle" style="--deco-color: #b85bd6; --deco-rotate: -5deg; width: 90px; height: 90px; top: 5%; right: 8%;" aria-hidden="true"></div>
  <div class="deco-shape deco-blob animate-deco-float" style="--deco-color: #f36b21; --deco-rotate: 18deg; --deco-duration: 6s; width: 55px; height: 65px; bottom: 12%; left: 5%;" aria-hidden="true"></div>
  <div class="deco-shape deco-star animate-deco-float" style="--deco-color: #09b1ab; --deco-rotate: -15deg; --deco-duration: 5.5s; --deco-delay: 1.5s; width: 38px; height: 38px; top: 40%; left: 12%;" aria-hidden="true"></div>
  <div class="deco-shape deco-diamond animate-deco-float" style="--deco-color: #ffd900; --deco-rotate: 40deg; --deco-duration: 8s; --deco-delay: 3s; width: 20px; height: 20px; bottom: 25%; right: 15%;" aria-hidden="true"></div>

  <div class="relative mx-auto max-w-7xl">
    <div class="text-center mb-12">
      <h2 class="section-title">Kenapa Pilih IMUMU Daycare?</h2>
      <p class="section-subtitle mt-2">Dipercaya ratusan keluarga di Surakarta.</p>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <div class="card text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3" style="background:#d8f7f5">🕌</div>
        <div class="font-display text-lg font-black text-ink">Bernuansa Islami</div>
        <p class="mt-1 text-sm" style="color:#5c5555">Hafalan do'a, surat, wudhu &amp; sholat terintegrasi</p>
      </div>
      <div class="card text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3" style="background:#ffd6e5">🧸</div>
        <div class="font-display text-lg font-black text-ink">Aman &amp; Nyaman</div>
        <p class="mt-1 text-sm" style="color:#5c5555">AC, kasur busa, sterilizer, dan lingkungan bersih</p>
      </div>
      <div class="card text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3" style="background:#ffe0c7">👩‍🏫</div>
        <div class="font-display text-lg font-black text-ink">Pengasuh Terlatih</div>
        <p class="mt-1 text-sm" style="color:#5c5555">Berpengalaman dalam stimulasi tumbuh kembang anak</p>
      </div>
      <div class="card text-center">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3" style="background:#f0d7ff">🤱</div>
        <div class="font-display text-lg font-black text-ink">Ramah Busui</div>
        <p class="mt-1 text-sm" style="color:#5c5555">Freezer ASI tersedia, mendukung ibu menyusui</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA WHATSAPP ===== -->
<section class="section-decorated px-4 py-16 md:py-24 relative overflow-hidden" style="--deco-opacity: 0.15">
  <!-- Floating decorative shapes -->
  <div class="deco-shape deco-circle animate-deco-float" style="--deco-color: #ffd900; --deco-rotate: 20deg; --deco-duration: 6s; width: 60px; height: 60px; top: 5%; left: 6%;" aria-hidden="true"></div>
  <div class="deco-shape deco-star animate-deco-float" style="--deco-color: #e83f7d; --deco-rotate: -10deg; --deco-duration: 5s; --deco-delay: 1s; width: 45px; height: 45px; top: 15%; right: 8%;" aria-hidden="true"></div>
  <div class="deco-shape deco-blob animate-deco-float" style="--deco-color: #09b1ab; --deco-rotate: 15deg; --deco-duration: 7s; --deco-delay: 2s; width: 50px; height: 60px; bottom: 8%; right: 12%;" aria-hidden="true"></div>
  <div class="deco-shape deco-diamond animate-deco-float" style="--deco-color: #b85bd6; --deco-rotate: 35deg; --deco-duration: 6.5s; --deco-delay: 0.5s; width: 22px; height: 22px; bottom: 18%; left: 10%;" aria-hidden="true"></div>

  <div class="relative mx-auto max-w-3xl rounded-card text-center px-8 py-12 md:px-16" style="background:#09b1ab; box-shadow: 8px 8px 0 #087c7a">
    <div class="text-5xl mb-4">💬</div>
    <h2 class="font-display text-3xl font-black text-white md:text-4xl">Ada Pertanyaan?</h2>
    <p class="mt-2 text-lg font-semibold" style="color:rgba(255,255,255,0.85)">
      Hubungi langsung <strong class="text-white">Bunda Anjani</strong> via WhatsApp. Kami siap membantu!
    </p>
    <div class="mt-6 flex flex-wrap justify-center gap-4">
      <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">💬 0858-7774-8008</a>
      <a href="{{ route('contact') }}" class="btn btn-ghost btn-lg" style="color:white; box-shadow: inset 0 0 0 2px white, 4px 4px 0 rgba(47,43,43,0.2)">Isi Formulir Daftar</a>
    </div>
  </div>
</section>

@endsection
