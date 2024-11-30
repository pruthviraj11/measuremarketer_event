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
 <script src="js/vendor/modernizr-3.5.0.min.js"></script>

 <!-- Bootstrap JS (requires jQuery) -->
 <script src="js/popper.min.js"></script> <!-- Popper.js for Bootstrap tooltips and popovers -->
 <script src="js/bootstrap.min.js"></script>

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

                         return `${startDate} ${startTime} - ${endDate} ${endTime}`;
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

 </body>

 </html>
