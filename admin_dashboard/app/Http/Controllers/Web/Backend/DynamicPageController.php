<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Helpers\Helper;
use Illuminate\View\View;
use App\Models\DynamicPage;
use App\Models\SocialMedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class DynamicPageController
{
    /**
     * Display a listing of dynamic page content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = DynamicPage::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_title', function ($data) {
                    $page_title = $data->page_title;
                    return $page_title;
                })
                 ->addColumn('page_content', function ($data) {
                    $page_content = $data->page_content ?? 'N/A';
                    return Str::limit($page_content, 30, '...');
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
                                <a href="' . route('dynamic.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                 <a href="' . route('dynamic.show', ['id' => $data->id]) . '" type="button" class="btn btn-warning fs-14 text-white edit-icn" title="show">
                                    <i class="fe fe-eye"></i>
                                </a>
                                 <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['page_title', 'page_content', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.dynamic.index');
    }

    public function create(): View
    {
        return view('backend.layouts.dynamic.create');
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
                'page_title' => 'required|string|max:1000',
                'page_content' => 'required|string|max:50000',
            ]);
            // dd($validator->errors());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new DynamicPage();
            $data->page_title = $request->page_title;
            $data->page_content = $request->page_content;
            $data->save();

            return redirect()->route('dynamic.index')->with('t-success', 'Created Successfully !!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!' . $e->getMessage());
        }
    }



    public function edit($id)
    {
        $data = DynamicPage::findOrFail($id);
        return view('backend.layouts.dynamic.edit', compact('data'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_title' => 'required|string|max:1000',
                'page_content' => 'required|string|max:50000',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = DynamicPage::findOrFail($id);
            $data->page_title = $request->page_title;
            $data->page_content = $request->page_content;
            $data->save();

            return redirect()->route('dynamic.index')->with('t-success', 'Updated Successfully.');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with('t-error', 'Something went wrong!');
        }
    }

    /* dynamic Status start */
    public function status(int $id): JsonResponse
    {
        $data = DynamicPage::findOrFail($id);
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
    /* dynamic Status end */

    public function show($id)
    {
        $data = DynamicPage::findOrFail($id);
        return view('backend.layouts.dynamic.show', compact('data'));
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
            $data = DynamicPage::findOrFail($id);
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
