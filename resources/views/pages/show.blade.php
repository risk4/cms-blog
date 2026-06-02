@extends('layouts.blog')

@section('title', $page->meta_title ?: $page->title . ' - ' . setting('site_title', 'My Blog'))
@section('meta_description', $page->meta_description)
@section('og_title', $page->title)
@section('og_description', $page->meta_description)
@section('og_image', $page->featured_image ? Storage::url($page->featured_image) : '')

@section('content')
    <article class="bg-gray-50 py-12 dark:bg-gray-900 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <header class="mx-auto max-w-4xl text-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl md:text-5xl">
                {{ $page->title }}
            </h1>
        </header>

        <!-- Featured Image -->
        @if($page->featured_image)
        <div class="mx-auto mt-12 max-w-5xl">
            <div class="overflow-hidden rounded-2xl shadow-xl">
                <img src="{{ Storage::url($page->featured_image) }}" 
                     alt="{{ $page->title }}"
                     class="aspect-[21/9] w-full object-cover">
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="mx-auto mt-12 max-w-4xl">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 sm:p-8 lg:p-10">
                <div class="prose prose-lg prose-brand dark:prose-invert max-w-none prose-p:leading-8 prose-img:rounded-xl">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
        </div>
    </article>
@endsection