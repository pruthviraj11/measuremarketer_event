@include('header')

<div class="slider_area">
    <div class="single_slider mt-199 slider_bg_1 overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider_text text-left">
                        <center><span class="">Login</span></center>
                    </div>
                </div>
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mt-1">
                    <form action="{{ route('users_login') }}" method="POST" enctype="multipart/form-data" class="login-form">
                        @csrf
                        <div class="row">
                            <!-- Login Information -->
                            <div class="col-12">
                                <h4 class="text-white">Login</h4>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-white" for="pass">Password</label>
                                <input type="password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Login Information -->

                            <div class="col-md-12 form-group text-center">
                                <button type="submit" class="button boxed-btn">Login</button>
                            </div>

                            <!-- Login Link -->
                            <div class="col-md-12 text-center mt-3">
                                <p class="text-white">Don't have an account? <a href="{{ route('join_event') }}" class="btn btn-link p-0 text-danger"><b>Register</b></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
