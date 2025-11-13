<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AddUserController extends Controller
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
            $data = \App\Models\User::where('email', '!=', 'iqu@iqu.com')->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('avatar', function ($data) {
                    $avatar = $data->avatar ? asset($data->avatar) : asset('frontend/no-image.jpg');
                    return '<img src="' . $avatar . '" width="60" alt="Article Image"/>';
                })
                ->addColumn('name', function ($data) {
                    $name = $data->name ?? 'N/A';
                    return $name;
                })
                ->addColumn('email', function ($data) {
                    $email = $data->email ?? 'N/A';
                    return $email;
                })
                ->addColumn('is_premium', function ($data) {
                    $is_premium = $data->is_premium ? '<span style="color: #fff; border-radius: 5px; padding: 5px; background-color: #008B8B">Yes</span>' : '<span style="color: #fff; border-radius: 5px; padding: 5px; background-color: #E1712B">No</span>';
                    return $is_premium;
                })
                ->addColumn('role', function ($data) {
                    $role = $data->role ?? 'N/A';
                    $color = $role == 'admin' ? '#E1712B' : '#008B8B';
                    return '<span style="color: #fff; border-radius: 5px; padding: 5px; background-color:' . $color . '">' . $role . '</span>';
                })

                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="' . route('users.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                 <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                //is_premiums custom filter
                ->filterColumn('is_premium', function ($query, $keyword) {
                    if (strtolower($keyword) === 'yes') {
                        $query->where('is_premium', 1);
                    } elseif (strtolower($keyword) === 'no') {
                        $query->where('is_premium', 0);
                    }
                })
                ->rawColumns(['name', 'email', 'avatar', 'is_premium', 'role', 'action'])
                ->make();
        }
        return view('backend.layouts.add-users.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.layouts.add-users.create');
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
                'name' => 'required|string|max:500',
                'email' => 'required|string|email|max:255|unique:users,email',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'role' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);
            // dd($validator->errors());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->avatar = $request->avatar;
            $data->role = $request->role;
            $data->password = bcrypt($request->password);

            if ($request->hasFile('avatar')) {
                $imagePath = Helper::fileUpload($request->file('avatar'), 'profile/avatar', time() . '_' . $request->file('avatar')->getClientOriginalName());
                if ($imagePath !== null) {
                    $data->avatar = $imagePath;
                }
            }

            $data->save();

            return redirect()->route('users.index')->with('t-success', 'Created Successfully !!');
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
        $data = User::findOrFail($id);
        return view('backend.layouts.add-users.edit', compact('data'));
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
            $data = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:500',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $data->id,
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'role' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data->name = $request->name;
            $data->email = $request->email;
            $data->role = $request->role;

            if ($request->hasFile('avatar')) {
                if ($data->avatar !== null) {
                    Helper::fileDelete(public_path($data->avatar));
                }
                $avatarPath = Helper::fileUpload($request->file('avatar'), 'profile/avatar', time() . '_' . $request->file('avatar')->getClientOriginalName());
                if ($avatarPath !== null) {
                    $data->avatar = $avatarPath;
                }
            }

            $data->save();

            return redirect()->route('users.index')->with('t-success', 'Updated Successfully !!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!' . $e->getMessage());
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
            $data = User::findOrFail($id);
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
