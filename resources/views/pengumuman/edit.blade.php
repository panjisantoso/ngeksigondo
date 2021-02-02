
@extends('layouts.app2')

@section('tittle', 'Edit Pengumuman')

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
              <h2 class="mb-0"> Tambah Data Pengumuman</h2>
                
              </div>
              <div class="col text-center">
                <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Tambah Kegiatan</a> -->
              </div>
            </div>
          </div>
          
          <div class="card-header border-0">
                <div class="row">
                @if(Auth::user()->is_admin == 1)
                <form action="/admin/pengumuman/{{ $pengumumans->id }}" method="POST" class="col-md-12" enctype="multipart/form-data">

                @elseif(Auth::user()->is_admin == 2)
                <form action="/pengumuman/{{ $pengumumans->id }}" method="POST" class="col-md-12" enctype="multipart/form-data">

                @endif
                      @csrf
                      @method('PUT')
                         <input type="hidden" name="id" id="id">
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal Tayang</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tgl_tayang" name="tgl_tayang" placeholder="Masukkan Tanggal Tayang"  required  value="{{ $pengumumans->tgl_tayang }}" >
                                  <span id="tglTayangError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal Akhir</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Masukkan Tanggal Akhir"  required value="{{ $pengumumans->tgl_akhir }}" >
                                  <span id="tglAkhirError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Isi Pengumuman</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" id="isi" name="isi" placeholder="Masukkan Isi Pengumuman" rows="10" cols="50"  required  >{{ $pengumumans->isi }}</textarea>
                                  <span id="isiPengumumanError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 1</label>
                              <div class="col-sm-12">
                                    <img id="blah1" src="/{{ $pengumumans->gambar1 }}" style="width:300px; height:200px;" />
                                  <input type="file" onchange="readURL1(this);" class="form-control"  name="gambar1" id="gambar1" multiple accept="image/*" placeholder="Masukkan FIle Gambar 1" value="{{ $pengumumans->gambar1 }}" >
                                  <span id="gambar1Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 2</label>
                              <div class="col-sm-12">
                                <img id="blah2" src="/{{ $pengumumans->gambar2 }}" style="width:300px; height:200px;" />
                                  <input type="file" onchange="readURL2(this);" class="form-control"  name="gambar2" id="gambar2" multiple accept="image/*" placeholder="Masukkan FIle Gambar 2"  value="{{ $pengumumans->gambar2 }}" >
                                  <span id="gambar2Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 3</label>
                              <div class="col-sm-12">
                                <img id="blah3" src="/{{ $pengumumans->gambar3 }}" style="width:300px; height:200px;" />
                                  <input type="file" onchange="readURL3(this);" class="form-control"  name="gambar3" id="gambar3" multiple accept="image/*" placeholder="Masukkan FIle Gambar 3"  value="{{ $pengumumans->gambar3 }}" >
                                  <span id="gambar3Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">File Download<a id="blah4" href="/{{ $pengumumans->download }}" target="_blank"> Lihat File Sebelumnya</a></label>
                              <div class="col-sm-12">
                                    
                                  <input type="file" onchange="readURL(this);" class="form-control"  name="download" id="download" multiple accept="pdf/*" placeholder="Masukkan FIle Download"  value="{{ $pengumumans->download }}" >                                  
                                  <span id="downloadError " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="col text-center">
                              <button class="btn btn-info" type="submit">update Data</button>
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
    function readURL4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah4')
                    .attr('href', e.target.result)
                    ;
                
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
