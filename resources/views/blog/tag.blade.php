@extends('blog.layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Tag Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Tag: {{ $tag->name }}</h1>
        <p class="text-lg text-gray-600">Posts tagged with "{{ $tag->name }}"</p>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-gray-400 to-gray-600"></div>
            @endif
            <div class="p-6">
                @if($post->category)
                <a href="{{ route('blog.category', $post->category->slug) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                    {{ $post->category->name }}
                </a>
                @endif
                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-2">
                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600">
                        {{ $post->title }}
                    </a>
                </h3>
                @if($post->excerpt)
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                @endif
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                    <span>{{ $post->views }} views</span>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <p class="text-gray-600 text-lg">No posts found with this tag.</p>
    </div>
    @endif

    <!-- Back to Blog -->
    <div class="mt-8">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Blog
        </a>
    </div>
</div>
@endsection