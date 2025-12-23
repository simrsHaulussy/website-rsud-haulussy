<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisualEffectsSettingsSeeder extends Seeder
{
    /**
     * Default visual effects settings
     */
    public function run(): void
    {
        $settings = [
            [
                'setting_key' => 'snowfall_enabled',
                'setting_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'particles_enabled',
                'setting_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'snowfall_months',
                'setting_value' => '11,12,1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'max_snowflakes',
                'setting_value' => '50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'particles_color',
                'setting_value' => '#3db4e1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'particles_count',
                'setting_value' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('visual_effects_settings')->insert($settings);
    }
}
