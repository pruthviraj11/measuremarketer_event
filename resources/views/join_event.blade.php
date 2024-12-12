@include('header')

<div class="slider_area">
    <div class="single_slider mt-199 slider_bg_1 overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    {{-- <div class="slider_text text-left">
                        <center><span class="">Registration</span></center>
                    </div> --}}
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-1">
                    <form action="{{ route('event.register') }}" method="POST" enctype="multipart/form-data"
                        class="registration-form form-contact contact_form">
                        @csrf
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <h2 class="text-white">Register As </h2>
                                <div class="form-check">
                                    <input class="form-check-input radio_form" type="radio" name="registration_type"
                                        id="company_registration" value="company" checked>
                                    <label class="form-check-label form_type" for="company_registration">Company
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_form" type="radio" name="registration_type"
                                        id="individual_registration" value="individual">
                                    <label class="form-check-label form_type" for="individual_registration">Individual
                                    </label>
                                </div>
                            </div>




                            <!-- Personal Information -->
                            <div class="col-md-12 mt-4">
                                {{-- <h4 class="text-white">Personal Information</h4> --}}
                            </div>

                            <!----  Company Radio Select ----->

                            <div class="row company_info">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name"
                                        value="{{ old('company_name') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="profile_image" class="form-label">
                                        Profile Picture</label>
                                    <input type="file" name="profile_image" class="form-control" id="profile_image">
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="total_experience" class="form-label">Experience</label>
                                    <input type="text" name="total_experience" class="form-control"
                                        id="total_experience" value="{{ old('total_experience') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="contact_person" class="form-label">Contact
                                        Name</label>
                                    <input type="text" name="contact_person" class="form-control" id="contact_person"
                                        value="{{ old('contact_person') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email
                                    </label>
                                    <input class="" type="checkbox" value="1" id="email_check"
                                        name="email_check">

                                    <label for="email" class="form-label ml-1">(Display to
                                        Other Attendees)
                                    </label>

                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}" placeholder="Email Address">
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="" type="checkbox" value="1" id="phone_check"
                                        name="phone_check">


                                    <label for="email" class="form-label ml-1">(Display to
                                        Other Attendees)
                                    </label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        value="{{ old('phone') }}" placeholder="Phone Number">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control" id="designation"
                                        value="{{ old('designation') }}">
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label">Linkedin</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin"
                                        value="{{ old('linkedin') }}">
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Your Location</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        value="{{ old('address') }}">
                                </div>
                            </div>

                            <!---- End Company Radio Select ---->



                            <!----  Individual Radio select ----->

                            <div class="individual_info" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" name="individual_full_name" class="form-control"
                                            id="full_name" value="{{ old('full_name') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="" type="checkbox" value="1"
                                            id="individual_email_check" name="individual_email_check">

                                        <label for="email" class="form-label ml-1">(Display to
                                            Other Attendees)
                                        </label>

                                        <input type="email" name="individual_email" class="form-control"
                                            id="email" value="{{ old('individual_email') }}"
                                            placeholder="Email Address">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>

                                        <input class="" type="checkbox" value="1"
                                            id="individual_phone_check" name="individual_phone_check">

                                        <label for="email" class="form-label ml-1">(Display to
                                            Other Attendees)
                                        </label>

                                        <input type="text" name="individual_phone" class="form-control"
                                            id="phone" value="{{ old('phone') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="linkedin" class="form-label">Linkedin</label>
                                        <input type="text" name="individual_linkedin" class="form-control"
                                            id="linkedin" value="{{ old('linkedin') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="company_name" class="form-label">Company</label>
                                        <input type="text" name="individual_company_name" class="form-control"
                                            id="company_name" value="{{ old('company_name') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="designation" class="form-label">Current
                                            Designation</label>
                                        <input type="text" name="individual_designation" class="form-control"
                                            id="designation" value="{{ old('designation') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="total_experience" class="form-label">Experience</label>
                                        <input type="text" name="individual_total_experience" class="form-control"
                                            id="total_experience" value="{{ old('total_experience') }}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="address" class="form-label">Your Location</label>
                                        <input type="text" name="individual_address" class="form-control"
                                            id="address" value="{{ old('address') }}">
                                    </div>



                                    <div class="col-md-12 mb-5">
                                        <label for="bio" class="form-label">Company information</label>
                                        <textarea name="individual_bio" class="form-control" id="bio">{{ old('full_name') }}</textarea>

                                    </div>
                                </div>
                            </div>
                            <!-----  End Individual Radio Select --->

                            <div class="col-md-12 form-group p-0">
                                <label class="text-white" for="category">Categories to Choose From: </label>

                                <select class="form-control" name="category[]" id="category" multiple="multiple">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-12 form-group p-0">
                                <label class="text-white" for="category">Interested in: </label>

                                <select class="form-control" name="interests[]" id="interests" multiple="multiple">
                                    <option value="">Select Interests</option>

                                    @foreach ($interests as $interest)
                                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                    @endforeach

                                </select>
                                @error('interests')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <!----  Enter Individual Form Fields  --->










                        {{-- <div class="col-sm-12 form-group">

                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" name="is_checked" id="is_checked"
                                    value="1" checked>
                                <label class="form-check-label" for="is_checked">Lorem Ipsum is simply dummy text
                                    of
                                    the printing and typesetting industry. </label>
                            </div>
                        </div> --}}


                        <!-- Login Information -->
                        <div class="row g-0">
                            <div class="col-md-12 pl-0">
                                <h4 class="text-white">Login Information</h4>
                            </div>

                            <div class="col-sm-6 form-group pl-0">
                                {{-- <label class="text-white" for="pass">Password</label> --}}
                                <input type="text" name="password" class="form-control form_passsword"
                                    id="pass" placeholder="Enter Username" value="{{ old('password') }}">

                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    data-target="#pass">
                                    <i class="fas fa-eye"></i>
                                </button>


                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group pr-0">
                                {{-- <label class="text-white" for="pass2">Confirm Password</label> --}}
                                <input type="password" name="password_confirmation"
                                    class="form-control form_passsword" id="pass2"
                                    placeholder="enter your password." value="{{ old('password_confirmation') }}">

                                <button type="button" class="btn btn-outline-secondary confirm-toggle-password"
                                    data-target="#pass2">
                                    <i class="fas fa-eye"></i>
                                </button>


                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Login Information -->
                        </div>

                        <div class="col-md-12 form-group text-center">
                            <button type="submit" class="button boxed-btn">Register
                                Now</button>
                        </div>


                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@include('footer')
