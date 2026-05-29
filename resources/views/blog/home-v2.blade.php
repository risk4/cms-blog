@extends('layouts.blog')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700 text-white">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <div class="hero-in-1 inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-1.5 text-sm font-medium mb-6">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    {{ $totalPosts }} Articles Published
                </div>

                <h1 class="hero-in-2 text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    Discover stories,
                    <span class="text-yellow-300">thinking</span>, and expertise
                </h1>

                <p class="hero-in-3 text-lg text-indigo-100 leading-relaxed mb-8 max-w-lg">
                    A place to read, write, and deepen your understanding. Join our community of readers and writers.
                </p>

                <div class="hero-in-3 flex flex-wrap gap-4">
                    <a href="#latest"
                        class="btn-press btn-ripple inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold rounded-xl shadow-lg hover:shadow-yellow-400/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        Start Reading
                    </a>
                    <a href="#"
                        class="btn-press inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur text-white font-semibold rounded-xl border border-white/20">
                        Explore Topics
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="hero-in-4 grid grid-cols-2 gap-4">
                @php
                    $stats = [
                        ['icon' => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z', 'value' => $totalPosts.'+', 'label' => 'Articles'],
                        ['icon' => 'M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z', 'value' => $categories->count(), 'label' => 'Categories'],
                        ['icon' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z', 'value' => '10K+', 'label' => 'Readers'],
                        ['icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z', 'value' => '24/7', 'label' => 'Available'],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-5 border border-white/10 hover:bg-white/15 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold">{{ $stat['value'] }}</p>
                        <p class="text-sm text-indigo-200 mt-1">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== TRENDING TOPICS ===== --}}
<section class="py-12 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 overflow-x-auto pb-2 scrollbar-hide">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 whitespace-nowrap">Trending:</span>
            @foreach($categories->take(8) as $cat)
            <a href="{{ route('blog.category', $cat->slug) }}"
                class="card-hover inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-indigo-300 dark:hover:border-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all whitespace-nowrap">
                {{ $cat->name }}
                <span class="text-xs text-gray-500">{{ $cat->posts_count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FEATURED ARTICLE ===== --}}
@if($featuredPosts->count() > 0)
@php $hero = $featuredPosts->first(); @endphp
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="aos-init mb-8">
            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">Editor's Pick</p>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Featured Story</h2>
        </div>

        <article class="aos-scale card-hover bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-xl group">
            <div class="grid md:grid-cols-2 gap-0">
                {{-- Image --}}
                <div class="img-zoom relative aspect-[4/3] md:aspect-auto overflow-hidden">
                    @if($hero->featured_image)
                    <img src="{{ asset('storage/' . $hero->featured_image) }}" alt="{{ $hero->title }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500"></div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-yellow-400 text-gray-900 shadow-lg">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Featured
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                            {{ $hero->category->name }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $hero->published_at->format('M d, Y') }}</span>
                    </div>

                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        <a href="{{ route('blog.show', $hero->slug) }}">{{ $hero->title }}</a>
                    </h3>

                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed line-clamp-3">
                        {{ $hero->excerpt }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-semibold">
                                {{ substr($hero->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $hero->user->name }}</p>
                                <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $hero->views }}
                                    </span>
                                    <span>•</span>
                                    <span>8 min read</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('blog.show', $hero->slug) }}"
                            class="btn-press inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                            Read More
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
@endif

{{-- ===== LATEST ARTICLES ===== --}}
<section id="latest" class="py-16 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="aos-init flex items-end justify-between mb-8">
            <div>
                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">Fresh Content</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Latest Articles</h2>
            </div>
            <a href="#"
                class="hidden sm:inline-flex items-center gap-1 text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors link-line">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $index => $post)
                    <article
                        class="aos-init card-hover delay-{{ ($index % 3 + 1) * 100 }} bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden group">

                        {{-- Thumbnail --}}
                        <div class="img-zoom aspect-video bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-indigo-900/50 dark:to-purple-800/50">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                    </svg>
                                </div>
                            @endif>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                                    {{ $post->category->name }}
                                </span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">
                                    {{ $post->published_at->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">
                                {{ $post->excerpt }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-semibold">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $post->views }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16 text-gray-400 dark:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
                <p class="text-sm">No articles published yet.</p>
            </div>
        @endif
    </div>
</section>

{{-- ===== NEWSLETTER CTA ===== --}}
<section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 aos-scale">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 text-white">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide mb-2 opacity-75">Stay Updated</p>
                <h2 class="text-3xl font-bold mb-2">Never Miss a Story</h2>
                <p class="text-base opacity-90 max-w-xl">
                    Get the latest articles and insights delivered to your inbox weekly. Join 10,000+ readers.
                </p>
            </div>
            <div class="flex-shrink-0 w-full md:w-auto">
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-6 py-4 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all">
                    <button type="submit"
                        class="btn-press btn-ripple px-8 py-4 bg-white text-indigo-600 rounded-xl font-semibold hover:bg-indigo-50 transition-all shadow-xl whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
                <p class="text-sm text-indigo-100 mt-3 text-center sm:text-left">No spam. Unsubscribe anytime.</p>
            </div>
        </div>
    </div>
</section>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@endsection