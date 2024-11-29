@include('header')

<div class="slider_area">
    <div class="single_slider mt-199 slider_bg_1 overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider_text text-left">
                        <center><span class="">Registration</span></center>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-1">
                    <form action="{{ route('event.register') }}" method="POST" enctype="multipart/form-data"
                        class="registration-form">
                        @csrf
                        <div class="row">

                            <!-- Personal Information -->
                            <div class="col-12 mt-4">
                                <h4 class="text-white">Personal Information</h4>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="company_name">Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name"
                                    placeholder="Enter your Company Name." required>
                                @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="contact_person">Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" id="contact_person"
                                    placeholder="Enter your contact Person Name." required>
                                @error('contact_person')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="address-1">Address</label>
                                <input type="text" class="form-control" name="address-1" id="address-1"
                                    placeholder="Locality/House/Street no." required>
                                @error('address-1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="tel">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="tel"
                                    placeholder="Enter Your Contact Number." required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="profile_image">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control" id="profile_image"
                                    accept="image/*">
                                @error('profile_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Personal Information -->

                            <!-- Login Information -->
                            <div class="col-12">
                                <h4 class="text-white">Login Information</h4>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter your email." required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="pass">Password</label>
                                <input type="password" name="password" class="form-control" id="pass"
                                    placeholder="Enter your password." required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="pass2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="pass2"
                                    placeholder="Re-enter your password." required>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Login Information -->

                            <div class="col-md-12 form-group text-center">
                                <button type="submit" class="button boxed-btn">Register</button>
                            </div>

                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
