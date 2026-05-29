<?php

use App\Helpers\SettingHelper;
use App\Helpers\MediaHelper;

if (!function_exists('setting')) {
    /**
     * Get or set setting values.
     *
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed
     */
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app(SettingHelper::class);
        }

        return SettingHelper::get($key, $default);
    }
}