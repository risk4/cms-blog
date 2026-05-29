@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Post</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your post details and content</p>
        </div>
        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="text-sm font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="text-sm font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.posts.index') }}">Posts /</a>
                </li>
                <li class="text-sm font-medium text-brand-600 dark:text-brand-400">Edit</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Save Buttons (Top) -->
        <div class="flex items-center justify-end gap-3 mb-6">
            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H3.75v16.5H16.5V3.75Z" />
                </svg>
                Update Post
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <!-- Post Content & Details -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Post Information Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375H12a2.25 2.25 0 0 1-2.25-2.25V6A2.25 2.25 0 0 1 12 3.75a2.25 2.25 0 0 1 2.25 2.25v1.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Post Information</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Basic post details and content</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Title -->
                        <div>
                            <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter post title" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Slug
                            </label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Auto-generated from title" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('slug')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Excerpt
                            </label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Brief description of the post" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('excerpt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="12" placeholder="Write your post content here..." class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('content') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Publishing & Categorization Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/30">
                            <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3.002.519M12 6.042V3.75c0-1.04.752-1.93 1.803-2.169 1.1-.24 2.207-.24 3.313 0C18.248 1.82 19 2.71 19 3.75v.225m-2.248 9.406a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM12 14.25H8.25l-1.559 4.754a1.125 1.125 0 0 0 1.057 1.356h3.118a1.125 1.125 0 0 0 1.057-1.356L12 14.25Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Publishing & Categorization</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Set visibility, categories, and tags</p>
                        </div>
                    </div>

                    <div x-data="{ featured: {{ old('is_featured', $post->is_featured) ? 'true' : 'false' }}, slider: {{ old('is_slider', $post->is_slider) ? 'true' : 'false' }} }" class="space-y-5">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select id="category_id" name="category_id" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" required>
                                <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ old('status', $post->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tags
                            </label>
                            <select id="tags" name="tags[]" multiple class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('tags') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('tags')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Hold Ctrl/Cmd to select multiple tags</p>
                        </div>

                        <!-- Published Date -->
                        <div>
                            <label for="published_at" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Published Date
                            </label>
                            <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 @error('published_at') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('published_at')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Post Toggle -->
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-600 dark:bg-gray-700/50">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured Post</span>
                                    <span class="mt-1 text-xs font-semibold" :class="featured ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500'" x-text="featured ? 'Active' : 'Inactive'"></span>
                                </div>
                                <button type="button" @click="featured = !featured"
                                        :class="featured ? 'bg-brand-600' : 'bg-gray-300 dark:bg-gray-600'"
                                        class="relative inline-flex h-8 w-14 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-4 focus:ring-brand-300 dark:focus:ring-brand-800">
                                    <span :class="featured ? 'translate-x-6' : 'translate-x-0'"
                                          class="pointer-events-none relative inline-block h-7 w-7 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out">
                                    </span>
                                </button>
                                <input type="hidden" name="is_featured" :value="featured ? '1' : '0'">
                            </div>
                        </div>

                        <!-- Slider Post Toggle -->
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-600 dark:bg-gray-700/50">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Show in Slider</span>
                                    <span class="mt-1 text-xs font-semibold" :class="slider ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500'" x-text="slider ? 'Active' : 'Inactive'"></span>
                                </div>
                                <button type="button" @click="slider = !slider"
                                        :class="slider ? 'bg-brand-600' : 'bg-gray-300 dark:bg-gray-600'"
                                        class="relative inline-flex h-8 w-14 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-4 focus:ring-brand-300 dark:focus:ring-brand-800">
                                    <span :class="slider ? 'translate-x-6' : 'translate-x-0'"
                                          class="pointer-events-none relative inline-block h-7 w-7 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out">
                                    </span>
                                </button>
                                <input type="hidden" name="is_slider" :value="slider ? '1' : '0'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Featured Image</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Set a captivating image for your post</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Current Featured Image -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                            <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-600 dark:bg-gray-700/50">
                                @if($post->featured_image)
                                    <div class="text-center">
                                        <img id="featured_image_preview" src="{{ asset('storage/' . $post->featured_image) }}" alt="Current featured image" class="mx-auto mb-2 max-h-32 rounded-lg object-contain">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img id="featured_image_preview" src="" class="mx-auto mb-2 max-h-32 object-contain hidden">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Image -->
                        <div>
                            <label for="featured_image" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Image</label>
                            <div class="flex items-center gap-3">
                                <label for="featured_image" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="featured_image" name="featured_image" accept="image/*">
                                <span id="featured_image-filename" class="text-sm text-gray-500 dark:text-gray-400">No file chosen</span>
                            </div>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Leave empty to keep current image. Recommended: 1200x630px.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });

    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function(e) {
            const slug = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        });
    }

    // Featured image preview
    const featuredInput = document.getElementById('featured_image');
    const featuredPreview = document.getElementById('featured_image_preview');
    const featuredFilename = document.getElementById('featured_image-filename');
    if (featuredInput) {
        featuredInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (featuredFilename) {
                    featuredFilename.textContent = file.name;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    featuredPreview.src = event.target.result;
                    featuredPreview.classList.remove('hidden');
                    const container = featuredPreview.parentElement;
                    if (container) {
                        const svg = container.querySelector('svg');
                        const text = container.querySelector('p');
                        if (svg) svg.classList.add('hidden');
                        if (text) text.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush

@endsection