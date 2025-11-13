@extends('backend.app')

@section('title', 'Products Details')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Products Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products Details</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-lg border-0 rounded-3">
                {{-- Products Image --}}
                <div class="mt-4">
                    @if ($data->image)
                        <img src="{{ asset($data->image) ?? 'N/A' }}" alt="{{ $data->title ?? 'N/A' }}"
                            class="card-img-top rounded-top"
                            style="max-width: 300px; width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                    @endif
                </div>

                {{-- Products Content --}}
                <div class="card-body p-4">
                    {{-- Name --}}
                    <h1 class="card-title mb-3" style="font-size: 2rem; font-weight: bold;">
                        {{ $data->name ?? 'N/A' }}
                    </h1>

                    {{-- Author & Meta --}}
                    <div class="d-flex align-items-center mb-4 text-muted" style="font-size: 0.9rem;">
                        <div class="me-3">
                            <i class="fe fe-user"></i>
                            Product Created By Admin
                        </div>
                        <div class="me-3">
                            <i class="fe fe-calendar"></i>
                            {{ !is_null($data->created_at) ? $data->created_at->format('d M Y') : 'N/A' }}
                        </div>
                        <div>
                            <i class="fe fe-tag"></i>
                            @if ($data->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <h4 class="card-text">
                            <span style="font-weight: bold;">Price:</span> {{ $data->price ?? 'N/A' }}
                        </h4>

                        <h4 class="card-text">
                            <span style="font-weight: bold;">Discount Price:</span>
                            <span class="ms-2">{{ $data->discount_price ?? 'N/A' }}</span>
                        </h4>

                        <h4 class="card-text">
                            <span style="font-weight: bold;">Stock Quantity:</span>
                            <span class="ms-2">{{ $data->stock_quantity ?? 'N/A' }}</span>
                        </h4>
                    </div>
                    {{-- Description --}}
                    <div class="card-text" style="line-height: 1.7; font-size: 1.05rem; color: #333;">
                        <span style="font-weight: bold;">Description:</span>
                        {!! $data->description ?? 'N/A' !!}
                    </div>

                    <hr class="my-4">

                    {{-- Back Button --}}
                    <div class="text-end">
                        <a href="{{ route('product.index') }}" class="btn btn-primary px-4">
                            ← Back to Products List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
