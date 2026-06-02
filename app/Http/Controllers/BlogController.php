<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display homepage
     */
    public function home()
    {
        $featuredPost = Post::with(['category', 'user', 'tags'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->first();

        $posts = Post::with(['category', 'user', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(5);

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $tags = \App\Models\Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        $sliders = Post::with(['category'])
            ->published()
            ->slider()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('blog.home', [
            'title' => config('app.name', 'My Blog'),
            'featuredPosts' => $featuredPost ? collect([$featuredPost]) : collect(),
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'sliders' => $sliders
        ]);
    }

    /**
     * Display blog listing
     */
    public function index()
    {
        $featuredPost = Post::with(['category', 'user', 'tags'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->first();

        $posts = Post::with(['category', 'user', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(5);

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $tags = \App\Models\Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return view('blog.index', [
            'title' => config('app.name', 'My Blog') . ' - Blog',
            'featuredPost' => $featuredPost,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Display single post
     */
    public function show($slug)
    {
        $post = Post::with(['category', 'user', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment view count
        $post->increment('views');

        // Get related posts
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', [
            'title' => $post->meta_title ?: $post->title,
            'post' => $post,
            'relatedPosts' => $relatedPosts
        ]);
    }

    /**
     * Search posts
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::with(['category', 'user', 'tags'])
            ->published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $tags = \App\Models\Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return view('blog.search', [
            'title' => "Search: {$query} - " . config('app.name', 'My Blog'),
            'posts' => $posts,
            'query' => $query,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Display posts by category
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $posts = Post::with(['category', 'user', 'tags'])
            ->where('category_id', $category->id)
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $tags = \App\Models\Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return view('blog.category', [
            'title' => $category->name,
            'category' => $category,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Display posts by tag
     */
    public function tag($slug)
    {
        $tag = \App\Models\Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->with(['category', 'user', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $tags = \App\Models\Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return view('blog.tag', [
            'title' => 'Tag: ' . $tag->name,
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Display static page
     */
    public function contact()
    {
        return view('blog.contact', [
            'title' => 'Contact - ' . config('app.name', 'My Blog'),
            'contact' => [
                'email' => Setting::getValue('contact_email', 'info@example.com'),
                'phone' => Setting::getValue('contact_phone', '+62 812 3456 7890'),
                'address' => Setting::getValue('contact_address', '123 Main Street, City, Country'),
                'maps_embed' => Setting::getValue('contact_maps_embed', ''),
                'hours' => Setting::getValue('contact_hours', 'Monday - Friday: 9:00 AM - 5:00 PM'),
            ],
        ]);
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('pages.show', [
            'title' => $page->meta_title ?: $page->title,
            'page' => $page
        ]);
    }
}
