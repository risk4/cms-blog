@extends('layouts.blog')

@section('title', $page->meta_title ?: $page->title . ' - ' . setting('site_title', 'My Blog'))
@section('meta_description', $page->meta_description)
@section('og_title', $page->title)
@section('og_description', $page->meta_description)
@section('og_image', $page->featured_image ? Storage::url($page->featured_image) : '')

@section('content')
    <article class="py-12 sm:py-20">
        <!-- Page Header -->
        <header class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl md:text-5xl">
                {{ $page->title }}
            </h1>
        </header>

        <!-- Featured Image -->
        @if($page->featured_image)
        <div class="mx-auto mt-12 max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl shadow-xl">
                <img src="{{ Storage::url($page->featured_image) }}" 
                     alt="{{ $page->title }}"
                     class="aspect-[21/9] w-full object-cover">
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="mx-auto mt-12 max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg prose-brand dark:prose-invert max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </article>
@endsection