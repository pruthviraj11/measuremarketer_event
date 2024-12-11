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
                         </script> Optimize X Summit. All rights reserved.
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


 {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

 <!-- Include Select2 JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


 <script>
     $(document).ready(function() {

         $('#category').select2({
             placeholder: "Select Category",
             allowClear: true
         });
         $('#interests').select2({
             placeholder: "Select Interest",
             allowClear: true
         });

         // $(".individual_info").hide();
         $(".radio_form").click(function() {
             $val = $(this).val();
             if ($val == "company") {
                 $(".company_info").show();
                 $(".individual_info").hide();
             } else {
                 $(".company_info").hide();
                 $(".individual_info").show();
             }


             // company_info

         });

         /*-------Event AttandingList Info---------*/
         $('#category').change(function() {
             let selectedCategories = $(this).val();

             $.ajax({
                 url: "{{ route('list.attending') }}", // Adjust to your route
                 method: "GET",
                 data: {
                     categories: selectedCategories
                 },
                 success: function(response) {
                     let registrantsTable = $('#registrantsTable tbody');
                     registrantsTable.empty();

                     if (response.registrants.length > 0) {
                         response.registrants.forEach(function(registrant) {
                             let profileImageUrl = registrant.profile_image &&
                                 registrant.profile_image !== '' ?
                                 registrant.profile_image :
                                 'images/no_image_found.png'; // Default image if no profile image exists
                             let row = `
                                <tr>

                                    <td><img src="${profileImageUrl}" alt="Profile Image" class="mt-2 rounded-circle" width="80" height="80"></td>
                                    <td>${registrant.contact_person}</td>
                                    <td>${registrant.company_name}</td>
                                    <td>${registrant.designation}</td>

                                    <td>
                                        <a href="/view-contact-person/${registrant.encrypted_id}">
                                            <button class="btn profile_view_btn">
                                                View Profile
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            `;
                             registrantsTable.append(row);
                         });
                     } else {
                         registrantsTable.append(
                             '<tr><td colspan="4" class="text-center">No registrants found.</td></tr>'
                         );
                     }
                 },
                 error: function() {
                     alert('Unable to fetch registrants. Please try again.');
                 }
             });
         });



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
                     name: 'event_date'
                     //  render: function(data, type, row) {
                     //      const startDate = row.start_date ? row.start_date : '-';
                     //      const startTime = row.start_time ? row.start_time : '-';
                     //      const endDate = row.end_date ? row.end_date : '-';
                     //      const endTime = row.end_time ? row.end_time : '-';

                     //      return `${startDate} ${startTime}`;
                     //  }
                 },
             ]
         });

         // Add event listener for View Community button
         $(document).on('click', '.view-community', function() {
             var encryptedId = $(this).data('id');
             window.location.href = `/community/view/${encryptedId}`;
         });


         /*------------- Event Messages Lists   ----*/
         $('#eventMessageTable').DataTable({
             processing: true,
             serverSide: true,
             ordering: false,
             paging: false,
             bInfo: false,
             ajax: '{{ route('event_messages') }}', // AJAX URL to fetch the data
             columns: [{
                     data: 'company_name'
                 },
                 {
                     data: 'message'
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
         $(document).on('click', '.view-messages', function() {

             var viewMessageUrl = "{{ route('event_messages.view', ':id') }}";
             var encryptedId = $(this).data('id');

             //  $eventname = `/messages/view/${encryptedId}`;
             //  route(event_messages.view, $ {
             //      encryptedId
             //  });

             // window.location.href = `/messages/view/${encryptedId}`;

             var url = viewMessageUrl.replace(':id', encryptedId);
             window.location.href = url;




         });






         /*------------- End Event Message Lists   ------------*/









     });
 </script>
 <script type="text/javascript">
     $(document).ready(function() {
         $('#registrantsTable').DataTable({
             ordering: false,
             paging: false,
             info: false,
         });
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
            <div class="form-row row d-flex align-items-end">
                 <!-- Added form-row to align fields in a row -->
                 </hr>
                <div class="form-group col-md-5">
                    <label for="name">Name</label>
                    <input type="text" name="guests[${guestIndex}][name]" class="form-control" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="email">Email</label>
                    <input type="email" name="guests[${guestIndex}][email]" class="form-control">
                </div>
                <div class="form-group col-md-5">
                    <label for="phone">Phone</label>
                    <input type="text" name="guests[${guestIndex}][phone]" class="form-control">
                </div>


                <div class="form-group col-md-5">
                    <label for="designation">Designation</label>
                    <input type="text" name="guests[${guestIndex}][designation]" class="form-control">
                </div>


                <div class="form-group col-md-2">

                    <button type="button" class="btn btn-danger remove-guest" style="margin-top: 10px;">

                        <svg class="remove-guest" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> </button>
                </div>
            </div>
           <!-- Add margin-top for spacing -->
        `;

         container.appendChild(guestForm);

         // Make the Remove button visible after adding the form
         document.querySelector(`#guest-${guestIndex} .remove-guest`).style.display = 'inline-block';
         document.querySelector(`. add-more`).style.display = 'inline-block';

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
     function eventAlert() {
         Swal.fire({
             //  title: "<strong> Access to profiles will be available on the event day!</strong>",
             icon: "info",
             html: `
   <h2> Access to profiles will be available on the event day!</h2>
  `,
             showCloseButton: true,
             showCancelButton: false,
             focusConfirm: false,
             confirmButtonText: `
    <i class="fa fa-thumbs-up"></i> Great!
  `,
             confirmButtonAriaLabel: "Thumbs up, great!",

         });
     }

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
     $('#exampleModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget); // Button that triggered the modal
         var registrantId = button.data('id');
         var eventId = button.data('event-id');

         // Update modal's form action with the registrant id and event id
         var modal = $(this);
         modal.find('#registrant_id').val(registrantId);
         modal.find('#event_id').val(eventId);
     });
 </script>

 <script>
     $(document).ready(function() {
         document.querySelectorAll('.toggle-password,.confirm-toggle-password').forEach(button => {
             button.addEventListener('click', function() {
                 const input = document.querySelector(this.dataset.target);
                 const icon = this.querySelector('i');
                 if (input.type === 'password') {
                     input.type = 'text';
                     icon.classList.remove('fa-eye');
                     icon.classList.add('fa-eye-slash');
                 } else {
                     input.type = 'password';
                     icon.classList.remove('fa-eye-slash');
                     icon.classList.add('fa-eye');
                 }
             });
         });
     });
 </script>

 </body>

 </html>
