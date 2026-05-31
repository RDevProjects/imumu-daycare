<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - IMUMU Daycare</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ darkMode: isDarkMode() }" :class="{ 'dark': darkMode }" class="min-h-screen bg-imumu-bg dark:bg-imumu-dark-bg overflow-hidden relative transition-colors duration-300">

  <button @click="darkMode = !darkMode; toggleDarkMode()" class="fixed top-4 left-4 z-50 w-10 h-10 bg-white dark:bg-imumu-dark-card rounded-full shadow-sm flex items-center justify-center hover:scale-110 transition-all cursor-pointer">
    <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
    <svg x-show="darkMode" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
  </button>

  <div class="flex items-center justify-center min-h-screen px-4 py-8 relative z-10">
    <div class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-2xl shadow-lg p-8 w-full max-w-lg border border-gray-100 dark:border-imumu-dark-border slide-up">

      <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-imumu-blue rounded-xl shadow-sm mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        </div>
        <h1 class="text-2xl font-bold text-imumu-blue dark:text-imumu-dark-blue font-poppins">Buat Akun Baru</h1>
        <p class="text-gray-400 dark:text-gray-400 mt-1">Bergabung dengan IMUMU Daycare</p>
      </div>

      <form action="{{ route('register.post') }}" method="POST" class="space-y-4" x-data="{ password: '', confirm: '', agree: false }">
        @csrf

        @if ($errors->any())
          <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm rounded-lg p-3">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" class="input-field" required>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="input-field" required>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">No. Telepon</label>
          <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="input-field">
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Password</label>
          <input x-model="password" type="password" name="password" placeholder="Minimal 8 karakter" class="input-field" required>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Konfirmasi Password</label>
          <input x-model="confirm" type="password" name="password_confirmation" placeholder="Ulangi password" class="input-field" :class="confirm && confirm !== password ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : ''" required>
          <p x-show="confirm && confirm !== password" class="text-red-500 text-xs mt-1">Password tidak cocok!</p>
          <p x-show="confirm && confirm === password" class="text-green-500 text-xs mt-1">✓ Password cocok!</p>
        </div>
        <div class="flex items-start gap-2">
          <input x-model="agree" type="checkbox" name="agree" class="w-4 h-4 mt-0.5 text-imumu-pink-dark rounded border-gray-300 focus:ring-imumu-pink-dark" required>
          <label class="text-sm text-gray-500 dark:text-gray-400 cursor-pointer">Saya setuju dengan <a href="#" class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Kebijakan Privasi</a></label>
        </div>
        <button type="submit" class="btn-primary w-full text-base py-3" :class="!agree ? 'opacity-50 cursor-not-allowed' : ''" :disabled="!agree">Daftar Sekarang</button>
      </form>

      <div class="mt-5 text-center">
        <p class="text-gray-400 dark:text-gray-400">Sudah punya akun? <a href="{{ route('login') }}" class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Masuk di sini</a></p>
      </div>
    </div>
  </div>
</body>
</html>
