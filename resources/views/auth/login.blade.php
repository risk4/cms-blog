<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_title', 'Admin Login') }} - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="mb-8 text-center">
                @php
                    $logo = setting('site_logo', '');
                    $siteTitle = setting('site_title', 'Laravel Blog');
                @endphp
                
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="{{ $siteTitle }}" class="mx-auto h-16 w-auto">
                @else
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-brand-500">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                @endif
                <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">{{ $siteTitle }}</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <div class="rounded-xl border border-gray-200 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email Address
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}"
                               class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                               placeholder="admin@example.com"
                               required 
                               autofocus>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                               placeholder="Enter your password"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" 
                                   class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" 
                            class="w-full rounded-lg bg-brand-500 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-500/20 transition-colors">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-gray-400 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ $siteTitle }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>