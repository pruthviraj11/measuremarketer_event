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
                                <div class="text-center mb-3">
                                    <h1 class="text-white">Update Profile</h1>

                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="col-md-12 text-center mb-3">
                                        <h2 class="text-white">Register As </h2>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input radio_form" type="radio"
                                                name="registration_type" id="company_registration" value="company"
                                                @if ($user->form_type == 'company') checked @endif>
                                            <label class="form-check-label form_type" for="company_registration">Company
                                            </label>
                                        </div>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input radio_form" type="radio"
                                                name="registration_type" id="individual_registration" value="individual"
                                                @if ($user->form_type == 'individual') checked @endif>
                                            <label class="form-check-label form_type"
                                                for="individual_registration">Individual
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" name="form_type" value="{{ $user->form_type }}" />
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
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control" id="linkedin"
                                                value="{{ old('linkedin', $user->linkedin) }}" required>
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">Location</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                value="{{ old('address', $user->address) }}" required>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="designation" class="form-label">Designation
                                                Person</label>
                                            <input type="text" name="designation" class="form-control"
                                                id="designation" value="{{ old('designation', $user->designation) }}"
                                                required>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="total_experience" class="form-label">Marketing
                                                Experience</label>
                                            <input type="text" name="total_experience" class="form-control"
                                                id="total_experience"
                                                value="{{ old('total_experience', $user->total_experience) }}" required>
                                        </div>
                                    </div>


                                    @php
                                        $companyDisplay = $user->form_type == 'company' ? 'block' : 'none';
                                        $individualDisplay = $user->form_type == 'individual' ? 'block' : 'none';
                                    @endphp


                                    <div class="company_info" style="display:{{ $companyDisplay }}">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="contact_person" class="form-label">Contact
                                                    Person</label>
                                                <input type="text" name="contact_person" class="form-control"
                                                    id="contact_person"
                                                    value="{{ old('contact_person', $user->contact_person) }}"
                                                    required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="profile_image" class="form-label">Profile
                                                    Image</label>
                                                <input type="file" name="profile_image" class="form-control"
                                                    id="profile_image">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @php
                                                    $profileImagePath = $user->profile_image;
                                                @endphp

                                                @if ($user->profile_image && file_exists(public_path($user->profile_image)))
                                                    <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                                        class=" mt-2 rounded-circle" width="100" height="100">
                                                @else
                                                    <img src="{{ asset('images/no_image_found.png') }}"
                                                        alt="No Image Found" class="img-thumbnail mt-2 rounded-circle"
                                                        width="120">
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="individual_info" style="display:{{ $individualDisplay }}">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="full_name" class="form-label">Full Name</label>
                                                <input type="text" name="full_name" class="form-control"
                                                    id="full_name" value="{{ old('full_name', $user->full_name) }}"
                                                    required>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="bio" class="form-label">Bio</label>
                                                <textarea name="bio" class="form-control" id="bio">{{ old('full_name', $user->bio) }}</textarea>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <label class="text-white" for="category">Selected Categories:
                                            </label>
                                            <select class="form-control" name="category[]" id="category"
                                                multiple="multiple">
                                                <option value="">Select Category</option>
                                                @php
                                                    $eventCategories = $user->category
                                                        ? explode(',', $user->category)
                                                        : [];

                                                @endphp
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, $eventCategories) ? 'selected' : '' }}>
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label class="text-white" for="category">Selected Interests:
                                            </label>
                                            <select class="form-control" name="interests[]" id="interests"
                                                multiple="multiple">
                                                <option value="">Select Interests</option>

                                                @php
                                                    $eventInterests = $user->interest
                                                        ? explode(',', $user->interest)
                                                        : [];

                                                @endphp

                                                @foreach ($interests as $interest)
                                                    <option value="{{ $interest->id }}"
                                                        {{ in_array($interest->id, $eventInterests) ? 'selected' : '' }}>
                                                        {{ $interest->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="password">
                                        </div>


                                    </div>

                                    <button type="submit" class="btn btn-primary profile_update_btn">Update
                                        Profile</button>


                            </div>













                            {{-- <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary profile_update_btn">Update
                                Profile</button> --}}
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
