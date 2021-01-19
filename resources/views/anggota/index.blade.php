
@extends('layouts.app2')

@section('tittle', 'Anggota')

@push('css')
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- MDBootstrap Datatables  -->
    <link href="{{ asset('argon') }}/css/addons/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

    <style>
      .modal-open {
        padding-right: 0px;
      }
      .modal-busy {
          position: fixed;
          z-index: 999;
          height: 100%;
          width: 100%;
          top: 0;
          left: 0;
          background-color: Black;
          filter: alpha(opacity=60);
          opacity: 0.6;
          -moz-opacity: 0.8;
      }
      .center-busy {
          z-index: 1000;
          margin: 300px auto;
          padding: 0px;
          width: 130px;
          filter: alpha(opacity=100);
          opacity: 1;
          -moz-opacity: 1;
      }
      .center-busy img {
          height: 128px;
          width: 128px;
      }
    </style>

@endpush

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
                <h3 class="mb-0">Data Anggota</h3>
              </div>
              <div class="col text-right">
                <a href="javascript:void(0)" class="btn btn-primary" id="create-new-anggota" onclick="addAnggota()">Tambah Anggota</a>
              </div>
            </div>
          </div>
          <!-- Light table -->
          <div class="table-responsive" style="padding-left: 25px; padding-right: 25px;">
            <table class="table table align-items-center table-flush" id="laravel_crud" >
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="name">NIK</th>
                  <th scope="col" class="sort" data-sort="name">Nama</th>
                  <th scope="col" class="sort" data-sort="name">Tempat Lahir</th>
                  <th scope="col" class="sort" data-sort="name">Tanggal Lahir</th>
                  <th scope="col" class="sort" data-sort="name">Jenis Kelamin</th>
                  <th scope="col" class="sort" data-sort="name">No Hp</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                @for($i = 1; $i <= sizeof($anggota); $i++)
                    <tr id="row_{{$anggota[$i-1]->id}}">
                      <td>
                        {{ $i }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->nik }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->name  }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->tempat_lahir }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->tgl_lahir }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->jenis_kelamin }}
                      </td>
                      <td>
                        {{ $anggota[$i-1]->no_hp }}
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-id="{{$anggota[$i-1]->id}}" onclick="editAnggota(event.target)" class="btn btn-info">Edit</a>
                        <a href="javascript:void(0)" data-id="{{$anggota[$i-1]->id}}" class="btn btn-danger" onclick="deleteAnggota(event.target)">Delete</a>
                      </td>
                    </tr>
                  @endfor
              </tbody>
              <tfoot style="background-color: lavender;">

              </tfoot>
            </table>
          </div>
          <div class="modal-busy" id="loader" style="display: none">
              <div class="center-busy" id="test-git">
                  <img alt="" src="{{ asset('argon') }}/img/loading.svg" />
              </div>
          </div>
          <div class="modal fade" id="post-modal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <form name="anggotaForm" class="form-horizontal">
                         <input type="hidden" name="id" id="id">
                         <div class="form-group">
                              <label for="name" class="col-sm-8">NIK</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan (NIK)" value="" required>
                                  <span id="nikError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Nama</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" value="" required>
                                  <span id="namaAnggotaError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tempat Lahir</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="" required>
                                  <span id="tempatLahirError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal lahir</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" value="" required>
                                  <span id="tglLahirError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jenis Kelamin</label>
                              <div class="col-sm-12">
                                <div class="radio">
                                    <label for="radio1" class="form-control-radio">
                                        <input type="radio" id="jenis_kelamin1" name="jenis_kelamin" value="Laki-laki" class="form-check-input" {{ ($anggota[0]->jenis_kelamin == 'Laki-laki') ? 'checked' : '' }}>Laki-laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-control-radio">
                                        <input type="radio" id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan" class="form-check-input" {{ ($anggota[0]->jenis_kelamin == 'Perempuan') ? 'checked' : '' }}>Perempuan
                                    </label>
                                </div>
                               
                                  <span id="jenisKelaminError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">No HP</label>
                              <div class="col-sm-12">
                                  <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP" value="" required>
                                  <span id="noHPError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Password</label>
                              <div class="col-sm-12">
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="" required>
                                  <span id="passwordError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8"> Confirm Password</label>
                              <div class="col-sm-12">
                                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Masukkan Confirm Password" value="" required>
                                  <span id="confirmPasswordError" class="alert-message"></span>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="createAnggota()">Confirm</button>
                  </div>
              </div>
            </div>
          </div>

          <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are You Sure Want to Delete?.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-danger" id="btnDelete">Yes</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Card footer -->
        </div>
      </div>
    </div>
   
  </div>
@endsection

@push('js')

<script>
  $("#post-modal").on('hidden.bs.modal', function(e) {
    $("#id").val('');
    $("#nik").val('');
    $("#name").val('');
    $("#tempat_lahir").val('');
    $("#tgl_lahir").val('');
    $("#jenis_kelamin").val('');
    $("#no_hp").val('');
    $("#password").val('');
    $("#confirm_password").val('');
  })
</script>

    <script>
        var table = $('#laravel_crud').DataTable({
          "lengthMenu": [[10, 20, 25, 50, 100, -1], [10, 20, 25, 50, 100, "All"]],
          "language": {
            "paginate": {
              "previous": "<",
              "next": ">"
            }
          },
          "columnDefs": [{
              "searchable": false,
              "orderable": false,
              "targets": [0]
          }],
          "order": [[ 1, 'asc' ]]
        });
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();

            function addAnggota() {
              $("#id").val();
              $('#post-modal').modal('show');
            }
          
            function editAnggota(event) {
              var id  = $(event).data("id");
              let _url = `/anggota/${id}`;
              $('#nikError').text('');
              $('#namaAnggotaError').text('');
              $('#tempatLahirError').text('');
              $('#tglLahirError').text('');
              $('#jenisKelaminError').text('');
              $('#noHPError').text('');
              $('#passwordError').text('');
              $('#confirmPasswordError').text('');
              $("#loader").show();
              
              $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                      $("#id").val(response.id);
                      $("#nik").val(response.nik);
                      $("#name").val(response.name);
                      $("#tempat_lahir").val(response.tempat_lahir);
                      $("#tgl_lahir").val(response.tgl_lahir);
                      $("#jenis_kelamin").val(response.jenis_kelamin);
                      $("#no_hp").val(response.no_hp);
                      $("#password").val(response.password);
                      $('#post-modal').modal('show');
                      $("#loader").hide();
                    }
                }
              });
            }
          
            function createAnggota() {
              var name = $('#name').val();
              var nik = $('#nik').val();
              var id = $('#id').val();
              var tempat_lahir = $('#tempat_lahir').val();
              var tgl_lahir = $('#tgl_lahir').val();
              var jenis_kelamin = $('#jenis_kelamin').val();
              var no_hp = $('#no_hp').val();
              var password = $('#password').val();
              var confirm_password = $('#confirm_password').val();
              
              let _url     = `/anggota`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(nik!="" && name!="" && tempat_lahir!="" && tgl_lahir!="" && jenis_kelamin!="" && no_hp!="" && password!="" && confirm_password!=""){
                if(password != confirm_password){
                  document.getElementById("passwordError").innerHTML = "Password tidak sama";
                  document.getElementById("confirmPasswordError").innerHTML = "Password tidak sama";
                }else{
                  $('#post-modal').modal('hide');

                  $("#loader").show();

                  $.ajax({
                    url: _url,
                    type: "POST",
                    data: {
                      id: id,
                      nik: nik,
                      name: name,
                      tempat_lahir: tempat_lahir,
                      tgl_lahir: tgl_lahir,
                      jenis_kelamin: jenis_kelamin,
                      no_hp: no_hp,
                      password: password,
                      confirm_password: confirm_password,
                      _token: _token
                    },

                    success: function(response) {
                        if(response.code == 200) {

                          if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.nik);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.name);
                            $("#row_"+id+" td:nth-child(4)").html(response.data.tempat_lahir);
                            $("#row_"+id+" td:nth-child(5)").html(response.data.tgl_lahir);
                            $("#row_"+id+" td:nth-child(6)").html(response.data.jenis_kelamin);
                            $("#row_"+id+" td:nth-child(7)").html(response.data.no_hp);

                            // location.reload(true);
                          } else {
                            // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                            // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                            // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                            $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.nik+'</td><td>'+response.data.name+'</td><td>'+response.data.tempat_lahir+'</td><td>'+response.data.jenis_kelamin+'</td><td>'+response.data.no_hp+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAnggota(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAnggota(event.target)">Delete</a></td></tr>');
                          }
                          $('#nik').val('');
                          $('#name').val('');
                          $('#tempat_lahir').val('');
                          $('#tgl_lahir').val('');
                          $('#jenis_kelamin').val('');
                          $('#no_hp').val('');
                          $('#password').val('');
                          $('#confirm_password').val('');

                          $('#post-modal').modal('hide');

                          // location.reload(true);

                          $("#loader").hide();
                        }

                    },
                    error: function(response) {
                      $('#nikError').text(response.responseJSON.errors.nik);
                      $('#namaAnggotaError').text(response.responseJSON.errors.name);
                      $('#tempatLahirError').text(response.responseJSON.errors.tempat_lahir);
                      $('#tglLahirError').text(response.responseJSON.errors.tgl_lahir);
                      $('#jenisKelaminError').text(response.responseJSON.errors.jenis_kelamin);
                      $('#noHPError').text(response.responseJSON.errors.no_hp);
                      $('#passwordError').text(response.responseJSON.errors.password);
                      $('#confirmPasswordError').text(response.responseJSON.errors.confirm_password
);

                      // console.log(JSON.stringify(response.responseJSON.errors));
                    }
                  });
                }      
              }else{
                alert('Please fill all the field')
              }
            }
          
            function deleteAnggota(event) {
              $('#delete-modal').modal('show');
              var id  = $(event).data("id");
              let _url = `/anggota/${id}`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
              $(document).on('click', '#btnDelete', function(){
                $.ajax({
                  url: _url,
                  type: 'DELETE',
                  data: {
                    _token: _token
                  },
                  beforeSend: function(){
                    $("#loader").show();
                    $('#delete-modal').modal('hide');
                  },
                  success: function(response) {
                    $("#row_"+id).remove();
                    $("#loader").hide();
                    console.log(response.data);
                  }
                });
              });
            }
        // });
      
    </script>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.2.0"></script>

    <script type="text/javascript" src="{{ asset('assets2') }}/js/popper.min.js"></script>
    
@endpush
