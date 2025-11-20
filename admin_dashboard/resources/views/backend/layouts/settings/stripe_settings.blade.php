@extends('backend.app')

@section('title', 'Stripe Settings')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Stripe Settings</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stripe Settings</li>
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

                        <div class="row mb-4">
                            <label for="stripe_key" class="col-md-3 form-label">STRIPE KEY (Publishable Key)</label>
                            <div class="col-md-9">
                                <input class="form-control @error('stripe_key') is-invalid @enderror" id="stripe_key"
                                    name="stripe_key" placeholder="Enter your STRIPE KEY" type="text"
                                    value="{{ env('STRIPE_KEY') }}">
                                @error('stripe_key')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="stripe_secret" class="col-md-3 form-label">STRIPE SECRET(Secret Key)</label>
                            <div class="col-md-9">
                                <input class="form-control @error('stripe_secret') is-invalid @enderror" id="stripe_secret"
                                    name="stripe_secret" placeholder="Enter your paypal client id" type="text"
                                    value="{{ env('STRIPE_SECRET') }}">
                                @error('stripe_secret')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Checkout Success URL --}}
                        {{-- <div class="row mb-4">
                            <label for="checkout_success_url" class="col-md-3 form-label">Checkout Success URL</label>
                            <div class="col-md-9">
                                <input class="form-control @error('checkout_success_url') is-invalid @enderror"
                                    id="checkout_success_url" name="checkout_success_url"
                                    placeholder="Enter your Checkout Success URL" type="text"
                                    value="{{ env('CHECKOUT_SUCCESS_URL') }}">
                                @error('checkout_success_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- Checkout cancel URL --}}
                        {{-- <div class="row mb-4">
                            <label for="checkout_cancel_url" class="col-md-3 form-label">Checkout Cancel URL</label>
                            <div class="col-md-9">
                                <input class="form-control @error('checkout_cancel_url') is-invalid @enderror"
                                    id="checkout_cancel_url" name="checkout_cancel_url"
                                    placeholder="Enter your Checkout Cancel URL" type="text"
                                    value="{{ env('CHECKOUT_CANCEL_URL') }}">
                                @error('checkout_cancel_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

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
