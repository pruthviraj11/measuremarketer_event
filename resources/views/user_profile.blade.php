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
                                    <h2 class="text-white text-family">Register Yourself / Company</h2>
                                </div>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="col-md-12 text-start mb-3">
                                        {{-- <h2 class="text-white text-register">Register As </h2> --}}
                                        <label for="register_as">
                                            <h3 class="text-white text-register form-label">Register
                                                As</h3>
                                        </label></br>
                                        <div class="form-check d-inline form_inline">
                                            <input class="form-check-input radio_form" type="radio"
                                                name="registration_type" id="company_registration" value="company"
                                                @if ($user->form_type == 'company' || $user->form_type == '') checked @endif
                                                @if ($user->form_type == 'individual') disabled @endif>
                                            <label class="form-check-label form_type custom-font-size"
                                                for="company_registration">Company
                                            </label>
                                        </div>
                                        <div class="form-check d-inline form_inline">
                                            <input class="form-check-input radio_form" type="radio"
                                                name="registration_type" id="individual_registration" value="individual"
                                                @if ($user->form_type == 'individual') checked @endif
                                                @if ($user->form_type == 'company') disabled @endif>
                                            <label class="form-check-label form_type custom-font-size"
                                                for="individual_registration">Individual
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" name="form_type" id="form_type"
                                        value="{{ $user->form_type }}" />


                                    @php
                                        $companyDisplay = in_array($user->form_type, ['company', ''])
                                            ? 'block'
                                            : 'none';
                                        $individualDisplay = $user->form_type == 'individual' ? 'block' : 'none';
                                    @endphp

                                    @if ($user->form_type == 'company' || $user->form_type == '')
                                        <div class="company_info" style="display:{{ $companyDisplay }}">
                                            <!-------  Company Div ------->
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="company_name" class="form-label">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control"
                                                        id="company_name"
                                                        value="{{ old('company_name', $user->company_name) }}">
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6 mb-3">
                                                    <label for="profile_image" class="form-label">
                                                        Profile Picture</label>
                                                    <input type="file" name="profile_image" class="form-control"
                                                        id="profile_image">

                                                    @php
                                                        $profileImagePath = $user->profile_image;
                                                    @endphp

                                                    @if ($user->profile_image && file_exists(public_path($user->profile_image)))
                                                        <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                                            class=" mt-2 rounded-circle" width="100" height="100">
                                                    @else
                                                        <img src="{{ asset('images/no_image_found.png') }}"
                                                            alt="No Image Found"
                                                            class="img-thumbnail mt-2 rounded-circle" width="120">
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-3">

                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="contact_person" class="form-label">Contact
                                                                Name</label>
                                                            <input type="text" name="contact_person"
                                                                class="form-control" id="contact_person"
                                                                value="{{ old('contact_person', $user->contact_person) }}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="total_experience"
                                                                class="form-label">Experience</label>
                                                            <input type="text" name="total_experience"
                                                                class="form-control" id="total_experience"
                                                                value="{{ old('total_experience', $user->total_experience) }}">
                                                        </div>

                                                    </div>



                                                </div>

                                            </div>

                                            <div class="row">





                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email
                                                    </label>
                                                    <input class="" type="checkbox" value="1"
                                                        {{ $user->email_check == '1' ? 'checked' : '' }}
                                                        id="email_check" name="email_check">

                                                    <label for="email" class="form-label ml-1">(Display to
                                                        Other Attendees)
                                                    </label>

                                                    <input type="email" name="email" class="form-control"
                                                        id="email" value="{{ old('email', $user->email) }}"
                                                        placeholder="Email Address">
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input class="" type="checkbox" value="1"
                                                        {{ $user->phone_check == '1' ? 'checked' : '' }}
                                                        id="phone_check" name="phone_check">


                                                    <label for="email" class="form-label ml-1">(Display to
                                                        Other Attendees)
                                                    </label>
                                                    <input type="text" name="phone" class="form-control"
                                                        id="phone" value="{{ old('phone', $user->phone) }}"
                                                        placeholder="Phone Number">
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label for="designation" class="form-label">Designation</label>
                                                    <input type="text" name="designation" class="form-control"
                                                        id="designation"
                                                        value="{{ old('designation', $user->designation) }}">
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label for="linkedin" class="form-label">Linkedin</label>
                                                    <input type="text" name="linkedin" class="form-control"
                                                        id="linkedin"
                                                        value="{{ old('linkedin', $user->linkedin) }}">
                                                </div>


                                                <div class="col-md-12 mb-3">
                                                    <label for="address" class="form-label">Location</label>
                                                    <input type="text" name="address" class="form-control"
                                                        id="address" value="{{ old('address', $user->address) }}">
                                                </div>
                                            </div>





                                            <!-------End Company Div ------->
                                        </div>
                                    @endif
                                    @if ($user->form_type == 'individual' || $user->form_type == '')
                                        <!----  Indivudual Section ----->

                                        <div class="individual_info" style="display:{{ $individualDisplay }}">

                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" name="individual_full_name"
                                                        class="form-control" id="full_name"
                                                        value="{{ old('full_name', $user->full_name) }}">
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="" type="checkbox" value="1"
                                                        id="individual_email_check" name="individual_email_check"
                                                        {{ $user->email_check == '1' ? 'checked' : '' }}>

                                                    <label for="email" class="form-label ml-1">(Display to
                                                        Other Attendees)
                                                    </label>

                                                    <input type="email" name="individual_email"
                                                        class="form-control" id="email"
                                                        value="{{ old('individual_email', $user->email) }}"
                                                        placeholder="Email Address">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>

                                                    <input class="" type="checkbox" value="1"
                                                        id="individual_phone_check" name="individual_phone_check"
                                                        {{ $user->phone_check == '1' ? 'checked' : '' }}>

                                                    <label for="email" class="form-label ml-1">(Display to
                                                        Other Attendees)
                                                    </label>

                                                    <input type="text" name="individual_phone"
                                                        class="form-control" id="phone"
                                                        value="{{ old('phone', $user->phone) }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="linkedin" class="form-label">Linkedin</label>
                                                    <input type="text" name="individual_linkedin"
                                                        class="form-control" id="linkedin"
                                                        value="{{ old('linkedin', $user->linkedin) }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="company_name" class="form-label">Company</label>
                                                    <input type="text" name="individual_company_name"
                                                        class="form-control" id="company_name"
                                                        value="{{ old('company_name', $user->company_name) }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="designation" class="form-label">Current
                                                        Designation</label>
                                                    <input type="text" name="individual_designation"
                                                        class="form-control" id="designation"
                                                        value="{{ old('designation', $user->designation) }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="total_experience"
                                                        class="form-label">Experience</label>
                                                    <input type="text" name="individual_total_experience"
                                                        class="form-control" id="total_experience"
                                                        value="{{ old('total_experience', $user->total_experience) }}">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="address" class="form-label">Your Location</label>
                                                    <input type="text" name="individual_address"
                                                        class="form-control" id="address"
                                                        value="{{ old('address', $user->address) }}">
                                                </div>



                                                <div class="col-md-12 mb-3">
                                                    <label for="bio" class="form-label">Bio</label>
                                                    <textarea name="individual_bio" class="form-control" id="bio">{{ old('full_name', $user->bio) }}</textarea>

                                                </div>



                                            </div>


                                            <!----  Indivudual Section ----->
                                        </div>
                                    @endif

                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <label class="text-white" for="category">Categories to choose
                                                from:
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
                                            <label class="text-white" for="category">Interested in:
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
                                </form>

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
