@extends('layouts.app1')

@section('tittle', 'Profile')

@section('content')
  <div class="header pb-6" style="background-color: #8f384d;">  
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0"></h6>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Profile</h3>
              </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('successprofile'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('successprofile') }}
                    </div>
                @endif
                @if(session()->has('emailtaken'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('emailtaken') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin == 1)
                    <form method="POST" action="/admin/profile/updateprofile/{{auth()->user()->id}}" role="form">   
                @else
                    <form method="POST" action="/profile/updateprofile/{{auth()->user()->id}}" role="form">
                @endif
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">NIK</label>
                        <input class="form-control" type="number" id="nik" name="nik" value="{{ auth()->user()->nik }}" required autocomplete="nik" autofocus placeholder="Nomor Induk Kependudukan">
                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" required autocomplete="name" autofocus placeholder="Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ auth()->user()->email }}" required autocomplete="email" autofocus placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Tempat Lahir</label>
                        <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir" value="{{ auth()->user()->tempat_lahir }}" required autocomplete="tempat_lahir" autofocus placeholder="Tempat Lahir">
                        @error('tempat_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Tanggal Lahir</label>
                        <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" value="{{ auth()->user()->tgl_lahir }}" required autocomplete="tgl_lahir" autofocus placeholder="Tanggal Lahir">
                        @error('tgl_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Nomor HP</label>
                        <input class="form-control" type="number" id="no_hp" name="no_hp" value="{{ auth()->user()->no_hp }}" required autocomplete="no_hp" autofocus placeholder="No HP">
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Jenis Kelamin</label>
                        <div class="radio">
                            <label for="radio1" class="form-control-radio">
                                <input type="radio"  id="jenis_kelamin1" name="jenis_kelamin" value="Laki-laki" class="form-check-input" {{ (auth()->user()->jenis_kelamin == 'Laki-laki') ? 'checked' : '' }}>Laki-laki
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radio2" class="form-control-radio">
                                <input type="radio"  id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan" class="form-check-input" {{ (auth()->user()->jenis_kelamin == 'Perempuan') ? 'checked' : '' }}>Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                      </div>
                </form>
            </div>
            <hr class="my-2">
            <div class="card-body">
                @if(session()->has('successpassword'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('successpassword') }}
                    </div>
                @endif
                @if (Auth::user()->is_admin == 1)
                    <form method="POST" action="/admin/profile/updatepassword/{{auth()->user()->id}}" role="form">
                @else
                    <form method="POST" action="/profile/updatepassword/{{auth()->user()->id}}" role="form">
                @endif
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="example-password-input" class="form-control-label">Password</label>
                        <input class="form-control" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-password-input" class="form-control-label">Password</label>
                        <input class="form-control" type="password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Password Confirm">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </div>
@endsection