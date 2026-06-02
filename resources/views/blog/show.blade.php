@extends('layouts.blog')

@section('title', $post->meta_title ?: $post->title . ' - ' . setting('site_title', 'My Blog'))
@section('meta_description', $post->meta_description)
@section('og_title', $post->title)
@section('og_description', $post->meta_description)
@section('og_image', $post->featured_image ? Storage::url($post->featured_image) : '')
@section('og_type', 'article')

@section('content')
    <article class="bg-gray-50 py-12 dark:bg-gray-900 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Post Header -->
        <header class="mx-auto max-w-4xl text-center">
            <div class="flex items-center justify-center gap-3 text-sm font-medium text-brand-500">
                @if($post->category)
                    <a href="{{ route('blog.category', $post->category->slug) }}" class="hover:underline">
                        {{ $post->category->name }}
                    </a>
                @endif
                <span class="text-gray-300 dark:text-gray-600">•</span>
                <time datetime="{{ $post->published_at?->toIso8601String() }}" class="text-gray-500 dark:text-gray-400">
                    {{ $post->published_at?->format('M d, Y') }}
                </time>
            </div>
            
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl md:text-5xl">
                {{ $post->title }}
            </h1>

            <div class="mt-6 flex items-center justify-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="text-left text-sm">
                    <p class="font-medium text-gray-900 dark:text-white">{{ $post->author->name ?? 'Admin' }}</p>
                    <p class="text-gray-500 dark:text-gray-400">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</p>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->featured_image)
        <div class="mx-auto mt-12 max-w-5xl">
            <div class="overflow-hidden rounded-2xl shadow-xl">
                <img src="{{ Storage::url($post->featured_image) }}" 
                     alt="{{ $post->title }}"
                     class="aspect-[21/9] w-full object-cover">
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="mx-auto mt-12 max-w-4xl">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 sm:p-8 lg:p-10">
                <div class="prose prose-lg prose-brand dark:prose-invert max-w-none prose-p:leading-8 prose-img:rounded-xl">
                    {!! $post->content !!}
                </div>
            </div>

            <!-- Tags -->
            @if($post->tags->count() > 0)
            <div class="mt-12 flex flex-wrap gap-2 border-t border-gray-100 pt-8 dark:border-gray-800">
                @foreach($post->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" 
                       class="rounded-full bg-gray-100 px-4 py-1.5 text-sm font-medium text-gray-600 transition-colors hover:bg-brand-50 hover:text-brand-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-brand-900/20 dark:hover:text-brand-400">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
            @endif

            <!-- Share -->
            <div class="mt-12 flex flex-col items-center justify-between gap-6 border-t border-gray-100 py-8 sm:flex-row dark:border-gray-800">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Share this article</h4>
                <div class="flex gap-4">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                       target="_blank" rel="noopener"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-brand-50 hover:text-brand-500 dark:bg-gray-800 dark:text-gray-400">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" rel="noopener"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-brand-50 hover:text-brand-500 dark:bg-gray-800 dark:text-gray-400">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <section class="mt-20 border-t border-gray-100 bg-gray-50/50 py-20 dark:border-gray-800 dark:bg-gray-900/50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Related Articles</h2>
                <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedPosts as $related)
                    <article class="group relative flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <div class="aspect-[16/9] overflow-hidden">
                            @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" 
                                     alt="{{ $related->title }}"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-brand-500">
                                    <span class="text-4xl font-bold text-white/20">{{ substr($related->title, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-brand-500 transition-colors">
                                    <span class="absolute inset-0"></span>
                                    {{ $related->title }}
                                </a>
                            </h3>
                            <p class="mt-2 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ Str::limit(strip_tags($related->content), 100) }}
                            </p>
                            <div class="mt-auto pt-6 text-sm text-gray-500">
                                {{ $related->published_at?->format('M d, Y') }}
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </article>
@endsection