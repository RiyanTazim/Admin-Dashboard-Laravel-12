<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
     /**
     * Display a listing of content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = \App\Models\SocialMedia::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = $data->name ?? 'N/A';
                    return $name;
                })
                ->addColumn('url', function ($data) {
                    $url = $data->url ?? 'N/A';
                    return $url;
                })
                ->addColumn('image', function ($data) {
                    $image = $data->image ? asset($data->image) : asset('frontend/no-image.jpg');
                    return '<img src="' . $image . '" width="60" alt="Article Image"/>';
                })

                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })

                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="' . route('social.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                 <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name', 'url','image', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.social-media.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.layouts.social-media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'url' => 'required|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ]);
            // dd($validator->errors());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new SocialMedia();
            $data->name = $request->name;
            $data->url = $request->url;

            if ($request->hasFile('image')) {
                $imagePath = Helper::fileUpload($request->file('image'), 'socialMedia', time() . '_' . $request->file('image')->getClientOriginalName());
                if ($imagePath !== null) {
                    $data->image = $imagePath;
                }
            }

            $data->save();

            return redirect()->route('social.index')->with('t-success', 'Created Successfully !!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = SocialMedia::findOrFail($id);
        return view('backend.layouts.social-media.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $data = SocialMedia::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'url' => 'nullable|string|max:500',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data->name = $request->name;
            $data->url = $request->url;

            if ($request->hasFile('image')) {
                if ($data->image !== null) {
                    Helper::fileDelete(public_path($data->image));
                }

                $imagePath = Helper::fileUpload($request->file('image'), 'socialMedia', time() . '_' . $request->file('image')->getClientOriginalName());
                if ($imagePath !== null) {
                    $data->image = $imagePath;
                }
            }

            $data->save();

            return redirect()->route('social.index')->with('t-success', 'Updated Successfully!!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!' . $e->getMessage());
        }
    }

    /**
     * Update the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse
    {
        $data = SocialMedia::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $data = SocialMedia::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully.',
            ]);
        } catch (\Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Data.',
            ]);
        }
    }
}
