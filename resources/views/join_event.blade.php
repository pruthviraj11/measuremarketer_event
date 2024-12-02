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

                            <!-- Personal Information -->
                            <div class="col-12 mt-4">
                                <h4 class="text-white">Personal Information</h4>
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="company_name">Company Name</label> --}}
                                <input type="text" class="form-control" name="company_name" id="company_name"
                                    placeholder="Enter your Company Name." value="{{ old('company_name') }}" required>
                                @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="contact_person">Contact Person</label> --}}
                                <input type="text" class="form-control" name="contact_person" id="contact_person"
                                    placeholder="Enter your contact Person Name." value="{{ old('contact_person') }}"
                                    required>
                                @error('contact_person')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="address-1">Address</label> --}}
                                <input type="text" class="form-control" name="address-1" id="address-1"
                                    placeholder="Locality/House/Street no." value="{{ old('address-1') }}" required>
                                @error('address-1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="tel">Phone</label> --}}
                                <input type="tel" name="phone" class="form-control" id="tel"
                                    placeholder="Enter Your Contact Number." value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="profile_image">Profile Image</label> --}}
                                <input type="file" name="profile_image" class="form-control" id="profile_image"
                                    accept="image/*">
                                @error('profile_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="tel">Phone</label> --}}
                                <input type="text" name="designation" class="form-control" id="designation"
                                    placeholder="Designation." value="{{ old('designation') }}" required>
                                @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="tel">Phone</label> --}}
                                <input type="text" name="linkedin" class="form-control" id="linkedin"
                                    placeholder="Linkedin." value="{{ old('linkedin') }}" required>
                                @error('linkedin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="tel">Phone</label> --}}
                                <input type="text" name="total_experience" class="form-control" id="total_experience"
                                    placeholder="Total Experience in Marketing." value="{{ old('total_experience') }}"
                                    required>
                                @error('total_experience')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 form-group">
                                {{-- <label class="text-white" for="tel">Phone</label> --}}
                                <textarea name="bio" class="form-control" placeholder="Bio." required></textarea>
                                @error('bio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-sm-12 form-group">
                                <label class="text-white" for="category">Categories to Choose From: </label>

                                <select class="form-control" name="category[]" id="category" multiple="multiple">
                                    <option value="">Select Category</option>
                                    <option value="Performance Marketing">Performance Marketing</option>
                                    <option value="Conversion Rate Optimization (CRO)">Conversion Rate Optimization
                                        (CRO)</option>
                                    <option value="Pay-per-click (PPC) - Google/Meta/Others">Pay-per-click (PPC) -
                                        Google/Meta/Others</option>
                                    <option value="Search Engine Optimization">Search Engine Optimization</option>
                                    <option value="Social Media Marketing.">Social Media Marketing</option>
                                    <option value="Influencer Marketing">Influencer Marketing</option>
                                    <option value="Marketing Analytics">Marketing Analytics</option>
                                    <option value="Affiliate Marketing">Affiliate Marketing</option>
                                    <option value="Content Marketing">Content Marketing</option>
                                    <option value="Email Marketing">Email Marketing</option>
                                    <option value="Graphic Creators for Marketing">Graphic Creators for Marketing
                                    </option>
                                    <option value="Video Creators for Marketing">Video Creators for Marketing</option>
                                    <option value="Others">Others</option>
                                </select>
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-sm-12 form-group">
                                <label class="text-white" for="category">Interested in: </label>

                                <select class="form-control" name="interests[]" id="interests" multiple="multiple">
                                    <option value="">Select Interests</option>
                                    <option value="Networking">Networking</option>
                                    <option value="Career Opportunity">Career Opportunity</option>
                                    <option value="Upskilling">Upskilling</option>
                                    <option value="New Market Trends">New Market Trends</option>
                                    <option value="Mentorship Opportunities">Mentorship Opportunities</option>
                                    <option value="Startup Consulting">Startup Consulting</option>
                                    <option value="Investment in Marketing Startups">Investment in Marketing Startups
                                    </option>

                                </select>
                                @error('interests')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>












                            <div class="col-sm-12 form-group">

                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_checked"
                                        id="is_checked" value="1" checked>
                                    <label class="form-check-label" for="is_checked">Lorem Ipsum is simply dummy text
                                        of
                                        the printing and typesetting industry. </label>
                                </div>
                            </div>


                            <!-- End Personal Information -->

                            <!-- Login Information -->
                            <div class="col-12">
                                <h4 class="text-white">Login Information</h4>
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="email">Email</label> --}}
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter your email." value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="pass">Password</label> --}}
                                <input type="password" name="password" class="form-control form_passsword"
                                    id="pass" placeholder="Enter your password." value="{{ old('password') }}"
                                    required>

                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    data-target="#pass">
                                    <i class="fas fa-eye"></i>
                                </button>


                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                {{-- <label class="text-white" for="pass2">Confirm Password</label> --}}
                                <input type="password" name="password_confirmation"
                                    class="form-control form_passsword" id="pass2"
                                    placeholder="Re-enter your password." value="{{ old('password_confirmation') }}"
                                    required>

                                <button type="button" class="btn btn-outline-secondary confirm-toggle-password"
                                    data-target="#pass2">
                                    <i class="fas fa-eye"></i>
                                </button>


                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Login Information -->

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
