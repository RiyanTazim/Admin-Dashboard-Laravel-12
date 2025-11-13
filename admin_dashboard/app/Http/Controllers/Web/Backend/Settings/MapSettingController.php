<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MapSettingController extends Controller
{
   public function index()
   {
    return view('backend.layouts.settings.map_settings');
   }

   public function update(Request  $request)
   {
    $request->validate([
        'MAP_KEY'       => 'nullable|string',
    ]);

    try {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);
        $lineBreak = "\n";

        // Update the GOOGLE_MAPS_API_KEY in the .env file
        $envContent = preg_replace(
            '/^GOOGLE_MAPS_API_KEY=(.*)$/m',
            'GOOGLE_MAPS_API_KEY=' . $request->MAP_KEY,
            $envContent
        );

        // If the key does not exist, append it to the end of the .env file
        if (strpos($envContent, 'GOOGLE_MAPS_API_KEY=') === false) {
            $envContent .= $lineBreak . 'GOOGLE_MAPS_API_KEY=' . $request->MAP_KEY;
        }

        File::put($envPath, $envContent);

        return redirect()->back()->with('t-success', 'Map Setting Update successfully.');
    } catch (\Exception) {
        return redirect()->back()->with('t-error', 'Map Setting Update Failed');
    }
   }
}
