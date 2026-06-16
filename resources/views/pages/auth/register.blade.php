@extends('layouts.auth')

@section('title', 'Register - IMUMU Daycare')

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4 py-8 relative z-10">
        <div
            class="bg-white dark:bg-imumu-dark-card dark:border-imumu-dark-border rounded-2xl shadow-lg p-8 w-full max-w-lg border border-gray-100 dark:border-imumu-dark-border slide-up">

            <div class="text-center mb-6">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-white dark:bg-imumu-dark-card rounded-xl shadow-sm mb-4 border border-gray-100 dark:border-imumu-dark-border">
                    <img src="{{ asset('icon.webp') }}" alt="IMUMU Daycare" class="w-14 h-14 object-contain" />
                </div>
                <h1 class="text-2xl font-bold text-imumu-blue dark:text-imumu-dark-blue font-poppins">Buat Akun Baru</h1>
                <p class="text-gray-400 dark:text-gray-400 mt-1">Bergabung dengan IMUMU Daycare</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4" x-data="{ password: '', confirm: '', agree: false }">
                @csrf

                @if ($errors->any())
                    <div
                        class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm rounded-lg p-3">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap"
                        class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                        class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">No. Telepon</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                        class="input-field">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Password</label>
                    <input x-model="password" type="password" name="password" placeholder="Minimal 8 karakter"
                        class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Konfirmasi
                        Password</label>
                    <input x-model="confirm" type="password" name="password_confirmation" placeholder="Ulangi password"
                        class="input-field"
                        :class="confirm && confirm !== password ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : ''"
                        required>
                    <p x-show="confirm && confirm !== password" class="text-red-500 text-xs mt-1">Password tidak cocok!</p>
                    <p x-show="confirm && confirm === password" class="text-green-500 text-xs mt-1">✓ Password cocok!</p>
                </div>
                <div class="flex items-start gap-2">
                    <input x-model="agree" type="checkbox" name="agree"
                        class="w-4 h-4 mt-0.5 text-imumu-pink-dark rounded border-gray-300 focus:ring-imumu-pink-dark"
                        required>
                    <label class="text-sm text-gray-500 dark:text-gray-400 cursor-pointer">Saya setuju dengan <a
                            href="#"
                            class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Syarat &
                            Ketentuan</a> serta <a href="#"
                            class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Kebijakan
                            Privasi</a></label>
                </div>
                <button type="submit" class="btn-primary w-full text-base py-3"
                    :class="!agree ? 'opacity-50 cursor-not-allowed' : ''" :disabled="!agree">Daftar Sekarang</button>
            </form>

            <div class="mt-5 text-center">
                <p class="text-gray-400 dark:text-gray-400">Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-imumu-pink-dark dark:text-imumu-dark-pink font-semibold hover:underline">Masuk di
                        sini</a></p>
            </div>
        </div>
    </div>
@endsection
