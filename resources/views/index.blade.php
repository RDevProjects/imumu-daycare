<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IMUMU Daycare – Penitipan Anak Terpercaya di Surakarta</title>
  <meta name="description" content="IMUMU Daycare menyediakan penitipan anak yang aman, hangat, dan menyenangkan. Usia 3 bulan – 7 tahun. Senin–Sabtu 08.00–16.00." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color:#fff8e8">

  <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 btn btn-primary btn-sm">Lewati ke konten utama</a>

  <!-- ===== HEADER ===== -->
  <header class="sticky top-0 z-40 bg-white/98 backdrop-blur-sm" style="box-shadow: 0 4px 0 #ffd900, 0 6px 20px rgba(47,43,43,0.08)">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-8" aria-label="Navigasi utama">
      <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline group" aria-label="IMUMU Daycare beranda">
        <div class="flex h-12 w-12 items-center justify-center rounded-full font-display text-xl font-black text-ink" style="background-color:#ffd900; box-shadow: 3px 3px 0 rgba(47,43,43,0.2)">☀️</div>
        <div>
          <div class="font-display text-xl font-black text-ink leading-none">IMUMU</div>
          <div class="text-xs font-semibold" style="color:#09b1ab">DAYCARE</div>
        </div>
      </a>

      <!-- Desktop nav -->
      <ul class="hidden md:flex items-center gap-2" role="list">
        <li><a href="{{ route('home') }}" class="nav-link active">Beranda</a></li>
        <li><a href="{{ route('programs') }}" class="nav-link">Program &amp; Fasilitas</a></li>
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
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">
            💬 WhatsApp
          </a>
          <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">Daftar Anak</a>
        @endauth
      </div>

      <!-- Mobile hamburger -->
      <button id="mobile-menu-btn" class="flex md:hidden items-center justify-center w-11 h-11 rounded-full font-bold text-white" style="background-color:#09b1ab" aria-label="Buka menu" aria-expanded="false">
        <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
        <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </nav>

    <!-- Mobile menu panel -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t-2 border-border-default px-4 py-4 space-y-2">
      <a href="{{ route('home') }}" class="block px-4 py-3 rounded-soft font-semibold text-teal" style="background-color:#d8f7f5">Beranda</a>
      <a href="{{ route('programs') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Program &amp; Fasilitas</a>
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

    <!-- ===== HERO ===== -->
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #ffd900 0%, #fff4a8 50%, #fff8e8 100%)">
      <!-- Decorative blobs -->
      <div class="absolute top-0 right-0 w-72 h-72 rounded-full opacity-20 -translate-y-16 translate-x-16" style="background:#09b1ab"></div>
      <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full opacity-20 translate-y-16 -translate-x-16" style="background:#e83f7d"></div>

      <div class="relative mx-auto max-w-7xl px-4 py-14 md:py-20 lg:py-28 md:flex md:items-center md:gap-16">
        <!-- Left: Copy -->
        <div class="md:w-1/2">
          <!-- Operating hours sticker -->
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
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
              🌟 Daftar Sekarang
            </a>
            <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">
              💬 Tanya Bunda Anjani
            </a>
          </div>

          <!-- Trust indicators -->
          <div class="mt-8 flex flex-wrap gap-3">
            <span class="badge badge-teal">✓ Tenaga Berpengalaman</span>
            <span class="badge badge-pink">✓ Program Islami</span>
            <span class="badge badge-orange">✓ Makan &amp; Mandi Sore</span>
          </div>
        </div>

        <!-- Right: Illustrated Info Card -->
        <div class="mt-12 md:mt-0 md:w-1/2 flex justify-center">
          <div class="relative">
            <!-- Main card -->
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
            <!-- Decorative sticker -->
            <div class="absolute -top-5 -right-5 flex h-16 w-16 items-center justify-center rounded-full font-display font-black text-xs text-center text-white rotate-12" style="background:#e83f7d; box-shadow: 3px 3px 0 rgba(47,43,43,0.2)">ISLAMI ✨</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== PROGRAM & FASILITAS (2-col teaser) ===== -->
    <section class="mx-auto max-w-7xl px-4 py-16 md:py-24 md:px-8">
      <div class="text-center mb-12">
        <h2 class="section-title">Program &amp; Fasilitas</h2>
        <p class="section-subtitle mt-2 max-w-2xl mx-auto">Dirancang oleh tim ahli untuk tumbuh kembang anak yang optimal, fisik maupun spiritual.</p>
      </div>

      <div class="grid gap-6 md:grid-cols-2">
        <!-- Program Card -->
        <div class="rounded-card overflow-hidden border-2" style="border-color:#e83f7d; box-shadow: 6px 6px 0 #ffd6e5">
          <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#e83f7d">
            🎒 Program Kegiatan
          </div>
          <div class="p-6 space-y-3" style="background:white">
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Stimulasi Perkembangan
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Hafalan Do'a &amp; Surat Pendek
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Praktek Wudhu &amp; Sholat
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Pemeriksaan Kesehatan Rutin
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Baby Massage
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Read Aloud &amp; Literasi
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Cooking Class
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#e83f7d">✓</span>
              Taman Gizi
            </div>
          </div>
        </div>

        <!-- Fasilitas Card -->
        <div class="rounded-card overflow-hidden border-2" style="border-color:#f36b21; box-shadow: 6px 6px 0 #ffe0c7">
          <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#f36b21">
            🏠 Fasilitas Unggulan
          </div>
          <div class="p-6 space-y-3" style="background:white">
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Kasur Busa &amp; Tidur AC
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Tenaga Pengasuh Berpengalaman
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Sarana Bermain Edukatif
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Freezer ASI
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Sterilizer Peralatan Bayi
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Makan Siang Bergizi
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Mandi Sore
            </div>
            <div class="check-list-item">
              <span class="check-icon" style="background:#f36b21">✓</span>
              Lingkungan Bersih &amp; Aman
            </div>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center">
        <a href="{{ route('programs') }}" class="btn btn-primary btn-lg">Lihat Detail Lengkap →</a>
      </div>
    </section>

    <!-- ===== HARGA / TARIF ===== -->
    <section style="background: linear-gradient(180deg, #fff8e8 0%, #ddf7ff 100%)" class="px-4 py-16 md:py-24">
      <div class="mx-auto max-w-7xl">
        <div class="text-center mb-12">
          <span class="badge badge-teal mb-3">💰 Harga Terjangkau</span>
          <h2 class="section-title">Tarif Penitipan</h2>
          <p class="section-subtitle mt-2 max-w-xl mx-auto">Harga bersahabat, fasilitas dan program terlengkap.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
          <!-- Pendaftaran -->
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

          <!-- PAUD IMUMU - Most popular -->
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

          <!-- Non-PAUD -->
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

        <!-- Syarat banner -->
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

    <!-- ===== KENAPA PILIH IMUMU ===== -->
    <section class="px-4 py-16 md:py-24" style="background:#eaf9fc">
      <div class="mx-auto max-w-7xl">
        <div class="text-center mb-12">
          <h2 class="section-title">Kenapa Pilih IMUMU?</h2>
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
    <section class="px-4 py-16 md:py-24">
      <div class="mx-auto max-w-3xl rounded-card text-center px-8 py-12 md:px-16" style="background:#09b1ab; box-shadow: 8px 8px 0 #087c7a">
        <div class="text-5xl mb-4">💬</div>
        <h2 class="font-display text-3xl font-black text-white md:text-4xl">Ada Pertanyaan?</h2>
        <p class="mt-2 text-lg font-semibold" style="color:rgba(255,255,255,0.85)">
          Hubungi langsung <strong class="text-white">Bunda Anjani</strong> via WhatsApp. Kami siap membantu!
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">
            💬 0858-7774-8008
          </a>
          <a href="{{ route('contact') }}" class="btn btn-ghost btn-lg" style="color:white; box-shadow: inset 0 0 0 2px white, 4px 4px 0 rgba(47,43,43,0.2)">
            Isi Formulir Daftar
          </a>
        </div>
      </div>
    </section>

  </main>

  <!-- ===== FOOTER ===== -->
  <footer style="background:#2f2b2b; color:white">
    <div class="mx-auto max-w-7xl px-4 py-12 md:px-8 md:py-16">
      <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Brand -->
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
            <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" aria-label="Instagram IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm transition-all hover:-translate-y-0.5" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">
              IG
            </a>
            <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" aria-label="WhatsApp IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm transition-all hover:-translate-y-0.5" style="background:#18a058; color:white">
              WA
            </a>
          </div>
        </div>

        <!-- Navigasi -->
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Navigasi</h4>
          <ul class="space-y-2.5" role="list">
            <li><a href="{{ route('home') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Beranda</a></li>
            <li><a href="{{ route('programs') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Program &amp; Fasilitas</a></li>
            <li><a href="{{ route('contact') }}" class="footer-link" style="color:rgba(255,255,255,0.7)">Daftar Anak</a></li>
          </ul>
        </div>

        <!-- Kontak -->
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Kontak</h4>
          <ul class="space-y-3 text-sm" style="color:rgba(255,255,255,0.7)" role="list">
            <li class="flex items-start gap-2">
              <span>📱</span>
              <a href="https://wa.me/6285877748008" class="hover:text-white transition-colors no-underline">0858-7774-8008<br/><span class="text-xs" style="color:#09b1ab">(Bunda Anjani)</span></a>
            </li>
            <li class="flex items-start gap-2">
              <span>📸</span>
              <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" class="hover:text-white transition-colors no-underline">@imumu_daycare</a>
            </li>
            <li class="flex items-start gap-2">
              <span>🕐</span>
              <span>Senin–Sabtu<br/>08.00–16.00 WIB<br/><span class="text-xs italic">Minggu &amp; Merah: Tutup</span></span>
            </li>
          </ul>
        </div>

        <!-- Alamat -->
        <div>
          <h4 class="font-display text-sm font-black uppercase tracking-widest mb-4" style="color:#09b1ab">Alamat</h4>
          <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,0.7)">
            📍 Jl. Bone 3 RT 01 RW 03<br/>Banyuanyar, Banjarsari<br/>Surakarta, Jawa Tengah
          </p>
          <a href="https://maps.google.com?q=Jl+Bone+3+RT01+RW03+Banyuanyar+Banjarsari+Surakarta" target="_blank" rel="noopener" class="inline-flex items-center gap-1 mt-3 text-xs font-bold no-underline hover:text-white transition-colors" style="color:#09b1ab">
            Buka di Google Maps →
          </a>
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
