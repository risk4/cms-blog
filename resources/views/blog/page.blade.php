@extends('blog.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Page Content -->
        <div class="p-8">
            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $page->title }}</h1>

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </article>

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