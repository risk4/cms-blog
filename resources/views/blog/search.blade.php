@extends('layouts.blog')

@section('title', 'Search: ' . request('q') . ' - ' . setting('site_title', 'My Blog'))

@section('content')
    <section class="bg-brand-500/5 py-16">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Search Results</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">"{{ request('q') }}" ({{ $posts->total() }} results)</p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if($posts->count() > 0)
        <div class="space-y-8">
            @foreach($posts as $post)
            <article class="group overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="sm:flex">
                    @if($post->featured_image)
                    <div class="sm:w-72 sm:flex-shrink-0">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="h-48 w-full object-cover sm:h-full sm:w-72">
                        </a>
                    </div>
                    @endif
                    <div class="flex flex-1 flex-col justify-center p-6">
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $post->published_at?->format('M d, Y') }}</div>
                        <h2 class="mt-2 text-xl font-bold text-gray-900 dark:text-white"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-8">{{ $posts->links() }}</div>
        @else
        <div class="py-16 text-center">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">No results found</h3>
            <p class="mt-1 text-gray-500">Try a different search term.</p>
        </div>
        @endif
    </div>
@endsection