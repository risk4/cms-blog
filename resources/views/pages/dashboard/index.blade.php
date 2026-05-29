@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Welcome back! Here's what's happening with your blog today.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    New Post
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Posts Stat -->
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-brand-500/5 transition-transform group-hover:scale-150"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</p>
                        <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['posts_count'] }}</h4>
                        <div class="mt-2 flex items-center gap-1 text-xs font-medium text-green-600">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                            <span>12% increase</span>
                        </div>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-500 text-white shadow-lg shadow-brand-500/20">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                </div>
            </div>

            <!-- Categories Stat -->
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-orange-500/5 transition-transform group-hover:scale-150"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Categories</p>
                        <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['categories_count'] }}</h4>
                        <p class="mt-2 text-xs text-gray-400">Organized content</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500 text-white shadow-lg shadow-orange-500/20">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Pages Stat -->
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-purple-500/5 transition-transform group-hover:scale-150"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pages</p>
                        <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pages_count'] }}</h4>
                        <p class="mt-2 text-xs text-gray-400">Static information</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500 text-white shadow-lg shadow-purple-500/20">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </div>
                </div>
            </div>

            <!-- Media Stat -->
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-green-500/5 transition-transform group-hover:scale-150"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Media Files</p>
                        <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['media_count'] }}</h4>
                        <p class="mt-2 text-xs text-gray-400">Images & assets</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Recent Posts -->
            <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 dark:border-gray-800">
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-brand-500"></div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Posts</h3>
                    </div>
                    <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-brand-500 hover:text-brand-600">View All</a>
                </div>
                <div class="p-6">
                    <div class="space-y-5">
                        @foreach($stats['recent_posts'] as $post)
                        <div class="group flex items-center gap-4 rounded-xl p-2 transition-colors hover:bg-gray-50 dark:hover:bg-white/5">
                            <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                <div class="flex h-full w-full items-center justify-center bg-brand-50 text-brand-500">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="truncate text-sm font-bold text-gray-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $post->title }}</h4>
                                <div class="mt-1 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-0.5 dark:bg-gray-800">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                                        {{ $post->category->name }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-400' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Media -->
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 dark:border-gray-800">
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-green-500"></div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Media</h3>
                    </div>
                    <a href="{{ route('admin.media.index') }}" class="text-sm font-medium text-brand-500 hover:text-brand-600">View All</a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($stats['recent_media'] as $media)
                        <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                            <img src="{{ asset('storage/' . $media->path) }}" alt="" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
                                <button class="rounded-full bg-white p-2 text-gray-900 shadow-lg">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @if(count($stats['recent_media']) == 0)
                        <div class="col-span-2 flex flex-col items-center justify-center py-8 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-50 text-gray-400 dark:bg-white/5">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                            <p class="text-sm text-gray-500">No media files yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection