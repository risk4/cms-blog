@php
$isEdit = isset($post);
$title = $isEdit ? 'Edit Post' : 'Create Post';
$action = $isEdit ? route('admin.posts.update', $post) : route('admin.posts.store');
$method = $isEdit ? 'PUT' : 'POST';
@endphp

@extends('layouts.admin')

@section('title', $title)

@section('content')
<div x-data="{ 
    title: '{{ old('title', $post->title ?? '') }}',
    content: '{{ old('content', $post->content ?? '') }}',
    status: '{{ old('status', $post->status ?? 'draft') }}',
    featuredImage: '{{ old('featured_image', $post->featured_image ?? '') }}',
    showMediaModal: false,
    isSubmitting: false,
    init() {
        this.$watch('title', value => {
            // Auto-generate slug from title
            if (!this.slugEdited) {
                const slug = value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                this.$refs.slug.value = slug;
            }
        });
    },
    slugEdited: {{ $isEdit ? 'true' : 'false' }},
    onSlugInput() {
        this.slugEdited = true;
    }
}" class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ $isEdit ? 'Update your blog post' : 'Create a new blog post' }}
            </p>
        </div>
        <a href="{{ route('admin.posts.index') }}" 
           class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Posts
        </a>
    </div>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" @submit="isSubmitting = true">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Title -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title"
                           x-model="title"
                           value="{{ old('title', $post->title ?? '') }}"
                           class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                           placeholder="Enter post title"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <label for="slug" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">/</span>
                        <input type="text" 
                               name="slug" 
                               id="slug"
                               x-ref="slug"
                               @input="onSlugInput"
                               value="{{ old('slug', $post->slug ?? '') }}"
                               class="block w-full rounded-lg border border-gray-300 bg-white py-3 pl-8 pr-4 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                               placeholder="post-slug"
                               required>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">The URL-friendly version of the title</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <label for="content" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Content
                    </label>
                    <textarea name="content" 
                              id="content"
                              rows="15"
                              class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                              placeholder="Write your post content...">{{ old('content', $post->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <label for="excerpt" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Excerpt
                    </label>
                    <textarea name="excerpt" 
                              id="excerpt"
                              rows="3"
                              class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                              placeholder="Brief description of the post">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">A short summary that appears in post listings</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Actions -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Publish</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                            <select name="status" 
                                    id="status"
                                    x-model="status"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div>
                            <label for="published_at" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Publish Date
                            </label>
                            <input type="datetime-local" 
                                   name="published_at" 
                                   id="published_at"
                                   value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" 
                                    :disabled="isSubmitting"
                                    class="flex-1 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-500/20 disabled:opacity-50">
                                <span x-show="!isSubmitting">{{ $isEdit ? 'Update' : 'Publish' }}</span>
                                <span x-show="isSubmitting">Saving...</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Featured Image</h3>
                    
                    <div class="space-y-3">
                        <template x-if="featuredImage">
                            <div class="relative">
                                <img :src="featuredImage.startsWith('http') ? featuredImage : '/storage/' + featuredImage" 
                                     class="h-40 w-full rounded-lg object-cover">
                                <button type="button" 
                                        @click="featuredImage = ''"
                                        class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white hover:bg-red-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                        
                        <input type="hidden" name="featured_image" x-model="featuredImage">
                        
                        <button type="button"
                                @click="showMediaModal = true"
                                class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-300 px-4 py-8 text-gray-500 hover:border-brand-500 hover:text-brand-500 dark:border-gray-600 dark:text-gray-400 dark:hover:border-brand-500 dark:hover:text-brand-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Select Featured Image</span>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Categories</h3>
                    
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($categories as $category)
                            <label class="flex items-center gap-2">
                                <input type="radio" 
                                       name="category_id" 
                                       value="{{ $category->id }}"
                                       {{ old('category_id', isset($post) ? $post->category_id : '') == $category->id ? 'checked' : '' }}
                                       class="h-4 w-4 border-gray-300 text-brand-500 focus:ring-brand-500">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Tags</h3>
                    
                    <input type="text" 
                           name="tags" 
                           value="{{ old('tags', isset($post) ? implode(', ', $post->tags->pluck('name')->toArray()) : '') }}"
                           class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                           placeholder="tag1, tag2, tag3">
                    <p class="mt-1 text-xs text-gray-500">Separate tags with commas</p>
                </div>
            </div>
        </div>
    </form>

    <!-- Media Modal -->
    <div x-show="showMediaModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div x-show="showMediaModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/75"
             @click="showMediaModal = false"></div>
        
        <div x-show="showMediaModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Media Library</h3>
                <button @click="showMediaModal = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <iframe :src="'{{ route('admin.media.index') }}?picker=1'" class="h-96 w-full rounded-lg border border-gray-200 dark:border-gray-700"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection