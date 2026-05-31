<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Dashboard' }} - IMUMU Daycare</title>
  @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false, darkMode: isDarkMode(), userDropdown: false, showToast: false, toastMessage: '' }" :class="{ 'dark': darkMode }" class="bg-imumu-bg dark:bg-imumu-dark-bg dark:text-imumu-dark-text min-h-screen transition-colors duration-300">

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
      <main class="flex-1 p-6 overflow-auto">
        @yield('content')
      </main>

      @include('partials.dashboard-footer')
    </div>
  </div>

  @include('partials.dashboard-toast')

</body>
</html>
