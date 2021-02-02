
@extends('layouts.app2')

@section('tittle', 'Data Pengumuman')

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
                <h3 class="mb-0">Data Pengumuman</h3>
              </div>
              <div class="col text-right">
                <a href="/pengumuman/create" class="btn btn-primary" id="create-new-pengumuman">Tambah Pengumuman</a>
              </div>
            </div>
          </div>
          <!-- Light table -->
          <div class="table-responsive" style="padding-left: 25px; padding-right: 25px;">
            <table class="table table align-items-center table-flush" id="laravel_crud" >
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="name">Tanggal Tayang</th>
                  <th scope="col" class="sort" data-sort="name">Tanggal Akhir</th>
                  <th scope="col" class="sort" data-sort="name">Isi Pengumuman</th>
                  <th scope="col" class="sort" data-sort="name">Gambar</th>
                  <th scope="col" class="sort" data-sort="name">File Download</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list">
                @for($i = 1; $i <= sizeof($pengumuman); $i++)
                    <tr id="row_{{$pengumuman[$i-1]->id}}">
                      <td>
                        {{ $i }}
                      </td>
                      <td>
                        {{ $pengumuman[$i-1]->tgl_tayang }}
                      </td>
                      <td>
                        {{ $pengumuman[$i-1]->tgl_akhir }}
                      </td>
                      <td>
                        {{ $pengumuman[$i-1]->isi }}
                      </td>
                      <td>
                        <img src="/{{ $pengumuman[$i-1]->gambar1 }}" style="width:300px;" class="img-fluid" alt=""><br><br>                        
                        <img src="/{{ $pengumuman[$i-1]->gambar2 }}" style="width:300px;" class="img-fluid" alt=""><br><br> 
                        <img src="/{{ $pengumuman[$i-1]->gambar3 }}" style="width:300px;" class="img-fluid" alt="">
                      </td>
                      <td>
                        @if(!empty($pengumuman[$i-1]->download))
                        <a href="/{{ $pengumuman[$i-1]->download }}" target="_blank" class="btn btn-primary">Open File</a>
                        @endif
                      </td>
                      <td>
                        @if(Auth::user()->is_admin == 1)
                          <form action="/admin/pengumuman/{{$pengumuman[$i-1]->id}}/edit" method="GET">
                              <button type="submit" class="btn btn-info">
                                Edit
                              </button>
                          </form>
                        @elseif(Auth::user()->is_admin == 2)
                          <form action="/pengumuman/{{$pengumuman[$i-1]->id}}/edit" method="GET">
                              <button type="submit" class="btn btn-info">
                                Edit
                              </button>
                          </form>
                        @endif
                        
                        <!-- <a href="javascript:void(0)" data-id="{{$pengumuman[$i-1]->id}}" onclick="editPengumuman(event.target)" class="btn btn-info">Edit</a> -->
                        <a href="javascript:void(0)" data-id="{{$pengumuman[$i-1]->id}}" class="btn btn-danger" onclick="deletePengumuman(event.target)">Delete</a>
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
                      <form name="pengumumanForm" class="form-horizontal" enctype="multipart/form-data">
                      @csrf
                         <input type="hidden" name="id" id="id">
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal Tayang</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tgl_tayang" name="tgl_tayang" placeholder="Masukkan Tanggal Tayang" value="" required>
                                  <span id="tglTayangError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Tanggal Akhir</label>
                              <div class="col-sm-12">
                                  <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Masukkan Tanggal Akhir" value="" required>
                                  <span id="tglAkhirError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Isi Pengumuman</label>
                              <div class="col-sm-12">
                                  <input type="Text" class="form-control" id="isi" name="isi" placeholder="Masukkan Isi Pengumuman" value="" required>
                                  <span id="isiPengumumanError" class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 1</label>
                              <div class="col-sm-12">
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="gambar1" id="gambar1" multiple accept="image/*" placeholder="Masukkan FIle Gambar 3">
                                  <span id="gambar1Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 2</label>
                              <div class="col-sm-12">
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="gambar2" id="gambar2" multiple accept="image/*" placeholder="Masukkan FIle Gambar 3">
                                  <span id="gambar2Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Gambar 3</label>
                              <div class="col-sm-12">
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="gambar3" id="gambar3" multiple accept="image/*" placeholder="Masukkan FIle Gambar 3">
                                  <span id="gambar3Error " class="alert-message"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">File Download</label>
                              <div class="col-sm-12">
                                  <input type="file" onchange="readURL(this);" class="form-control" required name="download" id="download" multiple accept="pdf/*" placeholder="Masukkan FIle Download">                                  <span id="downloadError " class="alert-message"></span>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="createPengumuman()">Confirm</button>
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
    $("#id").val('');
    $("#tgl_tayang").val('');
    $("#tgl_akhir").val('');
    $("#isi").val('');
    $("#gambar1").val('');
    $("#gambar2").val('');
    $("#gambar3").val('');
    $("#download").val('');
  })
  
  function editPengumuman(event) {
              var id  = $(event).data("id");
              let _url = `/pengumuman/${id}`;
              $('#tglTayangError').text('');
              $('#tglAkhirError').text('');
              $('#isiPengumumanError').text('');
              $('#gambar1Error').text('');
              $('#gambar2Error').text('');
              $('#gambar3Error').text('');
              $('#downloadError').text('');
              $("#loader").show();
              
              $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                      $("#id").val(response.id);
                      $("#tgl_tayang").val(response.tgl_tayang);
                      $("#tgl_akhir").val(response.tgl_akhir);
                      $("#isi").val(response.isi);
                      $("#gambar1").val(response.gambar1);
                      $("#gambar2").val(response.gambar2);
                      $("#gambar3").val(response.gambar3);
                      $("#download").val(response.download);
                      $('#post-modal').modal('show');
                      $("#loader").hide();
                    }
                }
              });
            }
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

            function addPengumuman() {
              $("#id").val();
              $('#post-modal').modal('show');
            }
          
            
          
            function createPengumuman() {
              var tgl_tayang = $('#tgl_tayang').val();
              var tgl_akhir = $('#tgl_akhir').val();
              var isi = $('#isi').val();
              var gambar1 = $('#gambar1').val();
              var gambar2 = $('#gambar2').val();
              var gambar3 = $('#gambar3').val();
              var download = $('#download').val();
              

              var id = $('#id').val();
          
              let _url     = `/pengumuman`;
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
              if(tgl_tayang!="" && tgl_akhir!="" && isi!="" && gambar1!="" && download!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    id: id,
                    tgl_tayang: tgl_tayang,
                    tgl_akhir: tgl_akhir,
                    isi: isi,
                    gambar1: gambar1,
                    gambar2: gambar2,
                    gambar3: gambar3,
                    download: download,
                    _token: _token
                  },

                  success: function(response) {
                      if(response.code == 200) {

                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.tgl_tayang);
                          $("#row_"+id+" td:nth-child(3)").html(response.data.tgl_akhir);
                          $("#row_"+id+" td:nth-child(4)").html(response.data.isi);
                          $("#row_"+id+" td:nth-child(5)").html(response.data.gambar1);
                          $("#row_"+id+" td:nth-child(6)").html(response.data.gambar2);
                          $("#row_"+id+" td:nth-child(7)").html(response.data.gambar3);
                          $("#row_"+id+" td:nth-child(8)").html(response.data.download);

                          // location.reload(true);
                        } else {
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                          // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                          $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.tgl_tayang+'</td><td>'+response.data.tgl_akhir+'</td><td>'+response.data.isi+'</td><td>'+response.data.gambar1+'</td><td>'+response.data.gambar2+'</td><td>'+response.data.gambar3+'</td><td>'+response.data.download+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPengumuman(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePengumuman(event.target)">Delete</a></td></tr>');
                        }
                        $('#tgl_tayang').val('');
                        $('#tgl_akhir').val('');
                        $('#isi').val('');
                        $('#gambar1').val('');
                        $('#gambar2').val('');
                        $('#gambar3').val('');
                        $('#download').val('');
                        
                        $('#post-modal').modal('hide');

                        // location.reload(true);
    
                        $("#loader").hide();
                      }

                  },
                  error: function(response) {
                    $('#tglTayangError').text(response.responseJSON.errors.tgl_tayang);
                    $('#tglAkhirError').text(response.responseJSON.errors.tgl_akhir);
                    $('#isiPengumumanError').text(response.responseJSON.errors.isi);
                    $('#gambar1Error').text(response.responseJSON.errors.gambar1);
                    $('#gambar2Error').text(response.responseJSON.errors.gambar2);
                    $('#gambar3Error').text(response.responseJSON.errors.gambar3);
                    $('#downloadError').text(response.responseJSON.errors.download);
                    // console.log(JSON.stringify(response.responseJSON.errors));
                  }
                });
              }else{
                alert('Please fill all the field')
              }
            }
          
            
        // });
      
    </script>
    @if(Auth::user()->is_admin == 1)
    <script>
  
      function deletePengumuman(event) {
            $('#delete-modal').modal('show');
            var id  = $(event).data("id");
            let _url = `/admin/pengumuman/${id}`;
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
  
  function deletePengumuman(event) {
        $('#delete-modal').modal('show');
        var id  = $(event).data("id");
        let _url = `/pengumuman/${id}`;
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
