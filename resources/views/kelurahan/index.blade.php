
@extends('layouts.app2')

@section('tittle', 'Data Kelurahan')

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
                <h3 class="mb-0">Data Kelurahan</h3>
              </div>
              <div class="col text-right">
                <!-- <a href="javascript:void(0)" class="btn btn-primary" id="create-new-kabupaten" onclick="addKabupaten()">Tambah Kabupaten</a> -->
              </div>
            </div>
          </div>
          <!-- Light table -->
          <div class="table-responsive" style="padding-left: 25px; padding-right: 25px;">
            <table class="table table align-items-center table-flush" id="laravel_crud" >
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="name">Nama Kelurahan</th>
                  <th scope="col" class="sort" data-sort="name">Nama Kecamatan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                @for($i = 1; $i <= sizeof($kelurahan); $i++)
                  <tr id="row_{{$kelurahan[$i-1]->id}}">
                    <td>
                    {{ $i }}
                    </td>
                    <td>
                    {{ $kelurahan[$i-1]->nama_kelurahan }}
                    </td>
                    <td>
                    {{ $kelurahan[$i-1]->nama_kecamatan }}
                    </td>
                    <td>
                      <a href="javascript:void(0)" data-id="{{ $kelurahan[$i-1]->id }}" onclick="editKabupaten(event.target)" class="btn btn-info">Edit</a>
                      <a href="javascript:void(0)" data-id="{{ $kelurahan[$i-1]->id }}" class="btn btn-danger" onclick="deleteKabupaten(event.target)">Delete</a>
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
                      <form name="lkabupatenForm" class="form-horizontal">
                         <input type="hidden" name="id" id="id">
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Nama Kabupaten</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="nama_kabupaten" name="nama_kabupaten" placeholder="Masukkan Nama Kabupaten" value="" required>
                                  <span id="namaKabupatenError" class="alert-message"></span>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="createKabupaten()">Confirm</button>
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
    $("#nama_kabupaten").val('');
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

            function addKabupaten() {
              $("#id").val();
              $('#post-modal').modal('show');
            }
          
            function editKabupaten(event) {
              var id  = $(event).data("id");
              let _url = `/kabupaten/${id}`;
              $('#namaKabupatenError').text('');
              $("#loader").show();
              
              $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                      $("#id").val(response.id);
                      $("#nama_kabupaten").val(response.nama_kabupaten);
                      $('#post-modal').modal('show');
                      $("#loader").hide();
                    }
                }
              });
            }
          
            function createKabupaten() {
              var nama_kabupaten = $('#nama_kabupaten').val();
              var id = $('#id').val();
          
              let _url     = `/kabupaten`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(nama_kabupaten!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    id: id,
                    nama_kabupaten: nama_kabupaten,
                    _token: _token
                  },

                  success: function(response) {
                      if(response.code == 200) {

                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.nama_kabupaten);

                          // location.reload(true);
                        } else {
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                          // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.nama_kabupaten+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editKabupaten(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteKabupaten(event.target)">Delete</a></td></tr>');
                        }
                        $('#nama_kabupaten').val('');
          
                        $('#post-modal').modal('hide');

                        // location.reload(true);
    
                        $("#loader").hide();
                      }

                  },
                  error: function(response) {
                    $('#namaKabupatenError').text(response.responseJSON.errors.nama_kabupaten);
                    // console.log(JSON.stringify(response.responseJSON.errors));
                  }
                });
              }else{
                alert('Please fill all the field')
              }
            }
          
            function deleteKabupaten(event) {
              $('#delete-modal').modal('show');
              var id  = $(event).data("id");
              let _url = `/kabupaten/${id}`;
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
