<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the pages
     */
    public function index()
    {
        $pages = Page::with('user')
            ->orderBy('order')
            ->paginate(15);

        return view('admin.pages.index', [
            'title' => 'Manage Pages',
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new page
     */
    public function create()
    {
        return view('admin.pages.create', [
            'title' => 'Create New Page'
        ]);
    }

    /**
     * Store a newly created page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug',
            'content' => 'required',
            'template' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'order' => 'integer|min:0',
            'show_in_menu' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set user_id
        $validated['user_id'] = auth()->id();

        // Set published_at if status is published and not set
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified page
     */
    public function show(Page $page)
    {
        $page->load('user');

        return view('admin.pages.show', [
            'title' => 'View Page',
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified page
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', [
            'title' => 'Edit Page',
            'page' => $page
        ]);
    }

    /**
     * Update the specified page
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $page->id,
            'content' => 'required',
            'template' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'order' => 'integer|min:0',
            'show_in_menu' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set published_at if status is published and not set
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}