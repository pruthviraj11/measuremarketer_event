@extends('layouts/contentLayoutMaster')

@section('title', 'View profile')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
@endsection

@section('content')



    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Profile</h4>


                        {{-- <h4 class="card-title">{{$page_data['form_title']}}</h4> --}}
                    </div>
                    <div class="card-body">

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Type</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ ucfirst($registeredUser->form_type) }}</div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Company Name</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->company_name }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Email</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->email }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Phone</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->phone }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Linkedin</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->linkedin }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Location</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->address }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Designation</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->designation }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Marketing Experience</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $registeredUser->total_experience }} Years</div>
                        </div>

                        @if ($registeredUser->form_type == 'company')

                            <div class="row mb-1">
                                <div class="col-md-2"><strong>Contact Person</strong></div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-9">{{ $registeredUser->contact_person }}</div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-md-2"><strong>Profile Image</strong></div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-9">

                                    @php
                                        $profileImagePath = $registeredUser->profile_image;
                                    @endphp

                                    @if ($registeredUser->profile_image && file_exists(public_path($registeredUser->profile_image)))
                                        <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                            class="rounded-circle" width="100" height="100">
                                    @else
                                        <img src="{{ asset('images/no_image_found.png') }}" alt="No Image Found"
                                            class="img-thumbnail mt-2 rounded-circle" width="110">
                                    @endif


                                </div>
                            </div>
                        @else
                            <div class="row mb-1">
                                <div class="col-md-2"><strong>Full Name</strong></div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-9">{{ $registeredUser->full_name }}</div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-md-2"><strong>Bio</strong></div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-9">{{ $registeredUser->bio }}</div>
                            </div>

                        @endif

                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Selected Categories</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $categoryName }}</div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-md-2"><strong>Selected Interests</strong></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-9">{{ $interestName }}</div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
    <script>
        // Function to generate a random password
        function generateRandomPassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            let password = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset.charAt(randomIndex);
            }
            return password;
        }

        $(document).ready(function() {
            // Generate password when the button is clicked
            $("#generatePassword").click(function() {
                const generatedPassword = generateRandomPassword(
                    10); // You can adjust the length of the password here
                $("#password").val(generatedPassword);
                $("#password").select();
                document.execCommand("copy");
                alert("Password copied to clipboard!");
            });
        });
    </script>
@endsection
