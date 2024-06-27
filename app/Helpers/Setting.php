<?php

namespace App\Helpers;

use App\Models\Setting as SettingModel;

class Setting
{
    public static function get($key, $default = null)
    {
        $setting = SettingModel::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        return SettingModel::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
