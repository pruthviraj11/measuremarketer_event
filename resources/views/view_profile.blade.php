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
                                <div class="text-center mt-5 mb-3">
                                    {{-- <h1 class="text-white text-family">My Profile</h1> --}}

                                    <div class="text-white text-family profile_button">
                                        <a href="{{ route('profile.edit') }}" class="text-header">Update
                                            Your Profile For Network
                                            Account</a>
                                    </div>

                                </div>




                            </div>













                            {{-- <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary profile_update_btn">Update
                                Profile</button> --}}

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
