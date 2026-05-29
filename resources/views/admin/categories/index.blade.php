@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Categories</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Organize your posts into meaningful topics.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600 transition-colors shadow-lg shadow-orange-500/20">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add Category
            </a>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($categories as $category)
        <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 transition-all hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-start justify-between">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-500 dark:bg-orange-500/10">
                    @if($category->icon)
                    <i class="{{ $category->icon }} text-xl"></i>
                    @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    @endif
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-gray-400 hover:text-amber-600 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="mt-4">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $category->name }}</h4>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $category->description ?? 'No description provided.' }}</p>
            </div>
            <div class="mt-6 flex items-center justify-between border-t border-gray-50 pt-4 dark:border-gray-800">
                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Posts Count</span>
                <span class="inline-flex items-center rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                    {{ $category->posts_count ?? 0 }} Posts
                </span>
            </div>
        </div>
        @endforeach

        <!-- Add New Category Card -->
        <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 p-6 transition-all hover:border-orange-500 hover:bg-orange-50/30 dark:border-gray-800 dark:hover:border-orange-500/50 dark:hover:bg-orange-500/5">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-50 text-gray-400 dark:bg-white/5">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </div>
            <p class="mt-3 text-sm font-bold text-gray-900 dark:text-white">Add New Category</p>
        </a>
    </div>
</div>
@endsection