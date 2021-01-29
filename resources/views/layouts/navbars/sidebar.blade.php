<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="">
            <img style="width: 90px; max-height:6rem; margin-top:10px; bottom:100px;  " src="assets3/img/logo.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                        <h2 style="color:black;">BKK Free Wifi Bali Smart Island</h2>
                        </a>
                    </div>
                    
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <hr class="my-3">
            <ul class="navbar-nav">
                
                
                @if (Auth::check())
                    <button class="dropdown-btn">
                    <a href="#" style="color:rgba(0, 0, 0, .5); " class="dropdown-toggle" ><i class="ni ni-bullet-list-67 text-blue"></i> &#8287; &#8287; &#8287; Master Data </a>
                    </button>
                        <div class="dropdown-container">
                            @if (Auth::user()->is_admin == 1)
                                <a class="nav-link" href="/pengumuman">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Pengumuman') }}
                                </a>
                                <a class="nav-link" href="/anggota">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Anggota') }}
                                </a>
                                <a class="nav-link" href="/kegiatan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kegiatan') }}
                                </a>
                                <a class="nav-link" href="/berita">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Berita') }}
                                </a>

                                <a class="nav-link" href="/kabupaten">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kabupaten') }}
                                </a>
                                <a class="nav-link" href="/kecamatan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kecamatan') }}
                                </a>
                                <a class="nav-link" href="/kelurahan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kelurahan') }}
                                </a>
                                
                            @elseif(Auth::user()->is_admin == 2)
                                <a class="nav-link" href="/pengumuman">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Pengumuman') }}
                                </a>
                                <a class="nav-link" href="/kegiatan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kegiatan') }}
                                </a>
                                <a class="nav-link" href="/berita">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Berita') }}
                                </a>

                                <a class="nav-link" href="/kabupaten">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kabupaten') }}
                                </a>
                                <a class="nav-link" href="/kecamatan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kecamatan') }}
                                </a>
                                <a class="nav-link" href="/kelurahan">
                                    <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Kelurahan') }}
                                </a>
                            @endif
                        </div>
                @endif
                
                
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/inputData">
                        <i class="ni ni-bullet-list-67 text-default"></i> {{ __('Master Data') }}
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="ni ni-planet text-blue"></i> {{ __('Back to Website') }}
                    </a>
                </li>
                {{-- @if (Auth::check())
                    @if (Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/account">
                                <i class="ni ni-single-02 text-blue"></i> {{ __('Create Account') }}
                            </a>
                        </li>  
                    @endif
                @else
                    
                @endif --}}
            </ul>
            <!-- Divider -->
        </div>
    </div>
</nav>