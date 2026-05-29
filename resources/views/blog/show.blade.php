@extends('blog.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Featured Image -->
        @if($post->featured_image)
        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
        @endif

        <!-- Article Content -->
        <div class="p-8">
            <!-- Category -->
            @if($post->category)
            <a href="{{ route('blog.category', $post->category->slug) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                {{ $post->category->name }}
            </a>
            @endif

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mt-4 mb-4">{{ $post->title }}</h1>

            <!-- Meta Info -->
            <div class="flex items-center text-sm text-gray-600 mb-6 pb-6 border-b border-gray-200">
                <span class="font-medium">{{ $post->user->name }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->published_at->format('F d, Y') }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->views }} views</span>
            </div>

            <!-- Excerpt -->
            @if($post->excerpt)
            <div class="text-xl text-gray-700 mb-6 italic">
                {{ $post->excerpt }}
            </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags->count() > 0)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200">
                        #{{ $tag->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </article>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedPosts as $related)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($related->featured_image)
                <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                @else
                <div class="w-full h-40 bg-gradient-to-br from-gray-400 to-gray-600"></div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                        <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-blue-600">
                            {{ $related->title }}
                        </a>
                    </h3>
                    <div class="text-sm text-gray-500">
                        {{ $related->published_at->format('M d, Y') }}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
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