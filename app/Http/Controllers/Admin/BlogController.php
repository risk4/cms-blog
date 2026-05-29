<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Page;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function home()
    {
        $posts = Post::published()
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('pages.home', compact('posts'));
    }

    public function index()
    {
        $featuredPost = Post::published()
            ->featured()
            ->latest('published_at')
            ->first();

        $postIds = $featuredPost ? [$featuredPost->id] : [];

        $posts = Post::published()
            ->whereNotIn('id', $postIds)
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(6);

        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        $tags = Tag::latest()->get();

        return view('blog.index', compact('featuredPost', 'posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['category', 'tags', 'author'])
            ->firstOrFail();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->with(['category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::published()
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $posts = Post::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->with(['category'])
            ->latest('published_at')
            ->paginate(6);

        return view('blog.search', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(6);

        return view('blog.category', compact('category', 'posts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(6);

        return view('blog.tag', compact('tag', 'posts'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }
}
