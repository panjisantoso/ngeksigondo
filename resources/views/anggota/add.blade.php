
@extends('layouts.app2')

@section('tittle', 'Add Anggota')

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
      
      
      <div class="col-md-6">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
              <h2 class="mb-0"> Tambah Data Anggota</h2>
                
              </div>
              <div class="col text-center">
                <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Tambah Kegiatan</a> -->
              </div>
            </div>
          </div>
          
          <div class="card-header border-0">
                <div class="row">
                <form action="/anggota" method="POST" class="col-md-12" enctype="multipart/form-data">
                      @csrf
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
                              <label for="name" class="col-sm-8">E-mail</label>
                              <div class="col-sm-12">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" value="" required>
                                  <span id="emailError" class="alert-message"></span>
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
                                        <input type="radio" id="jenis_kelamin1" name="jenis_kelamin" value="Laki-laki" class="form-check-input" >Laki-laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-control-radio">
                                        <input type="radio" id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan" class="form-check-input" > Perempuan
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
                            <label class="col-sm-8">Role</label>
                            <div class="col-sm-12">
                                <select id="is_admin" name="is_admin" class="form-control">
                                  <option value="">Select Role</option>
                                  <option value="0">Anggota</option>
                                  <option value="1">Super Admin</option>
                                  <option value="2">Pengurus</option>
                                </select>
                                <span id="is_adminError" class="alert-message"></span>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Password</label>
                              <div class="col-sm-12">
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="" required>
                                  <span id="passwordError" class="alert-message"></span>
                              </div>
                          </div>
                          
                          <div class="col text-center">
                              <button class="btn btn-info" type="submit">Tambah Data</button>
                          </div>
                      </form>
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
function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(200);
                
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(200);
                
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah3')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(200);
                
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>
<script>
  $("#post-modal").on('hidden.bs.modal', function(e) {
    $("#layanan_id").val('');
    $("#nama_layanan").val('');
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

            function addLayanan() {
              $("#layanan_id").val();
              $('#post-modal').modal('show');
            }
          
            function editLayanan(event) {
              var id  = $(event).data("id");
              let _url = `/admin/layanan/${id}`;
              $('#namaLayananError').text('');
              $("#loader").show();
              
              $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                      $("#layanan_id").val(response.id);
                      $("#nama_layanan").val(response.nama_layanan);
                      $('#post-modal').modal('show');
                      $("#loader").hide();
                    }
                }
              });
            }
          
            function createLayanan() {
              var nama_layanan = $('#nama_layanan').val();
              var id = $('#layanan_id').val();
          
              let _url     = `/admin/layanan`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(nama_layanan!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    layanan_id: id,
                    nama_layanan: nama_layanan,
                    _token: _token
                  },

                  success: function(response) {
                      if(response.code == 200) {

                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.nama_layanan);

                          // location.reload(true);
                        } else {
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                          // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.nama_layanan+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editLayanan(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteLayanan(event.target)">Delete</a></td></tr>');
                        }
                        $('#nama_layanan').val('');
          
                        $('#post-modal').modal('hide');

                        // location.reload(true);
    
                        $("#loader").hide();
                      }

                  },
                  error: function(response) {
                    $('#namaLayananError').text(response.responseJSON.errors.nama_layanan);
                    // console.log(JSON.stringify(response.responseJSON.errors));
                  }
                });
              }else{
                alert('Please fill all the field')
              }
            }
          
            function deleteLayanan(event) {
              $('#delete-modal').modal('show');
              var id  = $(event).data("id");
              let _url = `/admin/layanan/${id}`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
              $(document).on('click', '#btnDelete', function(){
                $.ajax({
                  url: _url,
                  type: 'PUT',
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
