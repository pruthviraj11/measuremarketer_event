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
                                    <p class="text-white profile_text">Profile</p>
                                </center>
                                <div class="col-md-6 mb-3">
                                    @php
                                        $profileImagePath = $getPerson['profile_image'];
                                    @endphp

                                    @if ($getPerson['profile_image'] && file_exists(public_path($getPerson['profile_image'])))
                                        <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                            class=" mt-2 rounded-circle" width="100" height="100">
                                    @else
                                        <img src="{{ asset('images/no_image_found.png') }}" alt="No Image Found"
                                            class="img-thumbnail mt-2 rounded-circle" width="110">
                                    @endif



                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="contact-name" class="text-white profile_label">Company Name
                                            :</label>
                                        <p>{{ $getPerson['company_name'] }}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="contact-name" class="text-white profile_label">Contact Person
                                            Name :</label>
                                        <p>{{ $getPerson['contact_person'] }}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="contact-email" class="text-white profile_label">Email :</label>
                                        <p>{{ $getPerson['email'] }}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="contact-email" class="text-white profile_label">Phone Number
                                            :</label>
                                        <p>{{ $getPerson['phone'] }}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="contact-email" class="text-white profile_label">Address :</label>
                                        <p>{{ $getPerson['address'] ?? '-' }}</p>
                                    </div>


                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary send_message_btn" data-toggle="modal"
                                        data-target="#exampleModal" data-id="{{ $getPerson->id }}"
                                        data-name="{{ $getPerson->contact_person }}"
                                        data-event-id="{{ $getPerson->event_id }}">Send
                                        Message</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modle_change" style="z-index: 9999999;" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modle_view_change" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sendMessage') }}" method="POST" id="messageForm">
                        @csrf
                        <input type="hidden" id="registrant_id" name="registrant_id">
                        <input type="hidden" id="event_id" name="event_id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="message" name="message" placeholder="Message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary model_send_msg_btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <script>
        window.location.href = "{{ route('get_person') }}"; // Redirect to login route
    </script>
@endif

@include('footer')
