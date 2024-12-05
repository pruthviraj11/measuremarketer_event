@extends('layouts/contentLayoutMaster')

@section('title', 'View profile')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
@endsection

@section('content')



    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Chat Details</h4>


                        {{-- <h4 class="card-title">{{$page_data['form_title']}}</h4> --}}
                    </div>
                    <div class="card-body">

                        @foreach ($messageDatas as $chatDetail)
                            @if ($chatDetail['sent_by'] == $user_id)
                                <!-- Right-side chat bubble -->
                                <div class="chat-message right right_part chat_font">
                                    {{-- <span class="chat_name">{{ $username->company_name }}</span> --}}
                                    <p>{{ $chatDetail['message'] }}</p>
                                    <span class="timestamp">{{ $chatDetail['created_at'] }}</span>
                                </div>
                            @else
                                <!-- Left-side chat bubble -->
                                <div class="chat-message left left_part chat_font">
                                    <span class="chat_name">{{ $chatDetail['company_name'] }}</span>
                                    <p>{{ $chatDetail['message'] }}</p>
                                    <span class="timestamp">{{ $chatDetail['created_at'] }}</span>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->

@endsection

<style>
    .chat-message.right {
        background-color: #d1f7c4;
        margin-left: auto;
        text-align: right;
    }

    .chat-message {
        padding: 10px;
        margin: 5px 0;
        border-radius: 10px;
        max-width: 60%;
        word-wrap: break-word;
    }

    .chat-message {
        border-radius: 10px !important;
        width: 50% !important;
    }

    .right_part {
        background: #d9fdd3 !important;

    }

    .left_part {
        background: #f5f6f6 !important;
    }
</style>
