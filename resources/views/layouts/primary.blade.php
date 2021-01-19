<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('tittle')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('argon') }}/img/icon-kominfos-prov-bali.png" />
  {{-- <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png"> --}}
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
        @yield('content')
  </div>
  <!-- Footer -->
  {{-- <footer class="py-5" id="footer-main"> --}}
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; {{ now()->year }} <a class="font-weight-bold ml-1" target="_blank">Paguyuban Ngeksigondo</a>
          </div>
        </div>
        {{-- <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div> --}}
      </div>
    </div>
  {{-- </footer> --}}
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets') }}/js/argon.js?v=1.2.0"></script>
</body>

</html>