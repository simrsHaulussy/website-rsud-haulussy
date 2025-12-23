<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VisualEffectsController extends Controller
{
    /**
     * Display visual effects settings page
     */
    public function index()
    {
        $settings = DB::table('visual_effects_settings')
            ->pluck('setting_value', 'setting_key');

        return view('admin.visual-effects.index', compact('settings'));
    }

    /**
     * Update visual effects settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'snowfall_enabled' => 'nullable|boolean',
            'particles_enabled' => 'nullable|boolean',
            'snowfall_months' => 'nullable|string',
            'max_snowflakes' => 'nullable|integer|min:20|max:100',
            'particles_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'particles_count' => 'nullable|integer|min:1|max:20',
        ]);

        $settings = [
            'snowfall_enabled' => $request->has('snowfall_enabled') ? '1' : '0',
            'particles_enabled' => $request->has('particles_enabled') ? '1' : '0',
            'snowfall_months' => $request->input('snowfall_months', '11,12,1'),
            'max_snowflakes' => $request->input('max_snowflakes', 50),
            'particles_color' => $request->input('particles_color', '#3db4e1'),
            'particles_count' => $request->input('particles_count', 8),
        ];

        foreach ($settings as $key => $value) {
            DB::table('visual_effects_settings')
                ->updateOrInsert(
                    ['setting_key' => $key],
                    ['setting_value' => $value, 'updated_at' => now()]
                );
        }

        // Clear cache to refresh settings
        Cache::forget('visual_effects');

        return redirect()
            ->route('visual-effects.index')
            ->with('success', 'Visual effects settings updated successfully.');
    }
}
