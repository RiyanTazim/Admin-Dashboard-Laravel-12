<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\CredentialSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class StripeSettingController extends Controller {
    /**
     * Display stripe settings page.
     *
     * @return View
     */
    public function index(): View {
        return view('backend.layouts.settings.stripe_settings');
    }
    /**
     * Display stripe settings page.
     *
     * @return View
     */
    public function google(): View {
        return view('backend.layouts.settings.google_settings');
    }

    public function edit()
    {
        // Retrieve the first policy entry or create a new instance if none exists
        $credential = CredentialSetting::first() ?? new CredentialSetting();
        return view('backend.layouts.credential', compact('credential'));
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'stripe_key' => 'nullable|string|max:1000',
            'stripe_secret' => 'nullable|string|max:1000',
           /*  'checkout_success_url' => 'nullable|string|max:1000',
            'checkout_cancel_url' => 'nullable|string|max:1000', */
        ]);

        // Retrieve or create the policy record
        $credential = CredentialSetting::first() ?? new CredentialSetting();

        // Update policy content
        $credential->stripe_key = $request->stripe_key;
        $credential->stripe_secret = $request->stripe_secret;

        /* $credential->checkout_success_url = $request->checkout_success_url;
        $credential->checkout_cancel_url = $request->checkout_cancel_url; */
        $credential->save();

        // Update .env file
        $this->updateEnv([
            'STRIPE_KEY' => $request->stripe_key,
            'STRIPE_SECRET' => $request->stripe_secret,

           /*  'CHECKOUT_SUCCESS_URL' => $request->checkout_success_url,
            'CHECKOUT_CANCEL_URL' => $request->checkout_cancel_url */
        ]);

        // Clear cache for changes to take effect
        Artisan::call('config:clear');

        // Redirect back with success message
        return back()->with('t-success', 'Credentials successfully updated');
    }

    // Private function to update .env datas
    private function updateEnv($data)
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            foreach ($data as $key => $value) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}={$value}";

                if (preg_match($pattern, $envContent)) {
                    $envContent = preg_replace($pattern, $replacement, $envContent);
                } else {
                    $envContent .= "\n{$key}={$value}";
                }
            }

            File::put($envPath, $envContent);
        }
    }

}
