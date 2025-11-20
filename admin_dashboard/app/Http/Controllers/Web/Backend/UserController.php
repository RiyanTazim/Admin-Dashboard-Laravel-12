<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Web\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    /**
     * Display a listing of all users.
     *
     * @param Request $request
     * @return JsonResponse|View
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = User::where('role', 'user')
                ->whereNull('deleted_at')
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = $data->name;
                    return $name;
                })
                ->addColumn('avatar', function ($data) {
                    $defaultImage = asset('frontend/default-avatar-profile.jpg');
                    if ($data->avatar) {
                        $url = asset($data->avatar);
                    } else {
                        $url = $defaultImage;
                    }
                    return '<img src="' . $url . '" alt="Image" width="50px" height="50px">';
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
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name','avatar', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.user.index');
    }

    /**
     * Display a listing of all users.
     *
     * @param Request $request
     * @return JsonResponse|View
     */
    public function valet(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = User::where('role', 'valet')
                ->whereNull('deleted_at')
                ->whereHas('valetProfile', function ($query) {
                    $query->where('status', 'Approved'); // Only get users with valetProfile status 'Pending'
                })
                ->with('valetProfile') // Eager load valetProfile after filtering
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = $data->name;
                    return $name;
                })
                ->addColumn('avatar', function ($data) {
                    $defaultImage = asset('frontend/default-avatar-profile.jpg');
                    if ($data->avatar) {
                        $url = asset($data->avatar);
                    } else {
                        $url = $defaultImage;
                    }
                    return '<img src="' . $url . '" alt="Image" width="50px" height="50px">';
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
                                <a href="' . route('user.valet.details', $data->id) . '" type="button" class="btn btn-info fs-14 details-icn" title="Details">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name','avatar', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.user.valet-approved');
    }

    /**
     * Display a listing of all users.
     *
     * @param Request $request
     * @return JsonResponse|View
     */
    public function valetApproved(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = User::where('role', 'valet')
                ->whereNull('deleted_at')
                ->whereHas('valetProfile', function ($query) {
                    $query->where('status', 'Pending'); // Only get users with valetProfile status 'Pending'
                })
                ->with('valetProfile') // Eager load valetProfile after filtering
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('avatar', function ($data) {
                    $defaultImage = asset('frontend/default-avatar-profile.jpg');
                    $url = $data->avatar ? asset($data->avatar) : $defaultImage;
                    return '<img src="' . $url . '" alt="Avatar" width="50px" height="50px">';
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    return '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">
                            <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">
                            <span style="' . $sliderStyles . '"></span>
                            <label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>
                        </div>';
                })
                ->addColumn('approved', function ($data) {
                    $status = optional($data->valetProfile)->status ?? 'Pending';
                    $options = [
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                    ];

                    $selectHtml = '<select class="form-select valet-status-select" data-id="' . $data->id . '">';
                    foreach ($options as $key => $value) {
                        $selected = $status === $key ? 'selected' : '';
                        $selectHtml .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                    }
                    $selectHtml .= '</select>';

                    return $selectHtml;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="' . route('user.valet.details', $data->id) . '" type="button" class="btn btn-info fs-14 details-icn" title="Details">
                                    <i class="fe fe-eye"></i>
                                </a>
                            <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                <i class="fe fe-trash"></i>
                            </a>
                        </div>';
                })
                ->rawColumns(['name', 'avatar', 'status', 'approved', 'action']) // Ensure 'approved' is included
                ->make();
        }

        return view('backend.layouts.user.valet');
    }

    public function show($id): View
    {
        $data = User::find($id);
        return view('backend.layouts.user.details', compact('data'));
    }

    public function updateValetStatus(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:Pending,Approved,Rejected'
        ]);

        $user = User::find($request->user_id);

        if (!$user || !$user->valetProfile) {
            return response()->json(['success' => false, 'message' => 'User or valet profile not found.']);
        }

        $user->valetProfile->status = $request->status;
        $user->valetProfile->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }


    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = User::findOrFail($id);
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
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
