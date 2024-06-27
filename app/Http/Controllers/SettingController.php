<?php

namespace App\Http\Controllers;

use App\Constants\FeatureStatus;
use App\Helpers\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function panic_button()
    {
        $panicButtonFeature = Setting::get('panic_button');

        if ($panicButtonFeature == FeatureStatus::ACTIVE) {
            $value = FeatureStatus::INACTIVE;
        } else {
            $value = FeatureStatus::ACTIVE;
        }

        Setting::set('panic_button', $value);

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
