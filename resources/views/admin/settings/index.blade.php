@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div x-data="{ activeTab: 'general' }" class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your website configuration</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button type="button" @click="activeTab = 'general'"
                    :class="{'border-brand-500 text-brand-600 dark:border-brand-400 dark:text-brand-400': activeTab === 'general', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:text-gray-300': activeTab !== 'general'}"
                    class="whitespace-nowrap border-b-2 px-1 py-3 text-sm font-medium">
                General
            </button>
            <button type="button" @click="activeTab = 'slider'"
                    :class="{'border-brand-500 text-brand-600 dark:border-brand-400 dark:text-brand-400': activeTab === 'slider', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:text-gray-300': activeTab !== 'slider'}"
                    class="whitespace-nowrap border-b-2 px-1 py-3 text-sm font-medium">
                Hero Slider
            </button>
            <button type="button" @click="activeTab = 'contact'"
                    :class="{'border-brand-500 text-brand-600 dark:border-brand-400 dark:text-brand-400': activeTab === 'contact', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:text-gray-300': activeTab !== 'contact'}"
                    class="whitespace-nowrap border-b-2 px-1 py-3 text-sm font-medium">
                Contact
            </button>
        </nav>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Save Buttons (Top) -->
        <div class="flex items-center justify-end gap-3 mb-6">
            <button type="reset" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182" />
                </svg>
                Reset
            </button>
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H3.75v16.5H16.5V3.75Z" />
                </svg>
                Save Settings
            </button>
        </div>

        <!-- General Settings Tab Content -->
        <div x-show="activeTab === 'general'" class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <!-- General Settings -->
            <div class="xl:col-span-2 space-y-6">
                <!-- General Settings Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">General Settings</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Basic site configuration</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Site Name -->
                        <div>
                            <label for="site_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Site Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('site_name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   id="site_name" name="site_name" 
                                   value="{{ old('site_name', setting('site_name', 'ModernCMS')) }}" 
                                   placeholder="Enter your site name" required>
                            @error('site_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Site Description -->
                        <div>
                            <label for="site_description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Site Description
                            </label>
                            <textarea class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('site_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" 
                                      id="site_description" name="site_description" rows="3" 
                                      placeholder="Enter a brief description of your site">{{ old('site_description', setting('site_description')) }}</textarea>
                            @error('site_description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Site Keywords -->
                        <div>
                            <label for="site_keywords" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Site Keywords
                            </label>
                            <input type="text" 
                                   class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('site_keywords') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   id="site_keywords" name="site_keywords" 
                                   value="{{ old('site_keywords', setting('site_keywords')) }}" 
                                   placeholder="Enter keywords separated by commas">
                            @error('site_keywords')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate keywords with commas (e.g., cms, blog, laravel)</p>
                        </div>

                        <!-- Posts Per Page -->
                        <div>
                            <label for="posts_per_page" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Posts Per Page <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('posts_per_page') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   id="posts_per_page" name="posts_per_page" 
                                   value="{{ old('posts_per_page', setting('posts_per_page', 10)) }}" 
                                   min="1" max="50" required>
                            @error('posts_per_page')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Number of posts displayed per page (1-50)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo & Favicon -->
            <div class="xl:col-span-1">
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Logo & Favicon</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Brand identity</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Current Logo -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Logo</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if(setting('site_logo'))
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . setting('site_logo')) }}" 
                                             alt="Site Logo" class="mx-auto mb-2 max-h-16 object-contain">
                                        <div class="mt-2">
                                            <label class="inline-flex cursor-pointer items-center gap-1.5 text-sm text-red-500 hover:text-red-600">
                                                <input type="checkbox" name="delete_logo" value="1" class="hidden">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Remove
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No favicon uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Logo -->
                        <div>
                            <label for="site_logo" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Logo</label>
                            <div class="flex items-center gap-3">
                                <label for="site_logo" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="site_logo" name="site_logo" accept="image/*">
                                <span id="logo-filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                            @error('site_logo')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Recommended: 200x50px. Max 2MB.</p>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <!-- Current Favicon -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Favicon</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if(setting('site_favicon'))
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . setting('site_favicon')) }}" 
                                             alt="Site Favicon" class="mx-auto mb-2 h-8 w-8 object-contain">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No favicon uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Favicon -->
                        <div>
                            <label for="site_favicon" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Favicon</label>
                            <div class="flex items-center gap-3">
                                <label for="site_favicon" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="site_favicon" name="site_favicon" accept="image/png,image/x-icon">
                                <span id="favicon-filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                            @error('site_favicon')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Recommended: 32x32px or 16x16px. Max 1MB.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Slider Settings Tab Content -->
        <div x-show="activeTab === 'slider'" class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 space-y-6">
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100 dark:bg-red-900/30">
                            <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75 5.159 5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hero Slider Settings</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Configure the images and text for the homepage hero slider.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-5">
                        <!-- Slider Item 1 -->
                        <h4 class="text-base font-semibold text-gray-900 dark:text-white">Slider Item 1</h4>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if(setting('slider_1_image'))
                                    <div class="text-center">
                                        <img id="slider_1_preview" src="{{ asset('storage/' . setting('slider_1_image')) }}" 
                                             alt="Slider Image" class="mx-auto mb-2 max-h-32 object-contain">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img id="slider_1_preview" src="" class="mx-auto mb-2 max-h-32 object-contain hidden">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="slider_1_image" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Image</label>
                            <div class="flex items-center gap-3">
                                <label for="slider_1_image" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="slider_1_image" name="slider_1_image" accept="image/*">
                                <span id="slider_1_filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                        </div>
                        <div>
                            <label for="slider_1_title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title
                            </label>
                            <input type="text" name="slider_1_title" id="slider_1_title" value="{{ old('slider_1_title', setting('slider_1_title')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_1_subtitle" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Subtitle
                            </label>
                            <input type="text" name="slider_1_subtitle" id="slider_1_subtitle" value="{{ old('slider_1_subtitle', setting('slider_1_subtitle')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_1_link" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Link
                            </label>
                            <input type="text" name="slider_1_link" id="slider_1_link" value="{{ old('slider_1_link', setting('slider_1_link')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <!-- Slider Item 2 -->
                        <h4 class="text-base font-semibold text-gray-900 dark:text-white">Slider Item 2</h4>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if(setting('slider_2_image'))
                                    <div class="text-center">
                                        <img id="slider_2_preview" src="{{ asset('storage/' . setting('slider_2_image')) }}" 
                                             alt="Slider Image" class="mx-auto mb-2 max-h-32 object-contain">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img id="slider_2_preview" src="" class="mx-auto mb-2 max-h-32 object-contain hidden">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="slider_2_image" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Image</label>
                            <div class="flex items-center gap-3">
                                <label for="slider_2_image" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="slider_2_image" name="slider_2_image" accept="image/*">
                                <span id="slider_2_filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                        </div>
                        <div>
                            <label for="slider_2_title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title
                            </label>
                            <input type="text" name="slider_2_title" id="slider_2_title" value="{{ old('slider_2_title', setting('slider_2_title')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_2_subtitle" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Subtitle
                            </label>
                            <input type="text" name="slider_2_subtitle" id="slider_2_subtitle" value="{{ old('slider_2_subtitle', setting('slider_2_subtitle')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_2_link" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Link
                            </label>
                            <input type="text" name="slider_2_link" id="slider_2_link" value="{{ old('slider_2_link', setting('slider_2_link')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <!-- Slider Item 3 -->
                        <h4 class="text-base font-semibold text-gray-900 dark:text-white">Slider Item 3</h4>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if(setting('slider_3_image'))
                                    <div class="text-center">
                                        <img id="slider_3_preview" src="{{ asset('storage/' . setting('slider_3_image')) }}" 
                                             alt="Slider Image" class="mx-auto mb-2 max-h-32 object-contain">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img id="slider_3_preview" src="" class="mx-auto mb-2 max-h-32 object-contain hidden">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="slider_3_image" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Image</label>
                            <div class="flex items-center gap-3">
                                <label for="slider_3_image" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="slider_3_image" name="slider_3_image" accept="image/*">
                                <span id="slider_3_filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                        </div>
                        <div>
                            <label for="slider_3_title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title
                            </label>
                            <input type="text" name="slider_3_title" id="slider_3_title" value="{{ old('slider_3_title', setting('slider_3_title')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_3_subtitle" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Subtitle
                            </label>
                            <input type="text" name="slider_3_subtitle" id="slider_3_subtitle" value="{{ old('slider_3_subtitle', setting('slider_3_subtitle')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="slider_3_link" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Link
                            </label>
                            <input type="text" name="slider_3_link" id="slider_3_link" value="{{ old('slider_3_link', setting('slider_3_link')) }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="xl:col-span-1">
                <!-- Empty column for layout consistency if needed -->
            </div>
        </div>

        <!-- Contact Settings Tab Content -->
        <div x-show="activeTab === 'contact'" class="grid grid-cols-1 gap-6">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="mb-6 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/30">
                        <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Settings</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Configure contact page information</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Contact Email -->
                    <div>
                        <label for="contact_email" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contact Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500" 
                               id="contact_email" name="contact_email" 
                               value="{{ old('contact_email', setting('contact_email', 'info@example.com')) }}" 
                               placeholder="info@example.com" required>
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label for="contact_phone" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contact Phone
                        </label>
                        <input type="text" 
                               class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500" 
                               id="contact_phone" name="contact_phone" 
                               value="{{ old('contact_phone', setting('contact_phone')) }}" 
                               placeholder="+62 812 3456 7890">
                    </div>

                    <!-- Contact Address -->
                    <div class="md:col-span-2">
                        <label for="contact_address" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Address
                        </label>
                        <textarea class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500" 
                                  id="contact_address" name="contact_address" rows="3" 
                                  placeholder="Enter your office address">{{ old('contact_address', setting('contact_address')) }}</textarea>
                    </div>

                    <!-- Google Maps Embed URL -->
                    <div class="md:col-span-2">
                        <label for="contact_maps_embed" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Google Maps Embed URL
                        </label>
                        <input type="url" 
                               class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500" 
                               id="contact_maps_embed" name="contact_maps_embed" 
                               value="{{ old('contact_maps_embed', setting('contact_maps_embed')) }}" 
                               placeholder="https://www.google.com/maps/embed?pb=...">
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Get embed URL from Google Maps → Share → Embed a map
                        </p>
                    </div>

                    <!-- Working Hours -->
                    <div class="md:col-span-2">
                        <label for="contact_hours" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Working Hours
                        </label>
                        <textarea class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500" 
                                  id="contact_hours" name="contact_hours" rows="3" 
                                  placeholder="Monday - Friday: 9:00 AM - 5:00 PM">{{ old('contact_hours', setting('contact_hours')) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Buttons (Bottom) -->
        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="reset" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182" />
                </svg>
                Reset
            </button>
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H3.75v16.5H16.5V3.75Z" />
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // File input filename display and preview
    document.getElementById('site_logo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        document.getElementById('logo-filename').textContent = file ? file.name : 'No file chosen';
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'mx-auto mb-2 max-h-16 object-contain';
                const container = document.querySelector('label[for="site_logo"]').closest('div').parentElement.querySelector('.border-dashed');
                container.innerHTML = '';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('site_favicon')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        document.getElementById('favicon-filename').textContent = file ? file.name : 'No file chosen';
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'mx-auto mb-2 h-8 w-8 object-contain';
                const container = document.querySelector('label[for="site_favicon"]').closest('div').parentElement.querySelector('.border-dashed');
                container.innerHTML = '';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // Slider image previews
    [1, 2, 3].forEach(num => {
        const input = document.getElementById(`slider_${num}_image`);
        const preview = document.getElementById(`slider_${num}_preview`);
        const filenameDisplay = document.getElementById(`slider_${num}_filename`);
        
        input?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (filenameDisplay) {
                    filenameDisplay.textContent = file.name;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    // Hide the placeholder SVG/text if it exists in the same container
                    const container = preview.parentElement;
                    if (container) {
                        const svg = container.querySelector('svg');
                        const text = container.querySelector('p');
                        if (svg) svg.classList.add('hidden');
                        if (text) text.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush