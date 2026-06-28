<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Dashboard' }} - IMUMU Daycare</title>
  {{-- Prevent white/dark flash: set bg-color directly on html element --}}
  <script>
    (function() {
      var d = document.documentElement;
      var stored = localStorage.getItem('imumu-dark-mode');
      var isDark = stored === 'true' || (stored === null && window.matchMedia('(prefers-color-scheme: dark)').matches);
      d.style.backgroundColor = isDark ? '#1a1a2e' : '#FFF5F7';
      if (isDark) d.classList.add('dark');
    })();
  </script>
  {{-- Google Fonts: preconnect for faster load --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false, darkMode: isDarkMode(), userDropdown: false, showToast: {{ session('success') ? 'true' : 'false' }}, toastMessage: '{{ session('success') }}' }" :class="{ 'dark': darkMode }" class="bg-imumu-bg dark:bg-imumu-dark-bg dark:text-imumu-dark-text min-h-screen transition-colors duration-300">
<script>document.body.style.backgroundColor=document.documentElement.classList.contains('dark')?'#1a1a2e':'#FFF5F7'</script>

  {{-- Progress Bar --}}
  <div id="page-progress" class="fixed top-0 left-0 w-0 h-1 bg-imumu-pink-dark dark:bg-imumu-dark-pink z-[9999] transition-all duration-[400ms] ease-out opacity-0"></div>

  <div class="flex min-h-screen">
    @include('partials.dashboard-sidebar', ['activePage' => $activePage ?? ''])

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
      @include('partials.dashboard-header', [
          'title' => $title ?? 'Dashboard',
          'subtitle' => $subtitle ?? 'Selamat datang kembali!',
          'headerActions' => $headerActions ?? null
      ])

      <!-- Page Content -->
      <main class="flex-1 p-6 overflow-auto fade-in">
        @yield('content')
      </main>

      @include('partials.dashboard-footer')
    </div>
  </div>

  @include('partials.dashboard-toast')

</body>
</html>
