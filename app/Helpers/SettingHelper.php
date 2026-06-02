<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    /**
     * Get a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general', string $label = null): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'value' => $value,
                'type'  => $type,
                'group' => $group,
            ]
        );
        Cache::forget("setting_{$key}");
    }

    /**
     * Check if a setting exists.
     */
    public static function has(string $key): bool
    {
        return Setting::where('key', $key)->exists();
    }

    /**
     * Delete a setting.
     */
    public static function delete(string $key): void
    {
        Setting::where('key', $key)->delete();
        Cache::forget("setting_{$key}");
    }

    /**
     * Get all settings by group.
     */
    public static function group(string $group): array
    {
        return Cache::remember("settings_group_{$group}", 3600, function () use ($group) {
            return Setting::where('group', $group)
                ->get()
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Clear all settings cache.
     */
    public static function clearCache(): void
    {
        $settings = Setting::all();
        foreach ($settings as $setting) {
            Cache::forget("setting_{$setting->key}");
            Cache::forget("settings_group_{$setting->group}");
        }
    }
}