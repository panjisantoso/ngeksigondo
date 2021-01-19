@extends('layouts.primary')

@section('tittle', 'Login')

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-6 pt-lg-9">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Welcome</h1>
            <p class="text-lead text-white">Fill in the form below to login</p>
          </div>
        </div>
      </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
          {{-- <div class="card-header bg-transparent pb-5">
            <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
            <div class="btn-wrapper text-center">
              <a href="#" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                <span class="btn-inner--text">Github</span>
              </a>
              <a href="#" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                <span class="btn-inner--text">Google</span>
              </a>
            </div>
          </div> --}}
          <div class="card-body px-lg-5 py-lg-5">
            {{-- <div class="text-center text-muted mb-4">
              <h1>{{ __('Login') }}</h1>
            </div> --}}
              @if(session()->has('error'))
                  <div class="alert alert-danger" role="alert">
                      {{ session()->get('error') }}
                  </div>
              @endif
            <form role="form" method="POST" action="{{ route('login') }}">
            @csrf
              <div class="form-group mb-3">
                  <img src="assets3/img/logo.png" alt="" style="margin-left:100px; margin-right:100px; width:150px;">
              </div>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                  </div>
                  <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor Induk Keluarga (NIK)" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                    @error('nik')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <a class="text-light" href="{{ route('register') }}">
              <small >{{ __('Dont Have Account? Register Here') }}</small>
              </a>
              {{-- <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for=" customCheckLogin">
                  <span class="text-muted">Remember me</span>
                </label>
              </div> --}}
              <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Login') }}</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            @if (Route::has('password.request'))
                <a class="text-light" href="{{ route('password.request') }}">
                    <small>{{ __('Forgot Your Password?') }}</small>
                </a>
            @endif
          </div>
          {{-- <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light"><small>Create new account</small></a>
          </div> --}}
        </div>
      </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
