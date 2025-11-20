@extends('backend.app')

@section('title', 'Google Login Settings')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Google Login Settings</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Google Login Settings</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('credentials.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="paypal_sandbox_client_id" value="{{ env('PAYPAL_SANDBOX_CLIENT_ID') }}">
                        <input type="hidden" name="paypal_sandbox_client_secret" value="{{ env('PAYPAL_SANDBOX_CLIENT_SECRET') }}">
                        <input type="hidden" name="stripe_key" value="{{ env('STRIPE_KEY') }}">
                        <input type="hidden" name="stripe_secret" value="{{ env('STRIPE_SECRET') }}">

                        <div class="row mb-4">
                            <label for="mail_host" class="col-md-3 form-label">GOOGLE CLIENT ID</label>
                            <div class="col-md-9">
                                <input class="form-control @error('google_client_id') is-invalid @enderror" id="google_client_id"
                                       name="google_client_id" placeholder="Enter your GOOGLE CLIENT KEY" type="text"
                                       value="{{ env('GOOGLE_CLIENT_ID') }}">
                                @error('google_client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="mail_password" class="col-md-3 form-label">GOOGLE SECRET ID</label>
                            <div class="col-md-9">
                                <input class="form-control @error('google_client_secret_id') is-invalid @enderror" id="google_client_secret_id"
                                       name="google_client_secret_id" placeholder="Enter your GOOGLE SECRET ID" type="text"
                                       value="{{ env('GOOGLE_CLIENT_SECRET_ID') }}">
                                @error('google_client_secret_id')
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
