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
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $guest->id }})">Delete</button>
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
