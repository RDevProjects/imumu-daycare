@php
  $isActive = fn($page) => $activePage === $page ? 'active' : '';
  $waNumber = \App\Models\Setting::get('daycare_wa', '');
  $waName = \App\Models\Setting::get('wa_contact_name', '');
  $waDisplayName = $waName ? "Bunda {$waName}" : 'Bunda';
  // Format: 628123456789 → 0812-3456-789
  $waDisplayNumber = $waNumber ? '0' . substr($waNumber, 2) : '';
  if (strlen($waDisplayNumber) > 4) {
    $waDisplayNumber = preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $waDisplayNumber);
  }
@endphp

<header class="sticky top-0 z-40 bg-white/98 backdrop-blur-sm" style="box-shadow: 0 4px 0 #ffd900, 0 6px 20px rgba(47,43,43,0.08)">
  <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-8" aria-label="Navigasi utama">
    <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline group" aria-label="IMUMU Daycare beranda">
      <img src="{{ asset('icon.webp') }}" alt="IMUMU Daycare" class="h-10 w-10 object-contain" />
      <div>
        <div class="font-display text-xl font-black text-ink leading-none">IMUMU</div>
        <div class="text-xs font-semibold" style="color:#09b1ab">DAYCARE</div>
      </div>
    </a>

    <!-- Desktop nav -->
    <ul class="hidden md:flex items-center gap-2" role="list">
      <li><a href="{{ route('home') }}" class="nav-link {{ $isActive('home') }}">Beranda</a></li>
      <li><a href="{{ route('programs') }}" class="nav-link {{ $isActive('programs') }}">Program &amp; Fasilitas</a></li>
      <li><a href="{{ route('daftar') }}" class="nav-link {{ $isActive('daftar') }}">Daftar Sekarang</a></li>
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
        @if($waNumber)
        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">💬 {{ $waDisplayName }}</a>
        @endif
        <a href="{{ route('daftar') }}" class="btn btn-primary btn-sm">Daftar Anak</a>
      @endauth
    </div>

    <!-- Mobile hamburger -->
    <button id="mobile-menu-btn" class="flex md:hidden items-center justify-center w-11 h-11 rounded-full font-bold text-white" style="background-color:#09b1ab" aria-label="Buka menu" aria-expanded="false">
      <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
      <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
  </nav>

  <!-- Mobile menu panel -->
  @php
    $isActiveMobile = fn($page) => $activePage === $page ? 'font-semibold text-teal" style="background-color:#d8f7f5' : 'font-semibold text-ink hover:bg-cream';
  @endphp
  <div id="mobile-menu" class="hidden md:hidden bg-white border-t-2 border-border-default px-4 py-4 space-y-2">
    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-soft {{ $isActiveMobile('home') }}">Beranda</a>
    <a href="{{ route('programs') }}" class="block px-4 py-3 rounded-soft {{ $isActiveMobile('programs') }}">Program &amp; Fasilitas</a>
    <a href="{{ route('daftar') }}" class="block px-4 py-3 rounded-soft {{ $isActiveMobile('daftar') }}">Daftar Sekarang</a>
    @auth
      <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-soft {{ $isActiveMobile('dashboard') }}">Dashboard</a>
      <form action="{{ route('logout') }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-ghost btn-sm w-full" style="border-color:#e83f7d; color:#e83f7d; box-shadow: 3px 3px 0 rgba(232,63,125,0.2)">Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="block px-4 py-3 rounded-soft font-semibold text-ink hover:bg-cream">Login</a>
      @if($waNumber)
      <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="btn btn-secondary w-full mt-2">💬 Hubungi {{ $waDisplayName }}</a>
      @endif
    @endauth
  </div>
</header>
