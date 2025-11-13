<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Models\DynamicPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DynamicPageControllerApi extends Controller
{
     /**
     * Show all Dynamic Page list
     */
    public function index()
    {
        try {
            $dynamicPage = DynamicPage::latest('id')->get();

            return Helper::jsonResponse(
                true,
                'Dynamic Page retrieved successfully',
                200,
                $dynamicPage
            );
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong while retrieving Dynamic Page', 500, [$e->getMessage()]);
        }
    }
}
