<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - IMUMU Daycare</title>
  @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body x-data="{ darkMode: isDarkMode() }" :class="{ 'dark': darkMode }" class="min-h-screen bg-imumu-bg dark:bg-imumu-dark-bg overflow-hidden relative transition-colors duration-300">

  <!-- Dark Mode Toggle -->
  <button @click="darkMode = !darkMode; toggleDarkMode()" class="fixed top-4 left-4 z-50 w-10 h-10 bg-white dark:bg-imumu-dark-card rounded-full shadow-sm flex items-center justify-center hover:scale-110 transition-all cursor-pointer">
    <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
    <svg x-show="darkMode" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
  </button>

  <!-- Main Login Card -->
  <div class="flex items-center justify-center min-h-screen px-4 relative z-10">
    <div class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-2xl shadow-lg p-8 w-full max-w-md border border-gray-100 dark:border-imumu-dark-border fade-in">

      <!-- Logo & Title -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-imumu-pink-dark rounded-xl shadow-sm mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
        <h1 class="text-2xl font-bold text-imumu-pink-dark dark:text-imumu-dark-pink font-poppins">IMUMU Daycare</h1>
        <p class="text-gray-400 dark:text-gray-400 mt-1">Selamat datang!</p>
      </div>

      <!-- Login Form -->
      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf

        @if ($errors->any())
          <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm rounded-lg p-3">
            {{ $errors->first() }}
          </div>
        @endif

        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@imumu.com" class="input-field" required>
        </div>

        <div x-data="{ show: false }">
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Password</label>
          <div class="relative">
            <input :type="show ? 'text' : 'password'" name="password" placeholder="••••••••" class="input-field pr-12" required>
            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-400 hover:text-imumu-pink-dark transition-colors">
              <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
            </button>
          </div>
        </div>

        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="w-4 h-4 text-imumu-pink-dark rounded border-gray-300 focus:ring-imumu-pink-dark">
            <span class="text-sm text-gray-500 dark:text-gray-400">Ingat saya</span>
          </label>
          <a href="#" class="text-sm text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Lupa password?</a>
        </div>

        <button type="submit" class="btn-primary w-full text-base py-3">Masuk</button>
      </form>

      <div class="mt-6 text-center">
        <p class="text-gray-400 dark:text-gray-400">Belum punya akun? <a href="{{ route('register') }}" class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Daftar sekarang</a></p>
      </div>
    </div>
  </div>
</body>
</html>
