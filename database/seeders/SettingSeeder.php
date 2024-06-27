<?php

namespace Database\Seeders;

use App\Constants\FeatureStatus;
use App\Helpers\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $key = 'panic_button';
        $value = FeatureStatus::INACTIVE;

        Setting::set($key, $value);
    }
}
