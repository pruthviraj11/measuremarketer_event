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


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
