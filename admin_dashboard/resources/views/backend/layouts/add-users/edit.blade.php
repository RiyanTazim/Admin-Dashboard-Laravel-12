@extends('backend.app')

@section('title', 'Edit User')

@push('style')
@endpush

@section('content')

    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit User Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form action="{{ route('users.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $data->name) }}" placeholder="Enter Product name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                value="{{ old('email', $data->email) }}" placeholder="Enter email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{--  role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Avatar --}}
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar(Profile Picture)</label>
                            <input class="form-control dropify" type="file" name="avatar"
                                @isset($data->avatar)
                                                data-default-file="{{ asset($data->avatar) }}"
                                    @endisset>
                            @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
