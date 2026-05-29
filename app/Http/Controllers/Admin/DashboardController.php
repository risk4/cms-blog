<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count' => Post::count(),
            'categories_count' => Category::count(),
            'pages_count' => Page::count(),
            'media_count' => Media::count(),
            'recent_posts' => Post::with('category')->latest()->take(5)->get(),
            'recent_media' => Media::latest()->take(6)->get(),
        ];

        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'stats' => $stats
        ]);
    }
}