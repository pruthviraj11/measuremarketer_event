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

                                <select name="category" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach

                                </select>

                                <table id="registrantsTable" class="display table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Contact Person</th>
                                            <th>Company Name</th>
                                            <th>Designation</th>

                                            {{-- <th>Email</th>
                                            <th>Phone</th> --}}
                                            <th>Action</th> <!-- Added action column for message button -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrants as $registrant)
                                            <tr>
                                                <td>{{ $registrant->contact_person }}</td>
                                                <td>{{ $registrant->company_name }}</td>
                                                <td>{{ $registrant->designation }}</td>
                                                {{-- <td>{{ $registrant->email }}</td>
                                                <td>{{ $registrant->phone }}</td> --}}
                                                <td>
                                                    {{-- <button type="button" class="btn btn-primary send_message_btn"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $registrant->id }}"
                                                        data-name="{{ $registrant->contact_person }}"
                                                        data-event-id="{{ $registrant->event_id }}">Send
                                                        Message</button> --}}
                                                    <?php $encryptedId = encrypt($registrant->id); ?>

                                                    <a href="{{ route('get_contact_person', $encryptedId) }}"><button
                                                            class="btn profile_view_btn ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-eye">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                </path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </button>
                                                    </a>

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
    <!-- Modal -->
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
        window.location.href = "{{ route('users_login') }}"; // Redirect to login route
    </script>
@endif



@include('footer')
