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

 <!-- JS here -->
 <script src="js/vendor/modernizr-3.5.0.min.js"></script>
 <script src="js/vendor/jquery-1.12.4.min.js"></script>
 <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/owl.carousel.min.js"></script>
 <script src="js/isotope.pkgd.min.js"></script>
 <script src="js/ajax-form.js"></script>
 <script src="js/waypoints.min.js"></script>
 <script src="js/jquery.counterup.min.js"></script>
 <script src="js/imagesloaded.pkgd.min.js"></script>
 <script src="js/scrollIt.js"></script>
 <script src="js/jquery.scrollUp.min.js"></script>
 <script src="js/wow.min.js"></script>
 <script src="js/gijgo.min.js"></script>
 <script src="js/nice-select.min.js"></script>
 <script src="js/jquery.slicknav.min.js"></script>
 <script src="js/jquery.magnific-popup.min.js"></script>
 <script src="js/tilt.jquery.js"></script>
 <script src="js/plugins.js"></script>



 <!--contact js-->
 <script src="js/contact.js"></script>
 <script src="js/jquery.ajaxchimp.min.js"></script>
 <script src="js/jquery.form.js"></script>
 <script src="js/jquery.validate.min.js"></script>
 <script src="js/mail-script.js"></script>


 <script src="js/main.js"></script>
 </body>

 </html>
