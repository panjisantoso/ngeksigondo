
@extends('layouts.app2')

@section('tittle', 'Jenis Layanan')

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
                <a href="javascript:void(0)" class="btn btn-primary" id="create-new-layanan" onclick="addLayanan()">Tambah Kegiatan</a>
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
                  <th scope="col" class="sort" data-sort="name">Tanggal</th>
                  <th scope="col" class="sort" data-sort="name">Jam Mulai</th>
                  <th scope="col" class="sort" data-sort="name">Jam Selesai</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                
                    <tr id="">
                      <td>
                        1.
                      </td>
                      <td>
                        Acara Pelatihan Paguyuban
                      </td>
                      <td>
                        Rumah Pak Joko
                      </td>
                      <td>
                        2021-01-14
                      </td>
                      <td>
                        13:00
                      </td>
                      <td>
                        16:00
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-id="" onclick="editLayanan(event.target)" class="btn btn-info">Edit</a>
                        <a href="javascript:void(0)" data-id="" class="btn btn-danger" onclick="deleteLayanan(event.target)">Delete</a>
                      </td>
                    </tr>
                  
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
                      <form name="layananForm" class="form-horizontal">
                         <input type="hidden" name="layanan_id" id="layanan_id">
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Acara</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Nama Kegiatan" value="" required>
                                  <span id="namaLayananError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tempat</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Tempat" value="" required>
                                  <span id="namaLayananError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Tanggal" value="" required>
                                  <span id="namaLayananError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jam Mulai</label>
                              <div class="col-sm-12">
                                  <input type="time" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Jam Mulai" value="" required>
                                  <span id="namaLayananError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jam Selesai</label>
                              <div class="col-sm-12">
                                  <input type="time" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Jam Selesai" value="" required>
                                  <span id="namaLayananError" class="alert-message"></span>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="createLayanan()">Confirm</button>
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
