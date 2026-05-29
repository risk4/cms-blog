@extends('layouts.blog')

@section('content')
<!-- Hero Section - Premium Featured Article -->
<section class="relative bg-gradient-to-br from-gray-50 via-white to-gray-50 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950 pt-8 pb-16 overflow-hidden">
    <!-- Floating Blur Orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-40 w-96 h-96 bg-violet-500/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Badge & Stats -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-2 animate-pulse"></span>
                    {{ $totalPosts }} Articles Published
                </span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Updated daily</span>
            </div>
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">10K+ Readers</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">{{ $categories->count() }} Topics</span>
                </div>
            </div>
        </div>

        @if($featuredPosts->count() > 0)
        @php $hero = $featuredPosts->first(); @endphp
        <!-- Main Featured Article -->
        <div class="grid lg:grid-cols-12 gap-8 mb-12">
            <!-- Large Featured -->
            <article class="lg:col-span-8 group">
                <a href="{{ route('blog.show', $hero->slug) }}" class="block relative bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-200 dark:border-gray-800">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        @if($hero->featured_image)
                        <img src="{{ asset('storage/' . $hero->featured_image) }}" alt="{{ $hero->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        
                        <!-- Featured Badge -->
                        <div class="absolute top-6 left-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-yellow-400 text-gray-900 shadow-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Featured Story
                            </span>
                        </div>

                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-sm text-white border border-white/30">
                                    {{ $hero->category->name }}
                                </span>
                                <span class="text-sm text-white/90">{{ $hero->published_at->format('M d, Y') }}</span>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-white mb-3 leading-tight">
                                {{ $hero->title }}
                            </h2>
                            <p class="text-lg text-white/90 mb-4 line-clamp-2">
                                {{ $hero->excerpt }}
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-white/80">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ $hero->views }} views
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    8 min read
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>

            <!-- Side Featured Posts -->
            <div class="lg:col-span-4 space-y-6">
                @foreach($featuredPosts->skip(1)->take(2) as $featured)
                <article class="group">
                    <a href="{{ route('blog.show', $featured->slug) }}" class="block bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-800">
                        <div class="aspect-video relative overflow-hidden">
                            @if($featured->featured_image)
                            <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                            @endif
                        </div>
                        <div class="p-5">
                            <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 mb-3">
                                {{ $featured->category->name }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                {{ $featured->title }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                                {{ $featured->excerpt }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $featured->published_at->diffForHumans() }}</span>
                                <span>{{ $featured->views }} views</span>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Trending Topics -->
        <div class="flex items-center space-x-3 overflow-x-auto pb-4 scrollbar-hide">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 whitespace-nowrap">Trending:</span>
            @foreach($categories->take(6) as $cat)
            <a href="{{ route('blog.category', $cat->slug) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all whitespace-nowrap">
                {{ $cat->name }}
                <span class="ml-2 text-xs text-gray-500">{{ $cat->posts_count }}</span>
            </a>
            @endforeach>
        </div>
    </div>
</section>

<!-- Latest Stories Grid -->
<section class="py-16 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">Latest Stories</h2>
                <p class="text-gray-600 dark:text-gray-400">Fresh perspectives and insights from our community</p>
            </div>
            <a href="#" class="hidden md:inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors group">
                View all
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts->take(9) as $index => $post)
            <article class="group @if($index === 0) md:col-span-2 md:row-span-2 @endif">
                <a href="{{ route('blog.show', $post->slug) }}" class="block h-full bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-800">
                    <div class="relative @if($index === 0) aspect-[16/9] @else aspect-video @endif overflow-hidden">
                        @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600"></div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-900 dark:text-white">
                                {{ $post->category->name }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 @if($index === 0) md:p-8 @endif">
                        <h3 class="@if($index === 0) text-2xl md:text-3xl @else text-xl @endif font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 @if($index === 0) text-base line-clamp-3 @else text-sm line-clamp-2 @endif mb-4">
                            {{ $post->excerpt }}
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-semibold">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <div class="text-sm">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->published_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 text-xs text-gray-500 dark:text-gray-400">
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
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="py-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptLTEwIDBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00eiIvPjwvZz48L2c+PC9zdmc+')] opacity-10"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Never miss a story</h2>
        <p class="text-xl text-indigo-100 mb-10">Get the latest articles and insights delivered to your inbox weekly</p>
        <form class="max-w-md mx-auto">
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-4 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all">
                <button type="submit" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-semibold hover:bg-indigo-50 transition-all shadow-xl hover:shadow-2xl hover:scale-105 whitespace-nowrap">
                    Subscribe
                </button>
            </div>
            <p class="text-sm text-indigo-100 mt-4">Join 10,000+ readers. No spam, unsubscribe anytime.</p>
        </form>
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