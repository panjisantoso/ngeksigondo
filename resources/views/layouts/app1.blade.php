<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Paguyuban Ngeksigondo</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets3/img/favicon.png" rel="icon">
  <link href="/assets3/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets3/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets3/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/assets3/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets3/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets3/vendor/owl.carousel/assets3/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets3/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets3/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Green - v3.0.0
  * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  @stack('css')
</head>

<body class="{{ $class ?? '' }}">
  @include('layouts.navbars.navbar')
  
  @yield('content')    
 
  
      <!-- ======= Footer ======= -->
      <footer id="footer">
          <div class="container">
            <h3>Paguyuban Ngeksigondo</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
            <div class="social-links">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
              &copy; Copyright <strong><span>Green</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/green-free-one-page-bootstrap-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </footer><!-- End Footer -->
        
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <!-- Vendor JS Files -->
        <script src="/assets3/vendor/jquery/jquery.min.js"></script>
        <script src="/assets3/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets3/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="/assets3/vendor/php-email-form/validate.js"></script>
        <script src="/assets3/vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="/assets3/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="/assets3/vendor/venobox/venobox.min.js"></script>

        <!-- Template Main JS File -->
        <script src="/assets3/js/main.js"></script>

        @stack('js')
    </body>
</html>