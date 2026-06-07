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
@php
  $waNumber = \App\Models\Setting::get('daycare_wa', '');
  $waName = \App\Models\Setting::get('wa_contact_name', '');
  $waDisplayName = $waName ? "Bunda {$waName}" : 'Bunda';
  // Format: 628123456789 → 0812-3456-789
  $waDisplayNumber = $waNumber ? '0' . substr($waNumber, 2) : '';
  if (strlen($waDisplayNumber) > 4) {
    $waDisplayNumber = preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $waDisplayNumber);
  }
@endphp
        <div class="mt-4 flex gap-3">
          <a href="https://www.instagram.com/imumu_daycare" target="_blank" rel="noopener" aria-label="Instagram IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full transition-all hover:-translate-y-0.5" style="background: linear-gradient(135deg, #f36b21, #e83f7d); color:white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          @if($waNumber)
          <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" aria-label="WhatsApp IMUMU Daycare" class="flex h-10 w-10 items-center justify-center rounded-full transition-all hover:-translate-y-0.5" style="background:#18a058; color:white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
          </a>
          @endif
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
          @if($waNumber)
          <li class="flex items-start gap-2">
            <span>📱</span>
            <a href="https://wa.me/{{ $waNumber }}" class="hover:text-white transition-colors no-underline">{{ $waDisplayNumber }}<br/><span class="text-xs" style="color:#09b1ab">({{ $waDisplayName }})</span></a>
          </li>
          @endif
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
