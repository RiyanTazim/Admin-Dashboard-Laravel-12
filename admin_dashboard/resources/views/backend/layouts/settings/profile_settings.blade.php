@extends('backend.app')

@section('title', 'Profile Settings')


@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile Settings</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="profile-img-main rounded"
                                    style="width: 125px; height: 125px; overflow: hidden;">
                                    <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('frontend/default-avatar-profile.jpg') }}"
                                        alt="Profile Picture" class="m-0 p-1"
                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                </div>
                                <div class="ms-4">
                                    <h4>{{ Auth::user()->name ?? 'N/A' }}</h4>
                                    <h4>{{ Auth::user()->email ?? 'N/A' }}</h4>
                                    <a href="#" class="btn btn-primary btn-sm" id="uploadImageBtn">
                                        <i class="fa fa-rss"></i> Update Profile
                                    </a>
                                    <input type="file" name="profile_picture" id="profile_picture_input"
                                        style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li><a href="#editProfile" class="active show" data-bs-toggle="tab">Edit Profile</a>
                                    </li>
                                    <li><a href="#updatePassword" data-bs-toggle="tab">Update Password</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active show" id="editProfile">
                    <div class="card">
                        <div class="card-body border-0">
                            <form class="form-horizontal" method="post" action="{{ route('update.profile') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row mb-4">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name" id="username"
                                            value="{{ Auth::user()->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="firstname" placeholder="Email"
                                            value="{{ Auth::user()->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="payment_email" class="form-label">Admin Paypal Payment Email:</label>
                                        <input type="text" class="form-control @error('payment_email') is-invalid @enderror"
                                            name="payment_email" id="payment_email" placeholder="Admin Paypal Payment Email"
                                            value="{{ Auth::user()->payment_email }}">
                                        @error('payment_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="updatePassword">
                    <div class="card">
                        <div class="card-body border-0">
                            <form class="form-horizontal" method="post" action="{{ route('update.Password') }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <div class="form-group">
                                        <label for="old_password" class="form-label">Current Password:</label>
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" placeholder="Current Password" id="old_password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">New Password:</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="New Password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle Image button click to trigger file input
            $('#uploadImageBtn').click(function(e) {
                e.preventDefault();
                $('#profile_picture_input').click();
            });

            // Handle file input change to upload the selected image
            $('#profile_picture_input').change(function() {
                var formData = new FormData();
                formData.append('profile_picture', $(this)[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('update.profile.picture') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Update the profile picture src in the profile settings page
                            $('.profile-img-main img').attr('src', response.image_url);

                            // Also update the profile picture in the header view page
                            $('.profile-img-change').attr('src', response.image_url);

                            toastr.success('Profile picture updated successfully.');
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred while updating the profile picture.');
                    }
                });
            });

            // Preview image before upload
            $('#profile_picture_input').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.profile-img-main img').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
