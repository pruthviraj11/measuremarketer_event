@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area text-white border-0">
                        {{-- <h1 class="text-center">Events</h1> --}}
                        <div class="row">
                            @include('sidebar_welcome')
                            <div class="col-md-9">
                                <center class="mb-4">
                                    {{-- <h6>My Account</h6> --}}
                                </center>
                                <!-- DataTable for Registered Events -->
                                <table id="eventsTable" class="display text-white border-white">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Event Detail</th> <!-- Combined Start and End Date -->
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated via DataTables AJAX -->
                                    </tbody>
                                </table>

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
