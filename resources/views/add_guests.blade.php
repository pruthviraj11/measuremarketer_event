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
                                <h1 class="text-white text-center">Add Members</h1>
                                <form action="{{ route('store.guests') }}" method="POST" class="guest_form">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $eventId }}">

                                    <!-- Guests Container -->
                                    <div class="guests-container">
                                        <div class="guest-form" id="guest-0">
                                            <div class="form-row d-flex  align-items-center">
                                                <!-- Use form-row for grid system -->
                                                <div class="form-group col-md-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="guests[0][name]" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="guests[0][email]" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" name="guests[0][phone]" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-danger remove-guest"
                                                        style="display:none; margin-top: 10px;">Remove</button>
                                                    <button type="button" style="margin-top: 13px;"
                                                        class="btn btn-info add-more"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-plus-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="12" y1="8" x2="12"
                                                                y2="16"></line>
                                                            <line x1="8" y1="12" x2="16"
                                                                y2="12"></line>
                                                        </svg></button>
                                                </div>
                                            </div>

                                            <!-- Remove Button (hidden by default) -->

                                        </div>
                                    </div>

                                    <!-- Add More Button and Submit Button -->

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary save_guest_btn">Save
                                            Members</button>
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
