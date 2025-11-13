@extends('backend.app')

@section('title', 'Edit Social Media')

@push('style')
@endpush

@section('content')

    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Social Media</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form action="{{ route('social.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                        {{-- url --}}
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                                <input type="text" name="url" id="url" class="form-control"
                                value="{{ old('url', $data->url) }}" placeholder="Enter url">
                            @error('url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control dropify" type="file" name="image"
                                @isset($data->image)
                                                data-default-file="{{ asset($data->image) }}"
                                    @endisset>
                            @error('image')
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
