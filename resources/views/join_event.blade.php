@include('header')

<div class="slider_area">
    <div class="single_slider mt-199 slider_bg_1 overlay">
        <div class="container">
            <div class="row ">
                <div class="col-xl-12">
                    <div class="slider_text text-left"> <!-- Changed to text-left -->
                        <div class="shape_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <img src="img/shape/shape_1.svg" alt="">
                        </div>
                        <div class="shape_2 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".2s">
                            <img src="img/shape/shape_2.svg" alt="">
                        </div>
                        <center><span class="">Registration</span></center>
                    </div>
                </div>
                <div class="mt-3">
                    <form>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="company_name">Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name"
                                    placeholder="Enter your Company Name Name." required>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="contact_person">Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" id="contact_person"
                                    placeholder="Enter your contact Person Name." required>
                            </div>
                           
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter your email." required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="address-1">Address</label>
                                <input type="address" class="form-control" name="Locality" id="address-1"
                                    placeholder="Locality/House/Street no." required>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="Date">Date Of Birth</label>
                                <input type="Date" name="dob" class="form-control" id="Date" placeholder=""
                                    required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="sex">Gender</label>
                                <select id="sex" class="form-control browser-default custom-select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="unspesified">Unspecified</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="tel">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="tel"
                                    placeholder="Enter Your Contact Number." required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="pass">Password</label>
                                <input type="Password" name="password" class="form-control" id="pass"
                                    placeholder="Enter your password." required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="pass2">Confirm Password</label>
                                <input type="Password" name="cnf-password" class="form-control" id="pass2"
                                    placeholder="Re-enter your password." required>
                            </div>
                            <div class="col-md-12 form-group mt-5 text-center">
                                <button type="submit" class="button boxed-btn">Registration</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

@include('footer')
