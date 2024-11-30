@include('header')

@if (Session::has('user'))
    <div class="slider_area">
        <div class="single_slider mt-199 slider_bg_1 overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Sidebar-area" style="background-color: #ffff;">
                        <div class="row">
                            @include('sidebar_welcome')
                            <div class="col-md-9">
                                <table id="registrantsTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Contact Person</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th> <!-- Added action column for message button -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrants as $registrant)
                                            <tr>
                                                <td>{{ $registrant->contact_person }}</td>
                                                <td>{{ $registrant->company_name }}</td>
                                                <td>{{ $registrant->email }}</td>
                                                <td>{{ $registrant->phone }}</td>
                                                <td>
                                                    <!-- Button to trigger the modal, passing registrant ID -->
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#messageModal" 
                                                            data-id="{{ $registrant->id }}" data-name="{{ $registrant->contact_person }}">Send Message</button>
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

<!-- Bootstrap Modal for Sending Message -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Send Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="messageForm" method="POST" action="{{ route('send_message') }}">
                    @csrf
                    <input type="hidden" id="registrant_id" name="registrant_id">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

<script>
    // JavaScript to populate the modal with the registrant's ID and name when button is clicked
    $('#messageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var registrantId = button.data('id'); // Extract registrant ID
        var registrantName = button.data('name'); // Extract registrant name

        var modal = $(this);
        modal.find('.modal-title').text('Send Message to ' + registrantName);
        modal.find('#registrant_id').val(registrantId);
    });
</script>
