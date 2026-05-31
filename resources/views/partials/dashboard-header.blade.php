<header class="bg-white dark:bg-imumu-dark-card shadow-sm border-b border-gray-100 dark:border-imumu-dark-border px-6 py-4">
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-4">
      <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-imumu-pink-dark transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <div>
        <h2 class="text-lg font-bold text-gray-700 dark:text-imumu-dark-text font-poppins">{{ $title ?? 'Dashboard' }}</h2>
        <p class="text-sm text-gray-400 dark:text-gray-400">{{ $subtitle ?? 'Selamat datang kembali!' }}</p>
      </div>
    </div>

    <div class="flex items-center gap-3">
      {{-- Custom Header Actions (from child view) --}}
      @if(!empty($headerActions))
        {!! $headerActions !!}
      @endif

      <!-- Dark Mode Toggle -->
      <button @click="darkMode = !darkMode; toggleDarkMode()" class="w-10 h-10 bg-gray-100 dark:bg-imumu-dark-surface rounded-full flex items-center justify-center hover:scale-110 transition-all cursor-pointer">
        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
        <svg x-show="darkMode" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
      </button>

      <!-- Notifications -->
      <button @click="showToast = true; toastMessage = '3 notifikasi baru!'" class="relative p-2 text-gray-400 dark:text-gray-400 hover:text-imumu-pink-dark transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
      </button>

      <!-- User Dropdown -->
      <div class="relative" @click.outside="userDropdown = false">
        <button @click="userDropdown = !userDropdown" class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-imumu-dark-surface transition-colors">
          <div class="w-8 h-8 bg-imumu-pink-light dark:bg-imumu-dark-pink/30 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-imumu-pink-dark dark:text-imumu-dark-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <span class="hidden md:block text-sm font-semibold text-gray-700 dark:text-imumu-dark-text">{{ Auth::user()->name ?? 'Admin' }}</span>
        </button>

        <div x-show="userDropdown" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-xl shadow-lg border border-gray-100 py-2 z-50">
          <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Profil Saya
          </a>
          <a href="{{ route('dashboard.pengaturan') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-imumu-dark-surface transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Pengaturan
          </a>
          <div class="border-t border-gray-100 dark:border-imumu-dark-border my-1"></div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
