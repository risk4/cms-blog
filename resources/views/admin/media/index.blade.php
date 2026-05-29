@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
    <div x-data="mediaManager()" class="space-y-6">
        
        <!-- Page Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Media Library
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage your media files
                </p>
            </div>
            <label class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white transition-colors hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-500/20 cursor-pointer">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                Upload Files
                <input type="file" accept="image/*,.pdf,.doc,.docx" multiple class="hidden" @change="uploadFiles($event)">
            </label>
        </div>

        <!-- Upload Progress -->
        <div x-show="uploads.length > 0" class="rounded-xl border border-brand-200 bg-brand-50 p-4 dark:border-brand-900 dark:bg-brand-900/20">
            <div class="mb-2 flex items-center justify-between">
                <h3 class="text-sm font-medium text-brand-700 dark:text-brand-400">Uploading...</h3>
                <span class="text-xs text-brand-600 dark:text-brand-400" x-text="`${completedUploads} of ${uploads.length}`"></span>
            </div>
            <template x-for="(upload, index) in uploads" :key="index">
                <div class="mb-2 last:mb-0">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-brand-700 dark:text-brand-400" x-text="upload.name"></span>
                        <span class="text-brand-600" x-text="upload.progress + '%'"></span>
                    </div>
                    <div class="mt-1 h-1.5 w-full overflow-hidden rounded-full bg-brand-200 dark:bg-brand-900">
                        <div class="h-full rounded-full bg-brand-500 transition-all duration-300" :style="`width: ${upload.progress}%`"></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative flex-1 sm:flex-initial">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" x-model="search" 
                       class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3 text-sm text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white sm:w-64"
                       placeholder="Search media files...">
            </div>
            
            <select x-model="typeFilter"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                <option value="">All Types</option>
                <option value="image">Images</option>
                <option value="video">Videos</option>
                <option value="document">Documents</option>
                <option value="other">Other</option>
            </select>
            
            <button @click="deleteSelected()" x-show="selectedIds.length > 0"
                    class="inline-flex items-center gap-2 rounded-lg border border-red-300 bg-white px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900/20">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Selected (<span x-text="selectedIds.length"></span>)
            </button>

            @if(request('picker'))
            <div class="ml-auto">
                <button @click="selectForPicker()" x-show="selectedIds.length === 1"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    Use Selected
                </button>
            </div>
            @endif
        </div>

        <!-- Media Grid -->
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
            @forelse($media as $file)
            <div x-data="{ selected: false }"
                 @class([
                     'group relative cursor-pointer overflow-hidden rounded-xl border-2 bg-white shadow-sm transition-all hover:shadow-md dark:bg-gray-800',
                     'border-brand-500 ring-2 ring-brand-500' => request('picker') && $loop->first,
                     'border-gray-200 dark:border-gray-700' => !(request('picker') && $loop->first),
                 ])>
                <!-- Selection Checkbox -->
                <div class="absolute left-2 top-2 z-10" x-show="'{{ request('picker') }}'">
                    <input type="checkbox" 
                           value="{{ $file->id }}"
                           x-model="selectedIds"
                           @change="selected = !selected"
                           class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500"
                           :class="{ 'ring-2 ring-brand-500 ring-offset-2': selected }">
                </div>

                <!-- Preview -->
                <div class="aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
                    @if($file->type === 'image' || Str::startsWith($file->mime_type, 'image/'))
                        <img src="{{ Storage::url($file->path) }}" 
                             alt="{{ $file->name }}"
                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                             loading="lazy">
                    @elseif($file->type === 'video' || Str::startsWith($file->mime_type, 'video/'))
                        <div class="flex h-full items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    @elseif($file->type === 'document' || Str::endsWith($file->mime_type, ['pdf', 'doc', 'docx']))
                        <div class="flex h-full items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @else
                        <div class="flex h-full items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Hover Actions -->
                    <div class="absolute inset-0 flex items-center justify-center gap-2 bg-black/50 opacity-0 transition-opacity group-hover:opacity-100" x-show="!('{{ request('picker') }}')">
                        <button @click="viewFile({{ $file->id }})" class="rounded-lg bg-white p-2 text-gray-700 shadow-lg hover:bg-gray-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <button @click="deleteFile({{ $file->id }})" class="rounded-lg bg-white p-2 text-red-600 shadow-lg hover:bg-red-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                        <button @click="copyUrl({{ $file->id }})" class="rounded-lg bg-white p-2 text-gray-700 shadow-lg hover:bg-gray-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-2">
                    <p class="truncate text-xs font-medium text-gray-900 dark:text-white" title="{{ $file->name }}">
                        {{ $file->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ number_format($file->size / 1024, 1) }} KB
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <svg class="h-16 w-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No media files</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload your first file to get started.</p>
                </div>
            </div>
            @endforelse
        </div>

        @if($media->hasPages())
            <div class="border-t border-gray-200 pt-4 dark:border-gray-700">
                {{ $media->links() }}
            </div>
        @endif

        <!-- Preview Modal -->
        <div x-show="previewFile" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div x-show="previewFile" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/75" @click="previewFile = null"></div>
            
            <div x-show="previewFile" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl dark:bg-gray-800">
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="previewFile?.name"></h3>
                    <button @click="previewFile = null" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <template x-if="previewFile?.type === 'image' || previewFile?.mime_type?.startsWith('image/')">
                        <img :src="'/storage/' + previewFile.path" class="mx-auto max-h-96 rounded-lg object-contain">
                    </template>
                    <template x-if="previewFile?.type !== 'image' && !previewFile?.mime_type?.startsWith('image/')">
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500" x-text="previewFile?.name"></p>
                            <a :href="'/storage/' + previewFile?.path" target="_blank" 
                               class="mt-4 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download File
                            </a>
                        </div>
                    </template>
                    
                    <div class="mt-4 grid grid-cols-2 gap-4 rounded-lg bg-gray-50 p-4 dark:bg-gray-900">
                        <div>
                            <p class="text-xs text-gray-500">File Name</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="previewFile?.name"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">File Size</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="previewFile?.size ? (previewFile.size / 1024).toFixed(1) + ' KB' : ''"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Type</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="previewFile?.mime_type"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Dimensions</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="previewFile?.width && previewFile?.height ? `${previewFile.width} × ${previewFile.height}` : '-'"></p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-500">URL</p>
                            <div class="flex items-center gap-2">
                                <input type="text" :value="'/storage/' + previewFile?.path" readonly
                                       class="mt-1 block w-full rounded border border-gray-300 bg-white px-2 py-1 text-xs text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <button @click="copyToClipboard('/storage/' + previewFile?.path)" 
                                        class="flex-shrink-0 rounded-lg bg-brand-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-brand-600">
                                    Copy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="deleteFileId" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div x-show="deleteFileId" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/75" @click="deleteFileId = null"></div>
            
            <div x-show="deleteFileId" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 dark:bg-gray-800">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-900/20">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete File</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Are you sure you want to delete this file? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <form method="POST" :action="`/admin/media/${deleteFileId}`" class="inline-flex">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Delete
                        </button>
                    </form>
                    <button @click="deleteFileId = null" type="button" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            function mediaManager() {
                return {
                    search: '',
                    typeFilter: '',
                    selectedIds: [],
                    previewFile: null,
                    deleteFileId: null,
                    uploads: [],
                    completedUploads: 0,

                    async uploadFiles(event) {
                        const files = event.target.files;
                        this.uploads = [];
                        this.completedUploads = 0;

                        for (let file of files) {
                            const upload = {
                                name: file.name,
                                progress: 0,
                                file: file
                            };
                            this.uploads.push(upload);
                        }

                        for (let i = 0; i < this.uploads.length; i++) {
                            await this.uploadSingleFile(this.uploads[i], i);
                        }

                        // Reload page to show new files
                        window.location.reload();
                    },

                    async uploadSingleFile(upload, index) {
                        const formData = new FormData();
                        formData.append('file', upload.file);

                        return new Promise((resolve) => {
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route('admin.media.store') }}');
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                            xhr.upload.onprogress = (e) => {
                                if (e.lengthComputable) {
                                    upload.progress = Math.round((e.loaded / e.total) * 100);
                                }
                            };

                            xhr.onload = () => {
                                this.completedUploads++;
                                resolve();
                            };

                            xhr.onerror = () => {
                                this.completedUploads++;
                                resolve();
                            };

                            xhr.send(formData);
                        });
                    },

                    viewFile(id) {
                        fetch(`/admin/media/${id}`)
                            .then(res => res.json())
                            .then(data => {
                                this.previewFile = data;
                            });
                    },

                    deleteFile(id) {
                        this.deleteFileId = id;
                    },

                    copyUrl(id) {
                        fetch(`/admin/media/${id}`)
                            .then(res => res.json())
                            .then(data => {
                                this.copyToClipboard('/storage/' + data.path);
                            });
                    },

                    copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(() => {
                            // Could add toast notification here
                        });
                    },

                    deleteSelected() {
                        if (this.selectedIds.length === 0) return;
                        if (!confirm('Are you sure you want to delete ' + this.selectedIds.length + ' files?')) return;

                        this.selectedIds.forEach(id => {
                            fetch(`/admin/media/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            });
                        });

                        window.location.reload();
                    },

                    selectForPicker() {
                        if (this.selectedIds.length !== 1) return;
                        
                        const fileId = this.selectedIds[0];
                        fetch(`/admin/media/${fileId}`)
                            .then(res => res.json())
                            .then(data => {
                                if (window.opener) {
                                    window.opener.dispatchEvent(new CustomEvent('media-selected', { detail: data }));
                                    window.close();
                                }
                            });
                    }
                };
            }
        </script>
        @endpush
    </div>
@endsection