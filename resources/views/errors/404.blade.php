<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Halaman Tidak Ditemukan | IMUMU Daycare</title>
  @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body x-data="{ darkMode: isDarkMode() }" :class="{ 'dark': darkMode }" class="min-h-screen bg-imumu-bg dark:bg-imumu-dark-bg dark:text-imumu-dark-text overflow-hidden relative flex items-center justify-center px-4 transition-colors duration-300">

  @include('partials.dark-mode-toggle')

  <div class="text-center relative z-10 fade-in">
    <div class="mb-4">
      <span class="text-[100px] md:text-[160px] font-bold leading-none text-imumu-pink-dark dark:text-imumu-dark-pink font-poppins block">404</span>
    </div>

    <div class="mb-6 flex justify-center">
      <div class="w-24 h-24 md:w-32 md:h-32 bg-imumu-yellow dark:bg-imumu-dark-yellow rounded-full shadow-md flex items-center justify-center">
        <svg class="w-14 h-14 md:w-16 md:h-16 text-gray-700 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>

    <h2 class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-imumu-dark-text mb-3 font-poppins">Oops! Halaman hilang!</h2>
    <p class="text-gray-400 dark:text-gray-400 text-lg max-w-md mx-auto mb-2">Sepertinya halaman yang kamu cari sedang bermain petak umpet...</p>
    <p class="text-gray-300 dark:text-gray-500 max-w-sm mx-auto mb-8">Tapi jangan khawatir, kita bisa kembali ke beranda!</p>

    <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
      <a href="{{ route('home') }}" class="btn-primary px-8 py-3">Kembali ke Beranda</a>
      <a href="javascript:history.back()" class="btn-secondary px-8 py-3">Halaman Sebelumnya</a>
    </div>

    <div class="mt-10 bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl p-4 max-w-sm mx-auto shadow-sm border border-gray-100">
      <p class="text-sm text-gray-500 dark:text-gray-400">💡 <strong>Fun Fact:</strong> Di IMUMU Daycare, semua halaman selalu ceria... kecuali yang ini!</p>
    </div>
  </div>

</body>
</html>
