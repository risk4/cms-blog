@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            View Post
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium" href="{{ route('admin.posts.index') }}">Posts /</a>
                </li>
                <li class="font-medium text-primary">View</li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 gap-9">
        <div class="flex flex-col gap-9">
            <!-- Post Details -->
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark flex justify-between items-center">
                    <h3 class="font-medium text-black dark:text-white">
                        Post Details
                    </h3>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center justify-center rounded-md bg-primary py-2 px-6 text-center font-medium text-white hover:bg-opacity-90">
                            Edit Post
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-meta-1 py-2 px-6 text-center font-medium text-white hover:bg-opacity-90">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-6.5">
                    @if($post->featured_image)
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full max-h-96 object-cover rounded" />
                    </div>
                    @endif

                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-black dark:text-white mb-2">{{ $post->title }}</h2>
                        <div class="flex flex-wrap gap-2 items-center text-sm text-gray-500">
                            <span class="inline-flex rounded-full bg-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'meta-1') }} bg-opacity-10 py-1 px-3 text-xs font-medium text-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'meta-1') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                            @if($post->is_featured)
                            <span class="inline-flex rounded-full bg-warning bg-opacity-10 py-1 px-3 text-xs font-medium text-warning">Featured</span>
                            @endif
                            <span>•</span>
                            <span>{{ $post->views }} views</span>
                            <span>•</span>
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not published' }}</span>
                        </div>
                    </div>

                    <div class="mb-4 pb-4 border-b border-stroke dark:border-strokedark">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Category</p>
                                <p class="font-medium text-black dark:text-white">{{ $post->category->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Author</p>
                                <p class="font-medium text-black dark:text-white">{{ $post->user->name ?? 'Unknown' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Slug</p>
                                <p class="font-medium text-black dark:text-white">{{ $post->slug }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Created</p>
                                <p class="font-medium text-black dark:text-white">{{ $post->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($post->tags->count() > 0)
                    <div class="mb-4 pb-4 border-b border-stroke dark:border-strokedark">
                        <p class="text-sm text-gray-500 mb-2">Tags</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <span class="inline-flex rounded-full bg-primary bg-opacity-10 py-1 px-3 text-xs font-medium text-primary">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($post->excerpt)
                    <div class="mb-4 pb-4 border-b border-stroke dark:border-strokedark">
                        <p class="text-sm text-gray-500 mb-2">Excerpt</p>
                        <p class="text-black dark:text-white">{{ $post->excerpt }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">Content</p>
                        <div class="prose max-w-none text-black dark:text-white">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>

                    <div class="flex gap-4 mt-6">
                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="inline-flex items-center justify-center rounded-md border border-primary py-2 px-6 text-center font-medium text-primary hover:bg-opacity-90">
                            View on Site
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center justify-center rounded-md border border-stroke py-2 px-6 text-center font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection