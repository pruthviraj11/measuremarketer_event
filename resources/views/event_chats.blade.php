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
                                @foreach ($chatDetails as $chatDetail)
                                    @if ($chatDetail->sent_by == $userId)
                                        <!-- Right-side chat bubble -->
                                        <div class="chat-message right right_part chat_font">
                                            <span class="chat_name">{{ $username->company_name }}</span>
                                            <p>{{ $chatDetail->message }}</p>
                                            <span class="timestamp">{{ $chatDetail->created_at }}</span>
                                        </div>
                                    @else
                                        <!-- Left-side chat bubble -->
                                        <div class="chat-message left left_part chat_font">
                                            <p>{{ $chatDetail->message }}</p>
                                            <span class="timestamp">{{ $chatDetail->created_at }}</span>
                                        </div>
                                    @endif
                                @endforeach

                                <div class="text-center d-flex justify-content-center mt-4">
                                    <button type="button"
                                        class="btn btn-primary send_message_btn d-flex align-items-center"
                                        data-toggle="modal" data-target="#exampleModal" data-id="{{ $getPerson->id }}"
                                        data-name="{{ $getPerson->contact_person }}"
                                        data-event-id="{{ $getPerson->event_id }}">
                                        <svg class="mail_svg" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        Send Message</button>
                                </div>

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

<style>
    .chat-message {
        padding: 10px;
        margin: 5px 0;
        border-radius: 10px;
        max-width: 60%;
        word-wrap: break-word;
    }

    .chat-message.right {
        background-color: #d1f7c4;
        margin-left: auto;
        text-align: right;
    }

    .chat-message.left {
        background-color: #f1f1f1;
        margin-right: auto;
        text-align: left;
    }

    .timestamp {
        font-size: 0.8em;
        color: #999;
    }
</style>



@include('footer')
