@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area">
                        <div class="row">
                            @include('sidebar_welcome')
                            <div class="col-md-9">
                                <h1 class="text-white">Update Profile</h1>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="company_name" class="form-label">Company Name</label>
                                            <input type="text" name="company_name" class="form-control"
                                                id="company_name" value="{{ old('company_name', $user->company_name) }}"
                                                required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                value="{{ old('phone', $user->phone) }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="contact_person" class="form-label">Contact Person</label>
                                            <input type="text" name="contact_person" class="form-control"
                                                id="contact_person"
                                                value="{{ old('contact_person', $user->contact_person) }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input type="file" name="profile_image" class="form-control"
                                                id="profile_image">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            @if ($user->profile_image)
                                                <img src="{{ asset($user->profile_image) }}" alt="Profile Image"
                                                    class="img-thumbnail mt-2" width="150">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary profile_update_btn">Update
                                        Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <script>
        window.location.href = "{{ route('users_login') }}"; // Redirect to login route
    </script>
@endif

@include('footer')
