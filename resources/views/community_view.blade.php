@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area" style="background-color: #ffff;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex flex-column flex-shrink-0 p-3" style="">
                                    <a href="/"
                                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
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
                                <table id="registrantsTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Contact Person</th>
                                            <th>Compony Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrants as $registrant)
                                            <tr>
                                                <td>{{ $registrant->contact_person }}</td>
                                                <td>{{ $registrant->company_name }}</td>
                                                <td>{{ $registrant->email }}</td>
                                                <td>{{ $registrant->phone }}</td>
                                            </tr>
                                        @endforeach
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
