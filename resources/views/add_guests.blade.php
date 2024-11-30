@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area">
                        <div class="row">
                            @include('sidebar_welcome')
                            <div class="col-md-9">

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <h1 class="text-white text-center">Add Guests</h1>
                                <form action="{{ route('store.guests') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $eventId }}">
                                    <!-- Make sure to pass the event id -->

                                    <div class="guests-container">
                                        <div class="guest-form" id="guest-0">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="guests[0][name]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="guests[0][email]" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="guests[0][phone]" class="form-control">
                                            </div>
                                            <button type="button" class="btn btn-danger remove-guest"
                                                style="display:none; margin-top: 10px;">Remove</button>
                                            <!-- Hidden initially with margin-top -->
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary add-more add_more_btn">Add
                                            More</button>
                                        <button type="submit" class="btn btn-primary save_guest_btn">Save
                                            Guests</button>
                                    </div>
                                </form>
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
