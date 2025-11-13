@extends('backend.app')

@section('title', 'Map Settings')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Map Settings</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Map Settings</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('map.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-4">
                            <label for="mail_host" class="col-md-3 form-label">MAP KEY</label>
                            <div class="col-md-9">
                                <input class="form-control @error('MAP_KEY') is-invalid @enderror" id="MAP_KEY"
                                    name="MAP_KEY" placeholder="Enter your GOOGLE MAPS API KEY" type="text"
                                    value="{{ env('GOOGLE_MAPS_API_KEY') }}">
                                @error('MAP_KEY')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
