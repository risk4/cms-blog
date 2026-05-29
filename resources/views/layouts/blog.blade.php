<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', App\Helpers\SettingHelper::get('site_description', ''))">
    <meta name="keywords" content="@yield('meta_keywords', App\Helpers\SettingHelper::get('site_keywords', ''))">
    
    <title>@yield('title', App\Helpers\SettingHelper::get('site_title', 'My Blog'))</title>
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', App\Helpers\SettingHelper::get('site_title', 'My Blog'))">
    <meta property="og:description" content="@yield('og_description', App\Helpers\SettingHelper::get('site_description', ''))">
    <meta property="og:image" content="@yield('og_image', App\Helpers\SettingHelper::get('site_logo') ? Storage::url(App\Helpers\SettingHelper::get('site_logo')) : '')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-white">
    <!-- Navigation -->
    <nav class="border-b border-gray-200 bg-white/80 backdrop-blur-lg dark:border-gray-700 dark:bg-gray-900/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        @php
                            $logo = App\Helpers\SettingHelper::get('site_logo', '');
                            $siteTitle = App\Helpers\SettingHelper::get('site_title', 'My Blog');
                        @endphp
                        @if($logo)
                            <img src="{{ Storage::url($logo) }}" alt="{{ $siteTitle }}" class="h-8 w-auto">
                        @else
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-500">
                                <span class="text-sm font-bold text-white">{{ substr($siteTitle, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $siteTitle }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden items-center gap-6 md:flex">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-600 transition-colors hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">Home</a>
                    <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-600 transition-colors hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">Blog</a>
                    <a href="{{ url('/about') }}" class="text-sm font-medium text-gray-600 transition-colors hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">About</a>
                    <a href="{{ url('/contact') }}" class="text-sm font-medium text-gray-600 transition-colors hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">Contact</a>
                </div>

                <!-- Mobile menu button -->
                <div x-data="{ open: false }" class="md:hidden">
                    <button @click="open = !open" class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Mobile menu -->
                    <div x-show="open" x-cloak class="absolute left-0 right-0 top-16 border-b border-gray-200 bg-white p-4 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                        <div class="flex flex-col gap-2">
                            <a href="{{ url('/') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">Home</a>
                            <a href="{{ route('blog.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">Blog</a>
                            <a href="{{ url('/about') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">About</a>
                            <a href="{{ url('/contact') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- About -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">About</h3>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ App\Helpers\SettingHelper::get('site_description', 'A blog about various topics.') }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">Home</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-sm text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">Blog</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Follow Us</h3>
                    <div class="mt-4 flex gap-4">
                        @php
                            $socialLinks = [
                                'facebook' => App\Helpers\SettingHelper::get('social_facebook', '#'),
                                'twitter' => App\Helpers\SettingHelper::get('social_twitter', '#'),
                                'instagram' => App\Helpers\SettingHelper::get('social_instagram', '#'),
                                'youtube' => App\Helpers\SettingHelper::get('social_youtube', '#'),
                                'github' => App\Helpers\SettingHelper::get('social_github', '#'),
                            ];
                        @endphp
                        @foreach($socialLinks as $platform => $url)
                            @if($url && $url !== '#')
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-500 dark:hover:text-brand-400">
                                    <span class="sr-only">{{ ucfirst($platform) }}</span>
                                    @if($platform === 'facebook')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    @elseif($platform === 'twitter')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    @elseif($platform === 'instagram')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    @elseif($platform === 'youtube')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @elseif($platform === 'github')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="mt-8 border-t border-gray-200 pt-8 dark:border-gray-700">
                <p class="text-center text-xs text-gray-400 dark:text-gray-500">
                    &copy; {{ date('Y') }} {{ App\Helpers\SettingHelper::get('site_title', 'My Blog') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>