<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <!-- Theme Store -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>

    <!-- Apply dark mode immediately to prevent flash -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark', 'bg-gray-900');
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('dark', 'bg-gray-900');
            }
        })();
    </script>
    
</head>

<body
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-200"
    x-data="{ 'loaded': true}"
    x-init="$store.sidebar.isExpanded = window.innerWidth >= 1280;
    const checkMobile = () => {
        if (window.innerWidth < 1280) {
            $store.sidebar.setMobileOpen(false);
            $store.sidebar.isExpanded = false;
        } else {
            $store.sidebar.isMobileOpen = false;
            $store.sidebar.isExpanded = true;
        }
    };
    window.addEventListener('resize', checkMobile);">

    {{-- preloader --}}
    <x-common.preloader/>
    {{-- preloader end --}}

    <div class="min-h-screen xl:flex bg-gray-50 dark:bg-gray-900">
        @include('layouts.backdrop')
        @include('layouts.sidebar')

        <div class="flex-1 transition-all duration-300 ease-in-out bg-gray-50 dark:bg-gray-900"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            <!-- app header start -->
            @include('layouts.app-header')
            <!-- app header end -->
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6 dark:bg-gray-900">
                @if (session('success'))
                    <div class="flex w-full mb-6 rounded-lg border-l-[6px] border-green-500 bg-green-500/5 py-3 px-7 shadow-md dark:bg-[#1b1b24] justify-between">
                        <div class="flex items-center">
                            <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-green-500">
                                <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.2984 0.826822L15.2868 0.811827L15.2741 0.797751C14.9173 0.401837 14.3238 0.400754 13.9657 0.794406L5.91888 9.53376L2.02771 5.3561C1.67048 4.97148 1.06418 4.97148 0.706954 5.3561L0.693904 5.37015L0.681963 5.38522C0.324555 5.83462 0.324555 6.57697 0.681963 7.02637L5.24966 12.7785C5.42357 12.9975 5.66363 13.1227 5.91888 13.1227C6.17413 13.1227 6.41418 12.9975 6.58809 12.7785L15.2984 1.79962C15.6558 1.35022 15.6558 0.607872 15.2984 0.158472V0.826822Z" fill="white" stroke="white"></path>
                                </svg>
                            </div>
                            <div class="w-full">
                                <h5 class="text-lg font-bold text-black dark:text-white">
                                    Success
                                </h5>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flex w-full mb-6 rounded-lg border-l-[6px] border-red-500 bg-red-500/5 py-3 px-7 shadow-md dark:bg-[#1b1b24] justify-between">
                        <div class="flex items-center">
                            <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-red-500">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.5 0C4.25381 0 0 4.25381 0 9.5C0 14.7462 4.25381 19 9.5 19C14.7462 19 19 14.7462 19 9.5C19 4.25381 14.7462 0 9.5 0ZM13.5203 12.1066C13.9108 12.4971 13.9108 13.1303 13.5203 13.5208C13.1298 13.9113 12.4966 13.9113 12.1061 13.5208L9.5 10.9147L6.89391 13.5208C6.50338 13.9113 5.87022 13.9113 5.47969 13.5208C5.08917 13.1303 5.08917 12.4971 5.47969 12.1066L8.08578 9.5L5.47969 6.89391C5.08917 6.50338 5.08917 5.87022 5.47969 5.47969C5.87022 5.08917 6.50338 5.08917 6.89391 5.47969L9.5 8.08578L12.1061 5.47969C12.4966 5.08917 13.1298 5.08917 13.5203 5.47969C13.9108 5.87022 13.9108 6.50338 13.5203 6.89391L10.9142 9.5L13.5203 12.1066Z" fill="white"></path>
                                </svg>
                            </div>
                            <div class="w-full">
                                <h5 class="text-lg font-bold text-black dark:text-white">
                                    Error
                                </h5>
                                <ul class="list-disc list-inside text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

    </div>

</body>

@stack('scripts')

</html>