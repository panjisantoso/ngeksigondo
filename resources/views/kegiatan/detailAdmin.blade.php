
@extends('layouts.app2')

@section('tittle', 'Detail Kegiatan')

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
      <div class="col-md-8">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
              <h2 class="mb-0">Kegiatan {{ $kegiatans->acara }}</h2>
                
              </div>
              <div class="col text-right">
                <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Tambah Kegiatan</a> -->
              </div>
            </div>
          </div>
          
          <div class="card-header border-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-longatitude">Tanggal : {{ date('d F Y', strtotime($kegiatans->tanggal)) }}</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-longatitude">Tempat : {{ $kegiatans->tempat }}</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-longatitude">Jam : {{ $kegiatans->jammulai }}-{{ $kegiatans->jamselesai }}</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                @if(!empty($kehadiranSemua))
                                <label class="form-control-label" for="input-longatitude">Jumlah Kehadiran : {{ $kehadiranSemua }} orang</label>
                                @else
                                <label class="form-control-label" for="input-longatitude">Jumlah Kehadiran : 0 orang</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
          <!-- Light table -->
          <div class="table-responsive" style="padding-left: 25px; padding-right: 25px;">
            <h3 class="mb-0">Data Kehadiran</h3>

            <table class="table table align-items-center table-flush" id="laravel_crud" >
            <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Update Kehadiran</a> -->
              <thead class="thead-light">
              <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="name">Nama Peserta</th>
                  <th scope="col" class="sort" data-sort="name">Hadir</th>
                  <th scope="col" class="sort" data-sort="name">Tidak Hadir</th>
                  <th scope="col" class="sort" data-sort="name">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                @for($i = 1; $i <= sizeof($kehadirans); $i++)
                
                    <tr id="row_{{$kehadirans[$i-1]->id}}">
                    <form action="/kegiatans/{{$kehadirans[$i-1]->id}}" method="POST">
                    @csrf
                    @method("PUT")
                        <td>
                            {{ $i }}
                        </td>
                        <td>
                            {{ $kehadirans[$i-1]->keterangan }}
                        </td>
                        <td>
                            <input type="radio" id="kehadiran" name="kehadiran" value="1" {{ ($kehadirans[$i-1]->kehadiran=="1")? "checked" : "" }}>
                        </td>
                        <td>
                            <input type="radio" id="kehadiran" name="kehadiran" value="0" {{ ($kehadirans[$i-1]->kehadiran=="0")? "checked" : "" }}>
                        </td>
                        <td>
                            <div class="col text-center">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </td>
                        </form>
                    </tr>
               
                @endfor
              </tbody>
              <tfoot style="background-color: lavender;">
            
              </tfoot>
              
            </table>

          </div>
          

          <!-- Card footer -->
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
              <h2 class="mb-0">Data Pengumuman</h2>
                
              </div>
              <div class="col text-right">
                <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Tambah Kegiatan</a> -->
              </div>
            </div>
          </div>
          
          <div class="card-header border-0">
                    <div class="row">
                    @if($checkKegiatan == 1)
                      <form action="/addPengumuman" method="POST" class="form" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="{{$kegiatans->id}}">
                          
                          <div class="col-lg-12">
                              <div class="form-group">
                                  <label class="form-control-label" for="input-latitude">Gambar </label>
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="gambar[]" id="gambar" multiple accept="image/*" placeholder="Masukkan FIle Gambar">
                                  
                              </div>
                          </div>
                          
                          <div class="col-lg-12">
                              <div class="form-group">
                                  <label class="form-control-label" for="input-latitude">File Dokumen</label>
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="dokumen" id="dokumen" multiple accept="pdf/*" placeholder="Masukkan FIle Download">
                              </div>
                          </div>
                          <div class="col text-center">
                              <button class="btn btn-info" type="submit">Tambah Data</button>
                          </div>
                        </form>
                        @else
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-latitude">Gambar</label>
                                </div>
                            </div>
                        
                            @for($i=1; $i<=sizeof($gambarKegiatan); $i++)
                                <form action="/hapusGambar/{{ $gambarKegiatan[$i-1]->id }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <img src="/{{ $gambarKegiatan[$i-1]->gambar }}" style="width:180px;">     
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-minus"></i>
                                            </button>   
                                        </div>
                                    </div>
                                </form>
                            @endfor
                            <form action="/addPengumuman" method="POST" class="form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="{{$kegiatans->id}}">
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="file" onchange="readURL(this);" class="form-control" required name="gambar[]" id="gambar" multiple accept="image/*" placeholder="Masukkan FIle Gambar">
                                        <button class="btn btn-info" type="submit">Tambah Gambar</button>
                                    </div>
                                </div>
                            </form>
                            
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <label class="form-control-label" for="input-latitude">File Dokumen</label>
                                      @if(!empty($dokumenKegiatan->dokumen))
                                      <a href="/{{ $dokumenKegiatan->dokumen }}" download>Download</a>   
                                      @endif                      
                                  </div>
                              </div>
                              @if(!empty($dokumenKegiatan->id))
                                <form action="/gantiDokumen/{{ $dokumenKegiatan->id }}" method="POST" class="form" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                              @else
                                <form action="/addPengumuman" method="POST" class="form" enctype="multipart/form-data">
                                @csrf
                                
                              @endif
                                 
                                  <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="{{$kegiatans->id}}">
                                  
                                  <div class="col-lg-12">
                                      <div class="form-group">
                                          <input type="file" onchange="readURL(this);" class="form-control" required name="dokumen" id="dokumen" multiple accept="pdf/*" placeholder="Masukkan FIle Download">
                                          @if(!empty($dokumenKegiatan->id))
                                            <button class="btn btn-info" type="submit">Ubah Dokumen</button>
                                          @else
                                            <button class="btn btn-info" type="submit">Tambah Dokumen</button>
                                          @endif
                                      </div>
                                  </div>
                              </form>
                            
                        @endif
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
function readURL(input) {
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
