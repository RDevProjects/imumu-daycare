<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'IMUMU Daycare' }}</title>
  <script>
    (function() {
      var d = document.documentElement;
      var stored = localStorage.getItem('imumu-dark-mode');
      var isDark = stored === 'true' || (stored === null && window.matchMedia('(prefers-color-scheme: dark)').matches);
      d.style.backgroundColor = isDark ? '#1a1a2e' : '#FFF5F7';
      if (isDark) d.classList.add('dark');
    })();
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>
<body x-data="{ darkMode: isDarkMode() }" :class="{ 'dark': darkMode }" class="min-h-screen bg-imumu-bg dark:bg-imumu-dark-bg overflow-hidden relative transition-colors duration-300">
<script>document.body.style.backgroundColor=document.documentElement.classList.contains('dark')?'#1a1a2e':'#FFF5F7'</script>

  @include('partials.dark-mode-toggle')

  @yield('content')

</body>
</html>
