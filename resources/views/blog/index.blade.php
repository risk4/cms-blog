@extends('layouts.blog')

@section('title', config('app.name', 'My Blog') . ' - Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-500/10 via-transparent to-brand-500/5">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                    Our Blog
                </h1>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
                    {{ config('app.name', 'My Blog') }} - Discover stories, insights, and expert advice from our team.
                </p>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($featuredPost)
                <!-- Featured Post -->
                <article class="group mb-12 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <a href="{{ route('blog.show', $featuredPost->slug) }}">
                        @if($featuredPost->featured_image)
                            <div class="aspect-[2/1] overflow-hidden">
                                <img src="{{ Storage::url($featuredPost->featured_image) }}" 
                                     alt="{{ $featuredPost->title }}"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                        @else
                            <div class="flex aspect-[2/1] items-center justify-center bg-gradient-to-br from-brand-500 to-purple-600">
                                <svg class="h-16 w-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                    </a>
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            @if($featuredPost->category)
                                <a href="{{ route('blog.category', $featuredPost->category->slug) }}" 
                                   class="rounded-full bg-brand-50 px-3 py-1 text-xs font-medium text-brand-600 dark:bg-brand-900/20 dark:text-brand-400">
                                    {{ $featuredPost->category->name }}
                                </a>
                            @endif
                            <span>{{ $featuredPost->published_at?->format('M d, Y') }}</span>
                            <span>·</span>
                            <span>{{ ceil(str_word_count(strip_tags($featuredPost->content)) / 200) }} min read</span>
                        </div>
                        <h2 class="mt-3 text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="hover:text-brand-500 transition-colors">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>
                        <p class="mt-3 line-clamp-3 text-gray-600 dark:text-gray-400">
                            {{ Str::limit(strip_tags($featuredPost->content), 200) }}
                        </p>
                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" 
                               class="inline-flex items-center gap-2 text-sm font-medium text-brand-500 hover:text-brand-600">
                                Read More
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endif

                @if($posts->count() > 0)
                <div class="space-y-8">
                    @foreach($posts as $post)
                    <article class="group overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <div class="sm:flex">
                            @if($post->featured_image)
                            <div class="sm:w-80 sm:flex-shrink-0">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    <img src="{{ Storage::url($post->featured_image) }}" 
                                         alt="{{ $post->title }}"
                                         class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105 sm:h-full sm:w-80">
                                </a>
                            </div>
                            @endif
                            <div class="flex flex-1 flex-col justify-center p-6">
                                <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                    @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}" 
                                           class="rounded-full bg-brand-50 px-3 py-1 text-xs font-medium text-brand-600 dark:bg-brand-900/20 dark:text-brand-400">
                                            {{ $post->category->name }}
                                        </a>
                                    @endif
                                    <span>{{ $post->published_at?->format('M d, Y') }}</span>
                                </div>
                                <h2 class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-brand-500 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="mt-2 line-clamp-2 text-gray-600 dark:text-gray-400">
                                    {{ Str::limit(strip_tags($post->content), 150) }}
                                </p>
                                
                                @if($post->tags->count() > 0)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.tag', $tag->slug) }}" 
                                           class="text-xs text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                                @endif
                                
                                <div class="mt-4">
                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       class="text-sm font-medium text-brand-500 hover:text-brand-600">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
                @elseif(!$featuredPost)
                <div class="py-16 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No posts yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for new content.</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="space-y-8">
                <!-- Search -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Search</h3>
                    <form action="{{ route('blog.search') }}" method="GET" class="mt-4">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                   class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-10 text-sm text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                   placeholder="Search posts...">
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Categories</h3>
                    <div class="mt-4 space-y-2">
                        @foreach($categories as $category)
                            <a href="{{ route('blog.category', $category->slug) }}" 
                               class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-gray-600 transition-colors hover:bg-gray-50 hover:text-brand-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-brand-400">
                                <span>{{ $category->name }}</span>
                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs dark:bg-gray-700">{{ $category->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($tags->count() > 0)
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tags</h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" 
                               class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 transition-colors hover:bg-brand-50 hover:text-brand-600 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-brand-900/20 dark:hover:text-brand-400">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
@endsection