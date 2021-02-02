
@extends('layouts.app2')

@section('tittle', 'Data Kegiatan')

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
                <h3 class="mb-0">Data Kegiatan</h3>
              </div>
              <div class="col text-right">
                <a href="javascript:void(0)" class="btn btn-primary" id="create-new-kegiatan" onclick="addKegiatan()">Tambah Kegiatan</a>
              </div>
            </div>
          </div>
          <!-- Light table -->
          <div class="table-responsive" style="padding-left: 25px; padding-right: 25px;">
            <table class="table table align-items-center table-flush" id="laravel_crud" >
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="name">Acara</th>
                  <th scope="col" class="sort" data-sort="name">Tempat</th>
                  <th scope="col" class="sort" data-sort="name">Alamat</th>
                  <th scope="col" class="sort" data-sort="name">Link Gmaps</th>
                  <th scope="col" class="sort" data-sort="name">Tanggal</th>
                  <th scope="col" class="sort" data-sort="name">Jam Mulai</th>
                  <th scope="col" class="sort" data-sort="name">Jam Selesai</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                @for($i = 1; $i <= sizeof($kegiatan); $i++)
                    <tr id="row_{{$kegiatan[$i-1]->id}}">
                      <td>
                        {{ $i }}
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->acara }}
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->tempat }}
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->alamat }}
                      </td>
                      <td>
                        @if(!empty($kegiatan[$i-1]->link_gmaps))
                          <a href="{{ $kegiatan[$i-1]->link_gmaps }}">Link Google Maps</a>
                        @endif
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->tanggal }}
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->jammulai }}
                      </td>
                      <td>
                        {{ $kegiatan[$i-1]->jamselesai }}
                      </td>
                      <td>
                        <form action="/kegiatan/{{$kegiatan[$i-1]->id}}" method="GET">
                            <button class="btn btn-primary" type="submit">
                                Detail
                            </button>
                        </form>
                        <a href="javascript:void(0)" data-id="{{$kegiatan[$i-1]->id}}" onclick="editKegiatan(event.target)" class="btn btn-info">Edit</a>
                        <!-- <a href="javascript:void(0)" data-id="" class="btn btn-danger" onclick="deleteKegiatan(event.target)">Delete</a> -->
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
                      <form name="kegiatanForm" class="form-horizontal">
                         <input type="hidden" name="id" id="id">
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Acara</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="acara" name="acara" placeholder="Masukkan Nama Kegiatan" value="" required>
                                  <span id="acaraError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tempat</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukkan Tempat" value="" required>
                                  <span id="tempatError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Alamat</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="" required>
                                  <span id="alamatError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Link Google maps</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="link_gmaps" name="link_gmaps" placeholder="Masukkan Link Google Maps" value="" >
                                  <span id="linkGmpasError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" value="" required>
                                  <span id="tanggalError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jam Mulai</label>
                              <div class="col-sm-12">
                                  <input type="time" class="form-control" id="jammulai" name="jammulai" placeholder="Masukkan Jam Mulai" value="" required>
                                  <span id="jamMulaiError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jam Selesai</label>
                              <div class="col-sm-12">
                                  <input type="time" class="form-control" id="jamselesai" name="jamselesai" placeholder="Masukkan Jam Selesai" value="" required>
                                  <span id="jamSelesaiError" class="alert-message"></span>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="createkegiatan()">Confirm</button>
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
    $("#acara").val('');
    $("#tempat").val('');
    $("#alamat").val('');
    $("#link_gmaps").val('');
    $("#tanggal").val('');
    $("#jammulai").val('');
    $("#jamselesai").val('');
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

        // });
      
    </script>

    <script>
      function addKegiatan() {
        $("#id").val();
        $('#post-modal').modal('show');
      }
    </script>
@if(Auth::user()->is_admin == 1)
<script>
      function editKegiatan(event) {
        var id  = $(event).data("id");

        let _url = `/admin/kegiatans/${id}`;
        $('#acaraError').text('');
        $('#tempatError').text('');
        $('#alamatError').text('');
        $('#linkGmapsError').text('');
        $('#tanggalError').text('');
        $('#jamMulaiError').text('');
        $('#jamSelesaiError').text('');
        $("#loader").show();
        
        $.ajax({
          url: _url,
          type: "GET",
          success: function(response) {
              if(response) {
                $("#id").val(response.id);
                $("#acara").val(response.acara);
                $("#tempat").val(response.tempat);
                $("#alamat").val(response.alamat);
                $("#link_gmaps").val(response.link_gmaps);
                $("#tanggal").val(response.tanggal);
                $("#jammulai").val(response.jammulai);
                $("#jamselesai").val(response.jamselesai);
                $('#post-modal').modal('show');
                $("#loader").hide();
              }
          }
        });
      }
    </script>

    <script>
        function createkegiatan() {
              var acara = $('#acara').val();
              var tempat = $('#tempat').val();
              var alamat = $('#alamat').val();
              var link_gmaps = $('#link_gmaps').val();
              var tanggal = $('#tanggal').val();
              var jammulai = $('#jammulai').val();
              var jamselesai = $('#jamselesai').val();
              var id = $('#id').val();

              let _url     = `/admin/kegiatan`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(acara!="" && tempat!="" && tanggal!="" && jammulai!="" && jamselesai!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    id: id,
                    acara: acara,
                    tempat: tempat,
                    alamat: alamat,
                    link_gmaps: link_gmaps,
                    tanggal: tanggal,
                    jammulai: jammulai,
                    jamselesai: jamselesai,
                    _token: _token
                  },

                  success: function(response) {
                      if(response.code == 200) {

                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.acara);
                          $("#row_"+id+" td:nth-child(3)").html(response.data.tempat);
                          $("#row_"+id+" td:nth-child(4)").html(response.data.tanggal);
                          $("#row_"+id+" td:nth-child(5)").html(response.data.jammulai);
                          $("#row_"+id+" td:nth-child(6)").html(response.data.jamselesai);
                          $("#row_"+id+" td:nth-child(7)").html(response.data.alamat);
                          $("#row_"+id+" td:nth-child(8)").html(response.data.link_gmaps);

                          // location.reload(true);
                        } else {
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                          // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.acara+'</td><td>'+response.data.tempat+'</td><td>'+response.data.alamat+'</td><td>'+response.data.link_gmaps+'</td><td>'+response.data.tanggal+'</td><td>'+response.data.jammulai+'</td><td>'+response.data.jamselesai+'</td><td><form action="/kegiatan/" method="GET"><button class="btn btn-primary" type="submit">Detail</button></form><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editKegiatan(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteKegiatan(event.target)">Delete</a></td></tr>');
                        }
                        $('#acara').val('');
                        $('#tempat').val('');
                        $('#alamat').val('');
                        $('#link_gmaps').val('');
                        $('#tanggal').val('');
                        $('#jammulai').val('');
                        $('#jamselesai').val('');

                        $('#post-modal').modal('hide');

                        // location.reload(true);
    
                        $("#loader").hide();
                      }

                  },
                  error: function(response) {
                    $('#acaraError').text(response.responseJSON.errors.acara);
                    $('#tempatError').text(response.responseJSON.errors.tempat);
                    $('#alamatError').text(response.responseJSON.errors.alamat);
                    $('#linkGmapsError').text(response.responseJSON.errors.link_gmaps);
                    $('#tanggalError').text(response.responseJSON.errors.tanggal);
                    $('#jamMulaiError').text(response.responseJSON.errors.jammulai);
                    $('#jamSelesaiError').text(response.responseJSON.errors.jamselesai);
                    // console.log(JSON.stringify(response.responseJSON.errors));
                  }
                });
              }else{
                alert('Please fill all the field')
              }
            }
          
            
    </script>

    <script>          
            function deleteKegiatan(event) {
              $('#delete-modal').modal('show');
              var id  = $(event).data("id");
              let _url = `/admin/kegiatan/${id}`;
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
    </script>
@elseif(Auth::user()->is_admin == 2)
<script>
      function editKegiatan(event) {
        var id  = $(event).data("id");

        let _url = `/kegiatans/${id}`;
        $('#acaraError').text('');
        $('#tempatError').text('');
        $('#alamatError').text('');
        $('#linkGmapsError').text('');
        $('#tanggalError').text('');
        $('#jamMulaiError').text('');
        $('#jamSelesaiError').text('');
        $("#loader").show();
        
        $.ajax({
          url: _url,
          type: "GET",
          success: function(response) {
              if(response) {
                $("#id").val(response.id);
                $("#acara").val(response.acara);
                $("#tempat").val(response.tempat);
                $("#alamat").val(response.alamat);
                $("#link_gmaps").val(response.link_gmaps);
                $("#tanggal").val(response.tanggal);
                $("#jammulai").val(response.jammulai);
                $("#jamselesai").val(response.jamselesai);
                $('#post-modal').modal('show');
                $("#loader").hide();
              }
          }
        });
      }
    </script>

    <script>
        function createkegiatan() {
              var acara = $('#acara').val();
              var tempat = $('#tempat').val();
              var alamat = $('#alamat').val();
              var link_gmaps = $('#link_gmaps').val();
              var tanggal = $('#tanggal').val();
              var jammulai = $('#jammulai').val();
              var jamselesai = $('#jamselesai').val();
              var id = $('#id').val();

              let _url     = `/kegiatan`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(acara!="" && tempat!="" && tanggal!="" && jammulai!="" && jamselesai!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    id: id,
                    acara: acara,
                    tempat: tempat,
                    alamat: alamat,
                    link_gmaps: link_gmaps,
                    tanggal: tanggal,
                    jammulai: jammulai,
                    jamselesai: jamselesai,
                    _token: _token
                  },

                  success: function(response) {
                      if(response.code == 200) {

                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.acara);
                          $("#row_"+id+" td:nth-child(3)").html(response.data.tempat);
                          $("#row_"+id+" td:nth-child(4)").html(response.data.tanggal);
                          $("#row_"+id+" td:nth-child(5)").html(response.data.jammulai);
                          $("#row_"+id+" td:nth-child(6)").html(response.data.jamselesai);
                          $("#row_"+id+" td:nth-child(7)").html(response.data.alamat);
                          $("#row_"+id+" td:nth-child(8)").html(response.data.link_gmaps);

                          // location.reload(true);
                        } else {
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                          // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.acara+'</td><td>'+response.data.tempat+'</td><td>'+response.data.alamat+'</td><td>'+response.data.link_gmaps+'</td><td>'+response.data.tanggal+'</td><td>'+response.data.jammulai+'</td><td>'+response.data.jamselesai+'</td><td><form action="/kegiatan/" method="GET"><button class="btn btn-primary" type="submit">Detail</button></form><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editKegiatan(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteKegiatan(event.target)">Delete</a></td></tr>');
                        }
                        $('#acara').val('');
                        $('#tempat').val('');
                        $('#alamat').val('');
                        $('#link_gmaps').val('');
                        $('#tanggal').val('');
                        $('#jammulai').val('');
                        $('#jamselesai').val('');

                        $('#post-modal').modal('hide');

                        // location.reload(true);
    
                        $("#loader").hide();
                      }

                  },
                  error: function(response) {
                    $('#acaraError').text(response.responseJSON.errors.acara);
                    $('#tempatError').text(response.responseJSON.errors.tempat);
                    $('#alamatError').text(response.responseJSON.errors.alamat);
                    $('#linkGmapsError').text(response.responseJSON.errors.link_gmaps);
                    $('#tanggalError').text(response.responseJSON.errors.tanggal);
                    $('#jamMulaiError').text(response.responseJSON.errors.jammulai);
                    $('#jamSelesaiError').text(response.responseJSON.errors.jamselesai);
                    // console.log(JSON.stringify(response.responseJSON.errors));
                  }
                });
              }else{
                alert('Please fill all the field')
              }
            }
          
            
    </script>

    <script>          
            function deleteKegiatan(event) {
              $('#delete-modal').modal('show');
              var id  = $(event).data("id");
              let _url = `/kegiatan/${id}`;
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
    </script>
@endif
    
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.2.0"></script>

    <script type="text/javascript" src="{{ asset('assets2') }}/js/popper.min.js"></script>
    
@endpush
