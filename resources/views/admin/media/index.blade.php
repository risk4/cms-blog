@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Media Library</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Upload and manage your images and assets.</p>
        </div>
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <label class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-lg bg-green-500 px-4 py-2 text-sm font-medium text-white hover:bg-green-600 transition-colors shadow-lg shadow-green-500/20">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    Upload Media
                    <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        </div>
    </div>

    <!-- Media Grid -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
        @if($media->count() > 0)
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
            @foreach($media as $item)
            <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                
                <!-- Overlay Actions -->
                <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 opacity-0 transition-opacity group-hover:opacity-100">
                    <div class="flex gap-2">
                        <button onclick="copyToClipboard('{{ asset('storage/' . $item->path) }}')" class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-900 shadow-lg hover:bg-brand-500 hover:text-white transition-colors" title="Copy URL">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        </button>
                        <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this file?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-600 shadow-lg hover:bg-red-600 hover:text-white transition-colors" title="Delete">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </button>
                        </form>
                    </div>
                    <p class="mt-2 px-2 text-center text-[10px] font-medium text-white truncate w-full">{{ $item->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $media->links() }}
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-50 text-gray-400 dark:bg-white/5">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </div>
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">No media found</h4>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload your first image to the library.</p>
        </div>
        @endif
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('URL copied to clipboard!');
    });
}
</script>
@endsection