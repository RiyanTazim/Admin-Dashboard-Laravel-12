<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaApiController extends Controller
{
    public function index()
    {
        try {
            $socialMedia = SocialMedia::where('status', 'active')
                ->latest()
                ->get();
                if ($socialMedia->isEmpty()) {
                return Helper::jsonErrorResponse(false, 'No Social Media found', [404]);
            }
            return Helper::jsonResponse(true, 'Social Media retrieved', 200, $socialMedia);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse(false, 'Something went wrong', [500], $e->getMessage());
        }
    }
}
