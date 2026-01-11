<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#16a34a">
    <title>Login Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex items-center justify-center p-4 sm:p-6">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 bg-green-600 text-white rounded-2xl mb-3 sm:mb-4 shadow-lg">
                <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Login Admin</h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1 sm:mt-2">Masuk untuk mengakses panel admin</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5 sm:mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-3 py-2.5 sm:px-4 sm:py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('email') border-red-500 @enderror"
                        placeholder="email"
                        required
                        autofocus
                        autocomplete="email"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5 sm:mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-3 py-2.5 sm:px-4 sm:py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('password') border-red-500 @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-5 sm:mb-6">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                        >
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold py-3 sm:py-3.5 px-4 rounded-lg transition duration-200 transform active:scale-[0.98] shadow-md hover:shadow-lg text-base"
                >
                    Masuk
                </button>
            </form>

            <!-- Back to Home -->
            <div class="mt-5 sm:mt-6 text-center">
                <a href="{{ route('beranda') }}" class="text-sm text-green-600 hover:text-green-700 active:text-green-800 inline-flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-4 sm:mt-6 text-center text-xs sm:text-sm text-gray-500 px-4">
            <p>© {{ date('Y') }} Desa Ambunten Tengah. Sistem Informasi Desa.</p>
        </div>
    </div>
</body>
</html>
</body>
</html>
