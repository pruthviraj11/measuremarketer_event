@include('header')

<div class="slider_area">
    <div class="single_slider mt-199 slider_bg_1 overlay">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row justify-content-center w-100">
                <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
                    <div class="slider_text text-left">
                        <center><span class="">Password reset</span></center>
                    </div>

                    <!-- Success and Error Messages -->
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

                    <!-- Form -->
                    <div class="d-flex justify-content-center align-items-center">
                        <form action="{{ route('users_reset_password') }}" method="POST" enctype="multipart/form-data"
                            class="registration-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label class="text-white" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter your email." required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12 form-group text-center">
                                    <button type="submit" class="button boxed-btn">Send Email</button>
                                </div>

                                <div class="col-md-12 text-center">
                                    <a href="{{ route('index') }}" class="text-white">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
