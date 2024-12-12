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
                                <div class="col-md-12 mb-5">
                                    <select name="category[]" id="list_category" multiple class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="table-responsive">
                                    <table id="registrantsTable" class="display table">
                                        <thead>
                                            <tr>
                                                <th class="d-md-inline-block d-none">Profile</th>
                                                <th>Company Name</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Connect</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registrants as $registrant)
                                                <tr>
                                                    @php
                                                        if ($registrant->form_type == 'company') {
                                                            $PersonName = $registrant->contact_person;
                                                        } else {
                                                            $PersonName = $registrant->full_name;
                                                        }
                                                    @endphp
                                                    <td class="text-center align-middle d-md-block d-none">
                                                        @php
                                                            $profileImagePath = $registrant->profile_image;
                                                        @endphp
                                                        @if ($registrant->profile_image && file_exists(public_path($registrant->profile_image)))
                                                            <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                                                class="mt-2 rounded-circle " width="60" height="60">
                                                        @else
                                                            <img src="{{ asset('images/no_image_found.png') }}" alt="No Image Found"
                                                                class="img-thumbnail mt-2 rounded-circle " width="60" height="60">
                                                        @endif
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ $registrant->company_name }}
                                                    </td>
                                                    <td class="align-middle text-center">{{ $PersonName }}</td>
                                                    <td class="align-middle text-center">{{ $registrant->designation }}</td>
                                                    <td class="align-middle text-center">
                                                        <a onclick="eventAlert()"><button class="btn profile_view_btn">
                                                                View Profile
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                               <?php /* <table id="registrantsTable" class="display table">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>Company Name</th>
                                            <th>Name </th>
                                            <th>Designation</th>

                                            {{-- <th>Email</th>
                                            <th>Phone</th> --}}
                                            <th>Connect</th> <!-- Added action column for message button -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrants as $registrant)
                                            <tr>
                                                @php
                                                    if ($registrant->form_type == 'company') {
                                                        $PersonName = $registrant->contact_person;
                                                    } else {
                                                        $PersonName = $registrant->full_name;
                                                    }
                                                @endphp

                                                <td class="text-center align-middle">

                                                    @php
                                                        $profileImagePath = $registrant->profile_image;
                                                    @endphp

                                                    @if ($registrant->profile_image && file_exists(public_path($registrant->profile_image)))
                                                        <img src="{{ asset($profileImagePath) }}" alt="Profile Image"
                                                            class="mt-2 rounded-circle" width="60" height="60">
                                                    @else
                                                        <img src="{{ asset('images/no_image_found.png') }}"
                                                            alt="No Image Found"
                                                            class="img-thumbnail mt-2 rounded-circle" width="60"
                                                            height="60">
                                                    @endif



                                                </td>

                                                <td class="align-middle text-center">
                                                    {{ $registrant->company_name }}
                                                </td>
                                                <td class="align-middle text-center">{{ $PersonName }}</td>
                                                <td class="align-middle text-center">{{ $registrant->designation }}</td>
                                                {{-- <td>{{ $registrant->email }}</td>
                                                <td>{{ $registrant->phone }}</td> --}}
                                                <td class="align-middle text-center">
                                                    {{-- <button type="button" class="btn btn-primary send_message_btn"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $registrant->id }}"
                                                        data-name="{{ $registrant->contact_person }}"
                                                        data-event-id="{{ $registrant->event_id }}">Send
                                                        Message</button> --}}
                                                    <?php $encryptedId = encrypt($registrant->id); ?>

                                                    {{-- <a href="{{ route('get_contact_person', $encryptedId) }}"><button
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
                                                            View Profile
                                                        </button>
                                                    </a> --}}

                                                    <a onclick=eventAlert()><button class="btn profile_view_btn ">
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-eye">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                </path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg> --}}
                                                            View Profile
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                */ ?>
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
