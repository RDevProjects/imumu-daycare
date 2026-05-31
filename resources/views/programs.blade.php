<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Program &amp; Fasilitas – IMUMU Daycare Surakarta</title>
  <meta name="description" content="Program kegiatan dan fasilitas IMUMU Daycare: stimulasi perkembangan, hafalan do'a, baby massage, cooking class, freezer ASI, dan lebih banyak lagi." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color:#fff8e8">

  <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 btn btn-primary btn-sm">Lewati ke konten utama</a>

  <header class="sticky top-0 z-40 bg-white/98 backdrop-blur-sm" style="box-shadow: 0 4px 0 #ffd900, 0 6px 20px rgba(47,43,43,0.08)">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-8" aria-label="Navigasi utama">
      <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline" aria-label="IMUMU Daycare beranda">
        <div class="flex h-12 w-12 items-center justify-center rounded-full font-display text-xl font-black text-ink" style="background-color:#ffd900; box-shadow: 3px 3px 0 rgba(47,43,43,0.2)">☀️</div>
        <div>
          <div class="font-display text-xl font-black text-ink leading-none">IMUMU</div>
          <div class="text-xs font-semibold" style="color:#09b1ab">DAYCARE</div>
        </div>
      </a>
      <ul class="hidden md:flex items-center gap-2" role="list">
        <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
        <li><a href="{{ route('programs') }}" class="nav-link active">Program &amp; Fasilitas</a></li>
        <li><a href="{{ route('contact') }}" class="nav-link">Daftar Sekarang</a></li>
        @auth
          <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
        @else
          <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
        @endauth
      </ul>
      <div class="hidden md:flex items-center gap-3">
        @auth
          <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Dashboard</a>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm" style="border-color:#e83f7d; color:#e83f7d; box-shadow: 3px 3px 0 rgba(232,63,125,0.2)">Logout</button>
          </form>
        @else
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">💬 WhatsApp</a>
          <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">Daftar Anak</a>
        @endauth
      </div>
      <button id="mobile-menu-btn" class="flex md:hidden items-center justify-center w-11 h-11 rounded-full font-bold text-white" style="background-color:#09b1ab" aria-label="Buka menu" aria-expanded="false">
        <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
        <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t-2 border-border-default px-4 py-4 space-y-2">
      <a href="{{ route('home') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Beranda</a>
      <a href="{{ route('programs') }}" class="block px-4 py-3 rounded-soft font-semibold text-teal" style="background-color:#d8f7f5">Program &amp; Fasilitas</a>
      <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Daftar Sekarang</a>
      @auth
        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-2">
          @csrf
          <button type="submit" class="btn btn-ghost btn-sm w-full" style="border-color:#e83f7d; color:#e83f7d; box-shadow: 3px 3px 0 rgba(232,63,125,0.2)">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Login</a>
        <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary w-full mt-2">💬 Hubungi via WhatsApp</a>
      @endauth
    </div>
  </header>

  <main id="main-content">

    <!-- Page Hero -->
    <section class="px-4 py-16 md:py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #ffd6e5 0%, #fff4a8 50%, #ffe0c7 100%)">
      <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-20 -translate-y-12 translate-x-12" style="background:#09b1ab"></div>
      <div class="relative mx-auto max-w-3xl text-center">
        <span class="badge badge-pink mb-4">🎒 Lengkap &amp; Terprogram</span>
        <h1 class="font-display font-black text-ink" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height:1.1">
          Program &amp; Fasilitas<br/>IMUMU Daycare
        </h1>
        <p class="section-subtitle mt-4 max-w-2xl mx-auto">
          Kami menggabungkan stimulasi tumbuh kembang, nilai-nilai islami, dan fasilitas modern untuk memastikan si kecil tumbuh optimal.
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
          <span class="badge badge-teal">Usia 3 Bln – 7 Thn</span>
          <span class="badge badge-sunshine">Senin–Sabtu 08.00–16.00</span>
          <span class="badge badge-orange">Surakarta, Jawa Tengah</span>
        </div>
      </div>
    </section>

    <!-- Program Kegiatan -->
    <section class="mx-auto max-w-7xl px-4 py-16 md:py-20 md:px-8">
      <div class="flex items-center gap-4 mb-10">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full text-2xl" style="background:#e83f7d; color:white">🎒</div>
        <div>
          <h2 class="font-display text-3xl font-black text-ink">Program Kegiatan</h2>
          <p class="text-sm font-semibold" style="color:#5c5555">Dirancang untuk stimulasi perkembangan menyeluruh</p>
        </div>
      </div>

      <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">🧠</div>
          <h3 class="font-display text-lg font-black text-ink">Stimulasi Perkembangan</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Aktivitas terstruktur untuk merangsang kognitif, motorik, dan sensoris anak.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">🕌</div>
          <h3 class="font-display text-lg font-black text-ink">Hafalan Do'a &amp; Surat</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Pengenalan do'a harian dan surat-surat pendek Al-Qur'an sejak dini.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">🙏</div>
          <h3 class="font-display text-lg font-black text-ink">Praktek Wudhu &amp; Sholat</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Bimbingan tata cara ibadah yang menyenangkan dan mudah dipahami anak.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">🩺</div>
          <h3 class="font-display text-lg font-black text-ink">Pemeriksaan Kesehatan</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Pemantauan kesehatan rutin agar tumbuh kembang anak terpantau optimal.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">💆‍♀️</div>
          <h3 class="font-display text-lg font-black text-ink">Baby Massage</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Pijat bayi yang menenangkan dan bermanfaat bagi pertumbuhan si kecil.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">📖</div>
          <h3 class="font-display text-lg font-black text-ink">Read Aloud</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Sesi membaca nyaring untuk meningkatkan kecintaan anak pada buku dan literasi.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">👨‍🍳</div>
          <h3 class="font-display text-lg font-black text-ink">Cooking Class</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Belajar memasak sederhana yang menyenangkan dan mengasah kreativitas.</p>
        </div>
        <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
          <div class="text-4xl mb-3">🌱</div>
          <h3 class="font-display text-lg font-black text-ink">Taman Gizi</h3>
          <p class="mt-1 text-sm" style="color:#5c5555">Edukasi gizi dan kesehatan melalui kegiatan berkebun yang edukatif.</p>
        </div>
      </div>
    </section>

    <!-- Fasilitas Unggulan -->
    <section class="px-4 py-16 md:py-20" style="background:#eaf9fc">
      <div class="mx-auto max-w-7xl">
        <div class="flex items-center gap-4 mb-10">
          <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full text-2xl" style="background:#f36b21; color:white">🏠</div>
          <div>
            <h2 class="font-display text-3xl font-black text-ink">Fasilitas Unggulan</h2>
            <p class="text-sm font-semibold" style="color:#5c5555">Aman, nyaman, dan mendukung tumbuh kembang si kecil</p>
          </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🛏️</div>
            <h3 class="font-display text-lg font-black text-ink">Kasur Busa &amp; AC</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Area tidur siang yang nyaman, bersih, dan berpendingin udara.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">👩‍🏫</div>
            <h3 class="font-display text-lg font-black text-ink">Tenaga Berpengalaman</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Pengasuh terlatih yang berpengalaman dalam perawatan &amp; stimulasi anak.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🎠</div>
            <h3 class="font-display text-lg font-black text-ink">Sarana Bermain</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Peralatan bermain edukatif yang aman dan sesuai usia anak.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🧊</div>
            <h3 class="font-display text-lg font-black text-ink">Freezer ASI</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Tersedia penyimpanan ASI khusus untuk mendukung ibu menyusui.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🧴</div>
            <h3 class="font-display text-lg font-black text-ink">Sterilizer</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Peralatan makan &amp; botol susu selalu terjaga kesterilannya.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🍲</div>
            <h3 class="font-display text-lg font-black text-ink">Makan Siang Bergizi</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Menu makan siang bergizi seimbang setiap hari untuk si kecil.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🛁</div>
            <h3 class="font-display text-lg font-black text-ink">Mandi Sore</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Anak pulang ke rumah dalam keadaan bersih dan segar.</p>
          </div>
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
            <div class="text-4xl mb-3">🔒</div>
            <h3 class="font-display text-lg font-black text-ink">Lingkungan Aman</h3>
            <p class="mt-1 text-sm" style="color:#5c5555">Area yang terpantau, bersih, dan ramah untuk anak-anak.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Harga -->
    <section class="px-4 py-16 md:py-24" style="background: linear-gradient(180deg, #fff8e8 0%, #ddf7ff 100%)">
      <div class="mx-auto max-w-7xl">
        <div class="text-center mb-12">
          <span class="badge badge-teal mb-3">💰 Harga Terjangkau</span>
          <h2 class="section-title">Tarif Penitipan</h2>
          <p class="section-subtitle mt-2 max-w-xl mx-auto">Harga bersahabat, fasilitas dan program terlengkap.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
          <div class="rounded-card text-center p-8 border-2" style="background:white; border-color:#ffd900; box-shadow: 6px 6px 0 #ffd900">
            <div class="text-5xl mb-3">📋</div>
            <div class="font-display text-xl font-black text-ink">Pendaftaran</div>
            <div class="mt-4 font-display font-black text-ink" style="font-size: 2.5rem; line-height:1">
              Rp 250<span class="text-xl">.000</span>
            </div>
            <div class="mt-1 text-sm font-semibold" style="color:#5c5555">Biaya satu kali</div>
            <div class="mt-5 space-y-2 text-sm text-left">
              <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>FC KK &amp; KTP Orang Tua</div>
              <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Foto 3×4 (3 lembar)</div>
              <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Formulir Pendaftaran</div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-secondary w-full mt-6">Daftar Sekarang</a>
          </div>

          <div class="rounded-card text-center p-8 border-2 relative" style="background:#09b1ab; border-color:#087c7a; box-shadow: 6px 6px 0 #087c7a">
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 badge badge-sunshine px-5 py-2 text-sm font-black whitespace-nowrap">⭐ PALING POPULER</div>
            <div class="text-5xl mt-2 mb-3">🎒</div>
            <div class="font-display text-xl font-black text-white">Murid PAUD IMUMU</div>
            <div class="mt-4 border-t border-white/30 pt-4 space-y-3">
              <div>
                <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Harian</div>
                <div class="font-display font-black text-white" style="font-size:2rem">Rp 35<span class="text-lg">.000</span></div>
              </div>
              <div class="border-t border-white/30 pt-3">
                <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Bulanan</div>
                <div class="font-display font-black text-white" style="font-size:2rem">Rp 500<span class="text-lg">.000</span></div>
              </div>
            </div>
            <a href="{{ route('contact') }}" class="btn w-full mt-6 font-black" style="background:#ffd900; color:#2f2b2b; box-shadow: 3px 3px 0 rgba(47,43,43,0.25)">Pilih Paket Ini</a>
          </div>

          <div class="rounded-card text-center p-8 border-2" style="background:white; border-color:#b85bd6; box-shadow: 6px 6px 0 #b85bd6">
            <div class="text-5xl mb-3">🧸</div>
            <div class="font-display text-xl font-black text-ink">Murid Non-PAUD</div>
            <div class="mt-4 border-t border-border-default pt-4 space-y-3">
              <div>
                <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Harian</div>
                <div class="font-display font-black text-ink" style="font-size:2rem">Rp 50<span class="text-lg">.000</span></div>
              </div>
              <div class="border-t border-border-default pt-3">
                <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Bulanan</div>
                <div class="font-display font-black text-ink" style="font-size:2rem">Rp 1 Juta</div>
              </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-ghost w-full mt-6" style="box-shadow: 3px 3px 0 #b85bd6; border-color:#b85bd6; color:#b85bd6">Pilih Paket Ini</a>
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

    <!-- CTA -->
    <section class="px-4 py-16 md:py-20">
      <div class="mx-auto max-w-3xl rounded-card text-center px-8 py-12" style="background:#09b1ab; box-shadow: 8px 8px 0 #087c7a">
        <h2 class="font-display text-3xl font-black text-white">Siap Daftar?</h2>
        <p class="mt-2 text-lg font-semibold" style="color:rgba(255,255,255,0.85)">Isi formulir pendaftaran atau hubungi Bunda Anjani langsung.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
          <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg">Isi Formulir Daftar</a>
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-ghost btn-lg" style="color:white; box-shadow: inset 0 0 0 2px white, 4px 4px 0 rgba(47,43,43,0.2)">
            💬 0858-7774-8008
          </a>
        </div>
      </div>
    </section>

  </main>

  <footer style="background:#2f2b2b; color:white">
    <div class="mx-auto max-w-7xl px-4 py-12 md:px-8 md:py-16">
      <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
        <div>
          <div class="flex items-center gap-3 mb-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-full font-display text-lg font-black" style="background:#ffd900; color:#2f2b2b">☀️</div>
            <div>
              <div class="font-display text-lg font-black">IMUMU Daycare</div>
              <div class="text-xs font-semibold" style="color:#09b1ab">Penitipan Anak Terpercaya</div>
            </div>
          </div>
          <p class="text-sm" style="color:rgba(255,255,255,0.65); line-height:1.7">Tempat si kecil tumbuh, belajar, dan bahagia setiap hari bersama pengasuh yang penuh kasih.</p>
          <div class="mt-4 flex gap-3">
            <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" aria-label="Instagram IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">IG</a>
            <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" aria-label="WhatsApp IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm" style="background:#18a058; color:white">WA</a>
          </div>
        </div>
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Navigasi</h4>
          <ul class="space-y-2.5" role="list">
            <li><a href="{{ route('home') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Beranda</a></li>
            <li><a href="{{ route('programs') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Program &amp; Fasilitas</a></li>
            <li><a href="{{ route('contact') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Daftar Anak</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Kontak</h4>
          <ul class="space-y-3 text-sm" style="color:rgba(255,255,255,0.7)" role="list">
            <li class="flex items-start gap-2"><span>📱</span><a href="https://wa.me/6285877748008" class="hover:text-white transition-colors no-underline">0858-7774-8008<br/><span class="text-xs" style="color:#09b1ab">(Bunda Anjani)</span></a></li>
            <li class="flex items-start gap-2"><span>📸</span><a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" class="hover:text-white transition-colors no-underline">@imumu_daycare</a></li>
            <li class="flex items-start gap-2"><span>🕐</span><span>Senin–Sabtu 08.00–16.00<br/><span class="text-xs italic">Minggu &amp; Merah: Tutup</span></span></li>
          </ul>
        </div>
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Alamat</h4>
          <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,0.7)">
            📍 Jl. Bone 3 RT 01 RW 03<br/>Banyuanyar, Banjarsari<br/>Surakarta, Jawa Tengah
          </p>
          <a href="https://maps.google.com?q=Jl+Bone+3+RT01+RW03+Banyuanyar+Banjarsari+Surakarta" target="_blank" rel="noopener" class="inline-flex items-center gap-1 mt-3 text-xs font-bold no-underline hover:text-white transition-colors" style="color:#09b1ab">Buka di Google Maps →</a>
        </div>
      </div>
      <div class="mt-12 border-t pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs" style="border-color:rgba(255,255,255,0.12); color:rgba(255,255,255,0.4)">
        <span>&copy; 2026 IMUMU Daycare. Semua hak dilindungi.</span>
        <span>Surakarta, Jawa Tengah</span>
      </div>
    </div>
  </footer>

  <script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');
    btn.addEventListener('click', () => {
      const isOpen = !menu.classList.contains('hidden');
      menu.classList.toggle('hidden', isOpen);
      iconOpen.classList.toggle('hidden', !isOpen);
      iconClose.classList.toggle('hidden', isOpen);
      btn.setAttribute('aria-expanded', String(!isOpen));
    });
  </script>
</body>
</html>
