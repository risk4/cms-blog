<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the media
     */
    public function index()
    {
        $media = Media::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.media.index', [
            'title' => 'Media Library',
            'media' => $media
        ]);
    }

    /**
     * Store a newly uploaded media
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        
        // Store the file
        $path = $file->store('media', 'public');
        
        // Create media record
        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'file_name' => $file->hashName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'disk' => 'public',
            'user_id' => auth()->id(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'media' => $media,
                'url' => $media->url
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Display the specified media
     */
    public function show(Media $media)
    {
        return response()->json($media);
    }

    /**
     * Remove the specified media
     */
    public function destroy(Media $media)
    {
        // Delete the file from storage
        Storage::disk($media->disk)->delete($media->file_path);
        
        // Delete the database record
        $media->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully.'
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }

    /**
     * Upload multiple files
     */
    public function bulkUpload(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|max:10240',
        ]);

        $uploadedMedia = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store('media', 'public');
            
            $media = Media::create([
                'name' => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'disk' => 'public',
                'user_id' => auth()->id(),
            ]);

            $uploadedMedia[] = $media;
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'media' => $uploadedMedia
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', count($uploadedMedia) . ' files uploaded successfully.');
    }
}