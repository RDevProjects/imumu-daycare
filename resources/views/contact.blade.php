<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar &amp; Kontak – IMUMU Daycare Surakarta</title>
  <meta name="description" content="Daftar anak Anda di IMUMU Daycare. Hubungi Bunda Anjani di 0858-7774-8008 atau kunjungi kami di Jl. Bone 3, Banyuanyar, Banjarsari, Surakarta." />
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
        <li><a href="{{ route('programs') }}" class="nav-link">Program &amp; Fasilitas</a></li>
        <li><a href="{{ route('contact') }}" class="nav-link active">Daftar Sekarang</a></li>
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
      <a href="{{ route('programs') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Program &amp; Fasilitas</a>
      <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-soft font-semibold text-teal" style="background-color:#d8f7f5">Daftar Sekarang</a>
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
              <button type="submit" class="btn btn-primary w-full btn-lg font-black">
                🌟 Kirim Pendaftaran
              </button>
              <p class="text-xs text-center font-semibold" style="color:#5c5555">Atau hubungi langsung via <a href="https://wa.me/6285877748008" class="text-teal font-black no-underline hover:underline">WhatsApp 0858-7774-8008</a></p>
            </form>
          </div>
        </div>

        <!-- Info (2/5) -->
        <div class="lg:col-span-2 space-y-5">
          <!-- Jam Operasional -->
          <div class="card" style="border-color:#ffd900; background: linear-gradient(135deg, white 60%, #fff4a8 100%); box-shadow: 5px 5px 0 #ffd900">
            <div class="flex items-center gap-3 mb-3">
              <span class="text-3xl">🕐</span>
              <h3 class="font-display text-lg font-black text-ink">Jam Operasional</h3>
            </div>
            <div class="space-y-2 text-sm font-semibold">
              <div class="flex justify-between items-center p-2.5 rounded-soft" style="background:#d8f7f5">
                <span class="text-ink">Senin – Sabtu</span>
                <span class="font-black" style="color:#09b1ab">08.00 – 16.00</span>
              </div>
              <div class="flex justify-between items-center p-2.5 rounded-soft" style="background:#ffd6e5">
                <span class="text-ink">Minggu &amp; Merah</span>
                <span class="font-black" style="color:#e83f7d">TUTUP</span>
              </div>
            </div>
          </div>

          <!-- Kontak -->
          <div class="card" style="border-color:#09b1ab; background: linear-gradient(135deg, white 60%, #d8f7f5 100%); box-shadow: 5px 5px 0 #09b1ab">
            <div class="flex items-center gap-3 mb-3">
              <span class="text-3xl">📱</span>
              <h3 class="font-display text-lg font-black text-ink">Hubungi Kami</h3>
            </div>
            <div class="space-y-3 text-sm">
              <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-soft no-underline transition-all hover:-translate-y-0.5" style="background:#18a058; color:white">
                <span class="text-xl">💬</span>
                <div>
                  <div class="font-black">WhatsApp</div>
                  <div class="text-xs opacity-80">0858-7774-8008 (Bunda Anjani)</div>
                </div>
              </a>
              <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-soft no-underline transition-all hover:-translate-y-0.5" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">
                <span class="text-xl">📸</span>
                <div>
                  <div class="font-black">Instagram</div>
                  <div class="text-xs opacity-80">@imumu_daycare</div>
                </div>
              </a>
            </div>
          </div>

          <!-- Alamat -->
          <div class="card" style="border-color:#f36b21; background: linear-gradient(135deg, white 60%, #ffe0c7 100%); box-shadow: 5px 5px 0 #f36b21">
            <div class="flex items-center gap-3 mb-3">
              <span class="text-3xl">📍</span>
              <h3 class="font-display text-lg font-black text-ink">Lokasi</h3>
            </div>
            <p class="text-sm font-semibold leading-relaxed" style="color:#5c5555">
              Jl. Bone 3 RT 01 RW 03<br/>Banyuanyar, Banjarsari<br/>Surakarta, Jawa Tengah
            </p>
            <a href="https://maps.google.com?q=Jl+Bone+3+RT01+RW03+Banyuanyar+Banjarsari+Surakarta" target="_blank" rel="noopener" class="btn btn-ghost btn-sm mt-4 w-full" style="border-color:#f36b21; color:#f36b21; box-shadow: 2px 2px 0 #ffe0c7">
              Lihat di Google Maps →
            </a>
          </div>

          <!-- Syarat ringkas -->
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
