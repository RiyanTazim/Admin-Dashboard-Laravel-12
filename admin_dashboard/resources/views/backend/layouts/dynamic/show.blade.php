@extends('backend.app')

@section('title', 'Dynamic page Details')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dynamic Page Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dynamic Page Details</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-lg border-0 rounded-3">
                {{-- Products Content --}}
                <div class="card-body p-4">
                    {{-- Details --}}
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title mb-3" style="font-size: 1.5rem; font-weight: bold;">Page Title</h3>
                            <hr class="my-2">
                            <p class="card-text" style="font-size: 1rem;">{{ $data->page_title ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="card-title mb-3" >Page Content</h3>
                            <hr class="my-2">
                            <p class="card-text" style="font-size: 1rem;">{!! $data->page_content ?? 'N/A' !!}</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <h3 class="card-title mb-3" style="font-size: 1rem; font-weight: bold;">Status</h3>
                            <p class="card-text">
                                @if ($data->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Back Button --}}
                    <div class="text-end">
                        <a href="{{ route('dynamic.index') }}" class="btn btn-primary px-4">
                            ← Back to Dynamic Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
