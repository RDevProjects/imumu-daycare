<footer style="background:#2f2b2b; color:white">
  <div class="mx-auto max-w-7xl px-4 py-12 md:px-8 md:py-16">
    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
      <!-- Brand -->
      <div>
      <div class="flex items-center gap-3 mb-3">
        <img src="{{ asset('icon.webp') }}" alt="IMUMU Daycare" class="h-9 w-9 object-contain" />
        <div>
          <div class="font-display text-lg font-black">IMUMU Daycare</div>
          <div class="text-xs font-semibold" style="color:#09b1ab">Penitipan Anak Terpercaya</div>
        </div>
      </div>
        <p class="text-sm" style="color:rgba(255,255,255,0.65); line-height:1.7">Tempat si kecil tumbuh, belajar, dan bahagia setiap hari bersama pengasuh yang penuh kasih.</p>
        <div class="mt-4 flex gap-3">
          <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" aria-label="Instagram IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm transition-all hover:-translate-y-0.5" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">IG</a>
          <a href="https://wa.me/6285877748008" target="_blank" rel="noopener" aria-label="WhatsApp IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full font-bold text-sm transition-all hover:-translate-y-0.5" style="background:#18a058; color:white">WA</a>
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
