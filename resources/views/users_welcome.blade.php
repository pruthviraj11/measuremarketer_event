@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area text-white border-0">
                        <div class="row">
                            <div class="col-md-3 sidebar">
                                <div class="d-flex flex-column flex-shrink-0 p-3" style="">
                                    <a href="/"
                                        class="d-flex align-items-center text-white mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                                        <span class="fs-4">Menus</span>
                                    </a>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('registerd_event') }}" class="nav-link active"
                                                aria-current="page">
                                                Registered Events
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" aria-current="page">
                                                My Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" aria-current="page">
                                                My Messages
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" aria-current="page">
                                                Add Guests
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <center class="mb-4">
                                    <h6>My Account</h6>
                                </center>
                                <!-- DataTable for Registered Events -->
                                <table id="eventsTable" class="display text-white border-white">
                                    <thead>
                                        <tr>
                                            <th class="pe-4">Event Name</th>
                                            <th>Event Date</th> <!-- Combined Start and End Date -->
                                            <th>Action</th> <!-- Action column for View Community -->
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
