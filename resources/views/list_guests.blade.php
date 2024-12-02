@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area text-white">
                        <div class="row">
                            @include('sidebar_welcome')
                            <div class="col-md-9">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <h1 class="text-white mb-5">List Guests</h1>
                                    </div>
                                    <div class="col-md-6 text-right"> <a href="{{ route('add.guests') }}"
                                            class="btn btn-primary btn-sm add_guest_btn">Add Guest</a></div>
                                </div>
                                <!-- Table for displaying guest information -->
                                <table id="guestsTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Guest Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Event Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userData as $guest)
                                            <tr>
                                                <td>{{ $guest->name }}</td>
                                                <td>{{ $guest->email }}</td>
                                                <td>{{ $guest->phone }}</td>
                                                <td>{{ $guest->event_name }}</td>
                                                <td>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('guests.delete', $guest->id) }}"
                                                        method="POST" class="d-inline"
                                                        id="deleteForm{{ $guest->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm "
                                                            onclick="confirmDelete({{ $guest->id }})"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg></button>
                                                    </form>
                                                </td>
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
