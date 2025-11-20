@extends('backend.app')

@section('title', 'Contact Us Message Details')

@section('content')
     {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Message Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Message Details</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="d-flex justify-content-center">
                    <div class="card-header">
                        <h3 class="card-title">Message Details</h3>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5><strong>Name:</strong> {{ $data->user->name ?? 'N/A' }}</h5>
                            <h5><strong>Email:</strong> {{ $data->user->email ?? 'N/A' }}</h5>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Message:</strong></p>
                            <p>{{ $data->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
