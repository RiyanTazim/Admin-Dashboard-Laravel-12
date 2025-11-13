@extends('backend.app')

@section('title', 'Valet Details')

@push('styles')

@endpush

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Valet Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Valets</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Valet Name</label>
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror" disabled >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Shop -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Valet Email</label>
                                <input type="text" name="email" value="{{ $data->email }}" class="form-control @error('email') is-invalid @enderror" disabled >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Shop -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number">Number</label>
                                <input type="text" name="number" value="{{ $data->number }}" class="form-control @error('number') is-invalid @enderror" disabled >
                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Shop -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" value="{{ $data->country }}" class="form-control @error('country') is-invalid @enderror" disabled >
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meet_requirement"> Meet Requirement</label>
                                <select name="meet_requirement" id="meet_requirement" class="form-select" disabled readonly>
                                    <option value="0" {{ $data->valetProfile->meet_requirement == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $data->valetProfile->meet_requirement == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                                @error('meet_requirement')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paper_work"> Digital Signature </label>
                                <div class="">
                                    <img src="{{ asset($data->valetProfile->paper_work) }}" alt="" style="height: 100px; width: auto;">
                                </div>
                                @error('paper_work')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meet_requirement"> Photo ID </label>
                                <div class="">
                                    @foreach($data->valetProfile->images as $images)
                                        <img src="{{ asset($images->image_path) }}" alt="" style="height: 200px; width: auto; margin: 10px;">
                                    @endforeach
                                </div>
                                @error('meet_requirement')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush
