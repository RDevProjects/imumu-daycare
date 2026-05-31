<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'IMUMU Daycare' }}</title>
  @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body x-data="{ darkMode: isDarkMode() }" :class="{ 'dark': darkMode }" class="min-h-screen bg-imumu-bg dark:bg-imumu-dark-bg overflow-hidden relative transition-colors duration-300">

  @include('partials.dark-mode-toggle')

  @yield('content')

</body>
</html>
