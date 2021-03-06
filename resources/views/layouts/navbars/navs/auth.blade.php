@push('css')

@endpush
<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info">
      <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">paguyubanngeksigondo@example.com</a>
        <i class="icofont-phone"></i> 08212345678
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/">Paguyuban Ngeksigondo</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/">Home</a></li>
          <li><a href="#about">Profil</a></li>
          <li><a href="#services">Berita</a></li>
          <li><a href="#portfolio">Kegiatan</a></li>
          <li><a href="#cta">Wedding Organization</a></li>    
          <!-- <li><a href="/layanan">Master Data</a></li>      -->

          <li>
            <a onclick="myFunction()"  class="dropdown-toggle">
                {{ Auth::user()->name }}
            </a>

            <div id="myDropdown" class="dropdown-content" style="">
              @if(Auth::user()->is_admin == 1)
              <a class="dropdown-item" href="/admin/profile">
                    <i class="ni ni-circle-08"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
                @elseif(Auth::user()->is_admin == 2)
                <a class="dropdown-item" href="/profile">
                    <i class="ni ni-circle-08"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
                @elseif(Auth::user()->is_admin == 0)
                <a class="dropdown-item" href="/profiles">
                    <i class="ni ni-circle-08"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
                @endif

                
                @if(Auth::user()->is_admin == 1)
                  <a class="dropdown-item" href="/admin/anggota">
                      <i class="ni ni-circle-08"></i>
                      <span>{{ __('Master Data') }}</span>
                  </a>
                @elseif (Auth::user()->is_admin == 2)
                  <a class="dropdown-item" href="/kegiatan">
                      <i class="ni ni-circle-08"></i>
                      <span>{{ __('Master Data') }}</span>
                  </a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="ni ni-button-power"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
            </div>
            <!-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a> -->
          </li>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->