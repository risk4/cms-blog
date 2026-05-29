<?php

namespace App\Helpers;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Upload a file and create media record.
     */
    public static function upload(UploadedFile $file, string $folder = 'uploads', ?string $alt = null): Media
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
        $path = $file->storeAs($folder, $filename, 'public');

        return Media::create([
            'filename'      => $filename,
            'original_name' => $originalName,
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'path'          => $path,
            'alt_text'      => $alt,
        ]);
    }

    /**
     * Delete a media file and its record.
     */
    public static function delete(int $id): bool
    {
        $media = Media::find($id);
        if (!$media) {
            return false;
        }

        Storage::disk('public')->delete($media->path);
        $media->delete();

        return true;
    }

    /**
     * Get file size in human-readable format.
     */
    public static function humanSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file icon class based on mime type.
     */
    public static function fileIcon(string $mimeType): string
    {
        return match (true) {
            str_starts_with($mimeType, 'image/') => 'image',
            str_starts_with($mimeType, 'video/') => 'video',
            str_starts_with($mimeType, 'audio/') => 'audio',
            $mimeType === 'application/pdf' => 'pdf',
            in_array($mimeType, [
                'application/zip',
                'application/x-rar-compressed',
                'application/x-7z-compressed',
            ]) => 'archive',
            default => 'file',
        };
    }
}