<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Blog' }} - ModernCMS</title>
    <meta name="description" content="A modern content management system built with Laravel 12">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
        
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        
        /* ===== MICRO ANIMATIONS ===== */
        /* Keyframes */
        @keyframes fadeInUp    { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeInDown  { from { opacity:0; transform:translateY(-20px);} to { opacity:1; transform:translateY(0); } }
        @keyframes fadeInLeft  { from { opacity:0; transform:translateX(-24px);} to { opacity:1; transform:translateX(0); } }
        @keyframes fadeInRight { from { opacity:0; transform:translateX(24px); } to { opacity:1; transform:translateX(0); } }
        @keyframes scaleIn     { from { opacity:0; transform:scale(0.92);      } to { opacity:1; transform:scale(1);      } }
        @keyframes float       { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
        @keyframes pulse-soft  { 0%,100%{opacity:1;} 50%{opacity:0.65;} }
        @keyframes shimmer     { 0%{background-position:-200% 0;} 100%{background-position:200% 0;} }

        /* AOS classes (Intersection Observer) */
        .aos-init  { opacity:0; transform:translateY(24px); transition:opacity .6s ease, transform .6s ease; }
        .aos-left  { opacity:0; transform:translateX(-24px); transition:opacity .6s ease, transform .6s ease; }
        .aos-right { opacity:0; transform:translateX(24px);  transition:opacity .6s ease, transform .6s ease; }
        .aos-scale { opacity:0; transform:scale(0.92);        transition:opacity .5s ease, transform .5s ease; }
        .aos-init.aos-animate, .aos-left.aos-animate, .aos-right.aos-animate, .aos-scale.aos-animate {
            opacity:1; transform:none;
        }

        /* Delay helpers */
        .delay-100 { transition-delay:.10s!important; }
        .delay-200 { transition-delay:.20s!important; }
        .delay-300 { transition-delay:.30s!important; }
        .delay-400 { transition-delay:.40s!important; }
        .delay-500 { transition-delay:.50s!important; }
        .delay-600 { transition-delay:.60s!important; }

        /* Hero animations */
        .hero-in-1 { animation:fadeInUp .6s ease .1s both; }
        .hero-in-2 { animation:fadeInUp .6s ease .2s both; }
        .hero-in-3 { animation:fadeInUp .6s ease .3s both; }
        .hero-in-4 { animation:fadeInUp .6s ease .4s both; }

        /* Stagger animation */
        .stagger > *:nth-child(1) { animation:fadeInUp .5s ease .05s both; }
        .stagger > *:nth-child(2) { animation:fadeInUp .5s ease .10s both; }
        .stagger > *:nth-child(3) { animation:fadeInUp .5s ease .15s both; }
        .stagger > *:nth-child(4) { animation:fadeInUp .5s ease .20s both; }
        .stagger > *:nth-child(5) { animation:fadeInUp .5s ease .25s both; }
        .stagger > *:nth-child(6) { animation:fadeInUp .5s ease .30s both; }
        .stagger > *:nth-child(7) { animation:fadeInUp .5s ease .35s both; }
        .stagger > *:nth-child(8) { animation:fadeInUp .5s ease .40s both; }

        /* Button effects */
        .btn-press { transition:transform .15s ease; }
        .btn-press:active { transform:scale(0.96); }
        
        .btn-ripple { position:relative; overflow:hidden; }
        .btn-ripple::after {
            content:''; position:absolute; top:50%; left:50%;
            width:0; height:0; border-radius:50%;
            background:rgba(255,255,255,.4);
            transform:translate(-50%,-50%);
            transition:width .4s ease, height .4s ease;
        }
        .btn-ripple:active::after { width:300px; height:300px; }

        /* Card hover effect */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image zoom effect */
        .img-zoom { overflow:hidden; }
        .img-zoom img {
            transition:transform .5s cubic-bezier(.4,0,.2,1);
        }
        .img-zoom:hover img {
            transform:scale(1.05);
        }

        /* Link underline animation */
        .link-line {
            position:relative;
        }
        .link-line::after {
            content:''; position:absolute; bottom:-2px; left:0;
            width:0; height:2px; background:currentColor;
            transition:width .3s ease;
        }
        .link-line:hover::after {
            width:100%;
        }
        
        /* Image aspect ratio */
        .aspect-video {
            aspect-ratio: 16 / 9;
        }
        
        .aspect-square {
            aspect-ratio: 1 / 1;
        }
        
        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Skeleton loading */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
        }
        
        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
        
        .dark .skeleton {
            background: linear-gradient(90deg, #1e293b 25%, #334155 50%, #1e293b 75%);
            background-size: 200% 100%;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 antialiased">
    <!-- Navbar Component -->
    @include('components.blog.navbar')
    
    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-violet-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-xl font-semibold">ModernCMS</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 max-w-md text-sm leading-relaxed">
                        A modern content management system built with Laravel 12. Create, manage, and publish your content with ease.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Privacy</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach(\App\Helpers\MenuHelper::getCategories()->take(5) as $category)
                        <li><a href="{{ route('blog.category', $category->slug) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    &copy; {{ date('Y') }} ModernCMS. Built with Laravel 12.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Terms</a>
                    <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scroll-top" class="fixed bottom-8 right-8 p-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:scale-110">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        // Scroll to top button
        const scrollTopBtn = document.getElementById('scroll-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'invisible');
            }
        });
        
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // AOS (Animate On Scroll) - Intersection Observer
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('aos-animate');
                    }
                });
            }, observerOptions);

            // Observe all AOS elements
            document.querySelectorAll('.aos-init, .aos-left, .aos-right, .aos-scale').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>