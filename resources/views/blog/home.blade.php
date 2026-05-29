@extends('layouts.blog')

@section('content')
<!-- Hero Section -->
<!-- Hero Slider Section -->
<section class="relative overflow-hidden bg-gray-900 pt-20 pb-24">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="hero-slider" class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach($sliders as $slider)
                    <li class="glide__slide">
                        <div class="grid md:grid-cols-2 gap-12 items-center">
                            <div class="text-left">
                                <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                                    {{ $slider->title }}
                                </h1>
                                <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                                    {{ $slider->excerpt }}
                                </p>
                                <a href="{{ route('blog.show', $slider->slug) }}" class="inline-flex items-center px-8 py-4 bg-yellow-400 text-gray-900 rounded-xl font-semibold hover:bg-yellow-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    Read article
                                </a>
                            </div>
                            @if($slider->featured_image)
                            <div class="relative h-96 rounded-2xl overflow-hidden">
                                <img src="{{ asset('storage/' . $slider->featured_image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="relative h-96 rounded-2xl overflow-hidden bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                @foreach($sliders as $index => $slider)
                <button class="glide__bullet" data-glide-dir="={{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.core.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/glide.min.js"></script>
<script>
    new Glide('#hero-slider', {
        type: 'carousel',
        perView: 1,
        autoplay: 5000
    }).mount();
</script>

<!-- Featured Post (Large Hero) -->
@if($featuredPosts->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 mb-20">
    @php $heroPost = $featuredPosts->first(); @endphp
    <article class="group relative bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow-xl border border-gray-200 dark:border-gray-800 card-hover">
        <div class="grid md:grid-cols-2 gap-0">
            <!-- Image -->
            <div class="relative h-64 md:h-full overflow-hidden">
                @if($heroPost->featured_image)
                <img src="{{ asset('storage/' . $heroPost->featured_image) }}" alt="{{ $heroPost->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                @else
                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-yellow-400 text-gray-900 shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Featured
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12 flex flex-col justify-center">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                        {{ $heroPost->category->name }}
                    </span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $heroPost->published_at->format('M d, Y') }}</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                    <a href="{{ route('blog.show', $heroPost->slug) }}">{{ $heroPost->title }}</a>
                </h2>

                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed line-clamp-3">
                    {{ $heroPost->excerpt }}
                </p>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{ $heroPost->views }} views
                        </span>
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            5 min read
                        </span>
                    </div>

                    <a href="{{ route('blog.show', $heroPost->slug) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors group">
                        Read article
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </article>
</section>
@endif

<!-- Latest Articles -->
<section id="latest" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="flex items-center justify-between mb-12">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">Latest articles</h2>
            <p class="text-gray-600 dark:text-gray-400">Fresh perspectives and insights</p>
        </div>
    </div>

    <!-- Category Pills -->
    <div class="flex flex-wrap gap-3 mb-12">
        <a href="/" class="px-5 py-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
            All
        </a>
        @foreach($categories as $category)
        <a href="{{ route('blog.category', $category->slug) }}" class="px-5 py-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
            {{ $category->name }}
        </a>
        @endforeach
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <article class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 card-hover">
            <a href="{{ route('blog.show', $post->slug) }}" class="block">
                <!-- Image -->
                <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                            {{ $post->category->name }}
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->published_at->diffForHumans() }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $post->title }}
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3 leading-relaxed">
                        {{ $post->excerpt }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $post->views }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                5 min
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</section>

<!-- Newsletter CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-violet-600 p-12 text-center">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Stay updated</h2>
            <p class="text-blue-100 text-lg mb-8">Get the latest articles and insights delivered to your inbox.</p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-4 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all">
                <button type="submit" class="px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-colors whitespace-nowrap shadow-lg hover:shadow-xl">
                    Subscribe
                </button>
            </form>

            <p class="text-blue-100 text-sm mt-4">No spam. Unsubscribe anytime.</p>
        </div>
    </div>
</section>

<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection