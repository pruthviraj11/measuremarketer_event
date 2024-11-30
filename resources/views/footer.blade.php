 <!-- footer_start  -->
 <footer class="footer">

     <div class="copy-right_text">
         <div class="container">
             <div class="row">
                 <div class="col-xl-12">
                     <p class="copy_right text-center wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                         Copyright &copy;
                         <script>
                             document.write(new Date().getFullYear());
                         </script>Copyright © 2024 Measure marketers. All rights reserved.
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- footer_end  -->


 <script>
     const daysEl = document.getElementById('days');
     const hoursEl = document.getElementById('hours');
     const minutesEl = document.getElementById('minutes');
     const secondsEl = document.getElementById('seconds');

     const newYears = '10 dec 2024 00:00:00';

     function countdown() {
         const newYearsDate = new Date(newYears);
         const currentDate = new Date();

         const totalSeconds = (newYearsDate - currentDate) / 1000;

         const days = Math.floor(totalSeconds / 3600 / 24);
         const hours = Math.floor(totalSeconds / 3600) % 24;
         const
             minutes = Math.floor(totalSeconds / 60) % 60;
         const seconds = Math.floor(totalSeconds) % 60;

         daysEl.textContent = days;
         hoursEl.textContent = hours < 10 ? '0' + hours : hours;
         minutesEl.textContent = minutes < 10 ? '0' + minutes : minutes;
         secondsEl.textContent = seconds < 10 ? '0' + seconds : seconds;

     }

     countdown();

     setInterval(countdown, 1000);
 </script>

 <!-- jQuery (required for many plugins) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is up-to-date -->

 <!-- Modernizr (if you're using it for feature detection) -->
<script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>

<!-- Bootstrap JS (requires jQuery) -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script> <!-- Popper.js for Bootstrap tooltips and popovers -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Other vendor scripts -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

 <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
 <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
 <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('assets/js/scrollIt.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
 <script src="{{ asset('assets/js/wow.min.js') }}"></script>
 <script src="{{ asset('assets/js/gijgo.min.js') }}"></script>
 <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('assets/js/tilt.jquery.js') }}"></script>
 <script src="{{ asset('assets/js/plugins.js') }}"></script>

 <!-- Contact JS -->
 <script src="{{ asset('assets/js/contact.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('assets/js/mail-script.js') }}"></script>

 <!-- Main JS -->
 <script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

 <!-- DataTables & Additional Libraries (if needed) -->
 <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

 <!-- DataTables Buttons (if you use them) -->
 <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

 <!-- Select2 (if you're using it for select dropdowns) -->
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

 <!-- Bootstrap 5 specific -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <script>
     $(document).ready(function() {
         $('#eventsTable').DataTable({
             processing: true,
             serverSide: true,
             ordering: false,
             paging: false,
             bInfo: false,
             ajax: '{{ route('registerd_event') }}', // AJAX URL to fetch the data
             columns: [{
                     data: 'name'
                 },
                 {
                     data: 'event_date',
                     render: function(data, type, row) {
                         const startDate = row.start_date ? row.start_date : '-';
                         const startTime = row.start_time ? row.start_time : '-';
                         const endDate = row.end_date ? row.end_date : '-';
                         const endTime = row.end_time ? row.end_time : '-';

                         return `${startDate} ${startTime}`;
                     }
                 },
                 {
                     data: 'action', // Use 'action' to render the button
                     render: function(data, type, row) {
                         return data; // This will return the HTML for the button
                     }
                 }
             ]
         });

         // Add event listener for View Community button
         $(document).on('click', '.view-community', function() {
             var encryptedId = $(this).data('id');
             window.location.href = `/community/view/${encryptedId}`;
         });
     });
 </script>
 <script type="text/javascript">
     $(document).ready(function() {
         $('#registrantsTable').DataTable();
     });
 </script>
 <script>
     let guestIndex = 1;

     // Function to add new guest form
     document.querySelector('.add-more').addEventListener('click', function() {
         let container = document.querySelector('.guests-container');

         // Create new guest form dynamically
         let guestForm = document.createElement('div');
         guestForm.classList.add('guest-form');
         guestForm.id = `guest-${guestIndex}`;
         guestForm.innerHTML = `
            <div class="form-row row d-flex align-items-end"> <!-- Added form-row to align fields in a row -->
                <div class="form-group col-md-3">
                    <label for="name">Name</label>
                    <input type="text" name="guests[${guestIndex}][name]" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Email</label>
                    <input type="email" name="guests[${guestIndex}][email]" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="guests[${guestIndex}][phone]" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-danger remove-guest" style="margin-top: 10px;"> X </button>
                </div>
            </div>
           <!-- Add margin-top for spacing -->
        `;

         container.appendChild(guestForm);

         // Make the Remove button visible after adding the form
         document.querySelector(`#guest-${guestIndex} .remove-guest`).style.display = 'inline-block';

         guestIndex++;
     });

     // Event delegation to handle the remove button click for dynamically added guests
     document.querySelector('.guests-container').addEventListener('click', function(e) {
         if (e.target && e.target.classList.contains('remove-guest')) {
             // Remove the guest form container
             e.target.closest('.guest-form').remove();
         }
     });
 </script>
 <script>
     $(document).ready(function() {});
     if (feather) {
         feather.replace({
             width: 14,
             height: 14
         });
     }
 </script>
 <script>
     $(document).ready(function() {
         feather.replace();
         $('#guestsTable').DataTable({
             "ordering": false // This disables sorting
         });
     });
 </script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     function confirmDelete(guestId) {
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {
                 // If confirmed, submit the delete form
                 document.getElementById('deleteForm' + guestId).submit();
             }
         });
     }
 </script>
<script>
    // JavaScript to set the registrant id and event_id dynamically
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var registrantId = button.data('id');
        var eventId = button.data('event-id');
        
        // Update modal's form action with the registrant id and event id
        var modal = $(this);
        modal.find('#registrant_id').val(registrantId);
        modal.find('#event_id').val(eventId);
    });
</script>

 </body>

 </html>
