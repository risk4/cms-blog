@extends('layouts.blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-500 via-brand-600 to-brand-700 text-white">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">
                    {{ setting('site_title', 'Welcome') }}
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-brand-100">
                    {{ setting('site_description', 'Explore our latest articles and insights.') }}
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 font-medium text-brand-500 transition hover:bg-brand-50">
                        Read Blog
                    </a>
                    <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 rounded-lg border border-white/30 px-6 py-3 font-medium text-white transition hover:bg-white/10">
                        About Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Posts -->
    @if($posts->count() > 0)
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Latest Articles</h2>
                <a href="{{ route('blog.index') }}" class="text-sm font-medium text-brand-500 hover:text-brand-600">View All</a>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        @if($post->featured_image)
                            <div class="aspect-[16/9] overflow-hidden">
                                <img src="{{ Storage::url($post->featured_image) }}" 
                                     alt="{{ $post->title }}"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @else
                            <div class="flex aspect-[16/9] items-center justify-center bg-gradient-to-br from-brand-500 to-purple-600">
                                <svg class="h-12 w-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            @if($post->category)
                                <a href="{{ route('blog.category', $post->category->slug) }}" class="text-brand-500 hover:underline">{{ $post->category->name }}</a>
                                <span>•</span>
                            @endif
                            <span>{{ $post->published_at?->format('M d, Y') }}</span>
                        </div>
                        <h3 class="mt-2 text-lg font-bold text-gray-900 dark:text-white">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-brand-500 transition-colors">{{ $post->title }}</a>
                        </h3>
                        <p class="mt-2 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection