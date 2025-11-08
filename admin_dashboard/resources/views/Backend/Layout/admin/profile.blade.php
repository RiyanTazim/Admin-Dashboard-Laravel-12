@extends('Backend.master')

@section('title', 'My Profile')

<style>
    /* Active tab text color fix */
    .nav-tabs .nav-link.active {
        color: #47be23 !important; /* Change this to your theme's primary color */
        background-color: #fff !important;
        border-color: #dee2e6 #dee2e6 #fff;
        font-weight: 600;
    }

    /* Inactive tab text color */
    .nav-tabs .nav-link {
        color: #555 !important;
    }

    /* Hover state for better UX */
    .nav-tabs .nav-link:hover {
        color: #1b94b9 !important;
    }
</style>
@section('content')
    <!--app-content open-->
    @php
        $defaultAvatar = asset('images/users/default-user.png');
        $avatarPath =
            Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar))
                ? asset(Auth::user()->avatar)
                : $defaultAvatar;
    @endphp
    <div class="app-content content">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="profile-img-main rounded-circle overflow-hidden">
                                                <img src="{{ $avatarPath }}" alt="Profile Picture" width="120"
                                                    height="120" class="img-fluid">
                                            </div>
                                            <div class="ms-4">
                                                <h4 class="mb-1">{{ Auth::user()->name ?? 'N/A' }}</h4>
                                                <p class="text-muted mb-2">{{ Auth::user()->email ?? 'N/A' }}</p>
                                                <button class="btn btn-primary btn-sm" id="uploadImageBtn">
                                                    <i class="fa fa-edit me-2"></i>Update Profile
                                                </button>
                                                <input type="file" name="avatar" id="profile_picture_input" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link {{ session('type') ? (session('type') == 'profile' ? 'active' : '') : 'active' }}" style="text-decoration: primary"
                                            data-bs-toggle="tab" href="#editProfile">Edit Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ session('type') ? (session('type') == 'password' ? 'active' : '') : '' }}"
                                            data-bs-toggle="tab" href="#updatePassword">Update Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content mt-4">
                            <div class="tab-pane fade {{ session('type') ? (session('type') == 'profile' ? 'show active' : '') : 'show active' }}"
                                id="editProfile">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('admin.updateProfile') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">User Name</label>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" id="username" value="{{ Auth::user()->username }}"
                                                    placeholder="Enter your username">
                                                <div style="display: none" id="usernameexists" class="text-danger">
                                                    <i>username</i> Already exists
                                                </div>
                                                @error('username')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" value="{{ Auth::user()->name }}"
                                                    placeholder="Enter your name">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="firstname" value="{{ Auth::user()->email }}"
                                                    placeholder="Enter your email">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade {{ session('type') ? (session('type') == 'password' ? 'show active' : '') : '' }}"
                                id="updatePassword">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('admin.updatePassword') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="old_password" class="form-label">Current Password</label>
                                                <input type="password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    name="old_password" id="old_password"
                                                    placeholder="Enter current password">
                                                @error('old_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row justify-content-center align-items-center g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="password" class="form-label">New Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="password" placeholder="Enter new password">
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="password_confirmation" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" id="password_confirmation"
                                                        placeholder="Confirm new password">
                                                    @error('password_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#uploadImageBtn').click(function() {
                $('#profile_picture_input').click();
            });

            $('#profile_picture_input').change(function() {
                let formData = new FormData();
                formData.append('avatar', $(this)[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('admin.updateProfilePicture') }}", // ✅ make sure the route name matches!
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('.profile-img-main img').attr('src', response.image_url + '?v=' +
                                new Date().getTime());
                            new Notyf().success('Profile picture updated successfully.');
                        } else {
                            new Notyf().error(response.message);
                        }
                    },
                    error: function() {
                        new Notyf().error('An error occurred while uploading.');
                    }
                });
            });
        });
    </script>
@endpush
