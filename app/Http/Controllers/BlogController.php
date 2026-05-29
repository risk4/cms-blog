<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display blog homepage with latest posts
     */
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $featuredPosts = Post::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::active()
            ->withCount('posts')
            ->orderBy('order')
            ->get();

        $totalPosts = Post::published()->count();

        return view('blog.home-v2', [
            'title' => 'Blog',
            'posts' => $posts,
            'featuredPosts' => $featuredPosts,
            'categories' => $categories,
            'totalPosts' => $totalPosts
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

        return view('blog.category', [
            'title' => $category->name,
            'category' => $category,
            'posts' => $posts
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

        return view('blog.tag', [
            'title' => 'Tag: ' . $tag->name,
            'tag' => $tag,
            'posts' => $posts
        ]);
    }

    /**
     * Display static page
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('blog.page', [
            'title' => $page->meta_title ?: $page->title,
            'page' => $page
        ]);
    }
}