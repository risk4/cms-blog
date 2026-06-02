<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\SettingHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        // Get all settings grouped by group
        $settings = Setting::all()->groupBy('group');
        
        // Ensure default settings exist
        $this->ensureDefaults();
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_keywords' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,ico|max:1024',
            'posts_per_page' => 'required|integer|min:1|max:50',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',
            'contact_maps_embed' => 'nullable|url|max:500',
            'contact_hours' => 'nullable|string|max:500',
            // Slider settings validation
            'slider_1_image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'slider_1_title' => 'nullable|string|max:255',
            'slider_1_subtitle' => 'nullable|string|max:500',
            'slider_1_link' => 'nullable|string|max:255',
            'slider_2_image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'slider_2_title' => 'nullable|string|max:255',
            'slider_2_subtitle' => 'nullable|string|max:500',
            'slider_2_link' => 'nullable|string|max:255',
            'slider_3_image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'slider_3_title' => 'nullable|string|max:255',
            'slider_3_subtitle' => 'nullable|string|max:500',
            'slider_3_link' => 'nullable|string|max:255',
        ]);

        // Update general settings
        SettingHelper::set('site_name', $request->site_name, 'text', 'general');
        SettingHelper::set('site_description', $request->site_description ?? '', 'textarea', 'general');
        SettingHelper::set('site_keywords', $request->site_keywords ?? '', 'text', 'general');
        SettingHelper::set('posts_per_page', $request->posts_per_page, 'text', 'general');

        // Update slider settings
        for ($i = 1; $i <= 3; $i++) {
            SettingHelper::set("slider_{$i}_title", $request->{"slider_{$i}_title"} ?? '', 'text', 'slider');
            SettingHelper::set("slider_{$i}_subtitle", $request->{"slider_{$i}_subtitle"} ?? '', 'text', 'slider');
            SettingHelper::set("slider_{$i}_link", $request->{"slider_{$i}_link"} ?? '', 'text', 'slider');

            // Handle slider image upload
            if ($request->hasFile("slider_{$i}_image")) {
                $oldImage = Setting::getValue("slider_{$i}_image");
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $imagePath = $request->file("slider_{$i}_image")->store('settings/slider', 'public');
                SettingHelper::set("slider_{$i}_image", $imagePath, 'image', 'slider');
            }
        }

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo
            $oldLogo = Setting::getValue('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            
            // Store new logo
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            SettingHelper::set('site_logo', $logoPath, 'image', 'general');
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            // Delete old favicon
            $oldFavicon = Setting::getValue('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            
            // Store new favicon
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            SettingHelper::set('site_favicon', $faviconPath, 'image', 'general');
        }

        // Delete logo if requested
        if ($request->has('delete_logo')) {
            $oldLogo = Setting::getValue('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            SettingHelper::delete('site_logo');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Delete a slider image.
     */
    public function deleteSliderImage(Request $request, string $key)
    {
        $request->validate([
            'slider_number' => 'required|integer|min:1|max:3',
        ]);

        $sliderImageKey = "slider_{$request->slider_number}_image";
        $oldImage = Setting::getValue($sliderImageKey);

        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        Setting::where('key', $sliderImageKey)->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', "Slider image {$request->slider_number} deleted successfully.");
    }

    /**
     * Ensure default settings exist in database.
     */
    private function ensureDefaults()
    {
        $defaults = [
            'site_name' => 'ModernCMS',
            'site_description' => 'A modern content management system',
            'site_keywords' => 'cms, blog, laravel',
            'posts_per_page' => '10',
            // Contact defaults
            'contact_email' => 'info@example.com',
            'contact_phone' => '+62 812 3456 7890',
            'contact_address' => '123 Main Street, City, Country',
            'contact_maps_embed' => '',
            'contact_hours' => 'Monday - Friday: 9:00 AM - 5:00 PM',
            // Slider defaults
            'slider_1_image' => '',
            'slider_1_title' => 'Discover stories, thinking, and expertise',
            'slider_1_subtitle' => 'A place to read, write, and deepen your understanding',
            'slider_1_link' => '#latest',
            'slider_2_image' => '',
            'slider_2_title' => 'Grow your knowledge with our insightful articles',
            'slider_2_subtitle' => 'Explore a wide range of topics from industry experts',
            'slider_2_link' => '#latest',
            'slider_3_image' => '',
            'slider_3_title' => 'Join our community of passionate readers',
            'slider_3_subtitle' => 'Share your thoughts and connect with like-minded individuals',
            'slider_3_link' => '#latest',
        ];

        foreach ($defaults as $key => $value) {
            if (!Setting::where('key', $key)->exists()) {
                // Determine group based on key
                $group = str_starts_with($key, 'slider_') ? 'slider' : 'general';
                $type = str_contains($key, '_image') ? 'image' : (str_contains($key, '_link') ? 'text' : 'text');
                SettingHelper::set($key, $value, $type, $group);
            }
        }
    }

    /**
     * Get a setting value (static helper).
     */
    public static function get($key, $default = null)
    {
        return Setting::getValue($key, $default);
    }
}