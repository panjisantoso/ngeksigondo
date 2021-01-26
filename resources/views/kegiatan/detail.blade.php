@extends('layouts.app1')

@section('tittle', 'Kegiatan')

@section('content')
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{$kegiatans->acara}}</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>{{$kegiatans->acara}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-details-container">
        @if(    $mytime->year <= date('Y', strtotime($kegiatans->tanggal)) && 
                $mytime->month <= date('m', strtotime($kegiatans->tanggal)) &&
                $mytime->day <= date('d', strtotime($kegiatans->tanggal)) && empty($pengumumans)&& 
                $mytime->hour <= date('H', strtotime($kegiatans->jamselesai)))
                <div class="owl-carousel portfolio-details-carousel">
                  <img src="/assets3/img/kegiatanDummy.jpg" style="height:500px;" class="img-fluid" alt="">
                </div>
        @elseif(    $mytime->year >= date('Y', strtotime($kegiatans->tanggal)) && 
                  $mytime->month >= date('m', strtotime($kegiatans->tanggal)) &&
                  $mytime->day >= date('d', strtotime($kegiatans->tanggal)) && !empty($pengumumans)&& 
                  $mytime->hour >= date('H', strtotime($kegiatans->jamselesai)))
                  <div class="owl-carousel portfolio-details-carousel">
                    <img src="/{{ $pengumumans->gambar1 }}" style="height:500px;" class="img-fluid" alt="">
                  </div>
        @else
        <div class="owl-carousel portfolio-details-carousel">
                  <img src="/assets3/img/kegiatanDummy.jpg" style="height:500px;" class="img-fluid" alt="">
                </div>
        @endif
          

          <div class="portfolio-info">
            <h3>Detail Kegiatan<br>
                <small>
                    Status  : 
                    @if(    $mytime->year <= date('Y', strtotime($kegiatans->tanggal)) && 
                            $mytime->month <= date('m', strtotime($kegiatans->tanggal)) &&
                            $mytime->day <= date('d', strtotime($kegiatans->tanggal)) && 
                            $mytime->hour <= date('H', strtotime($kegiatans->jamselesai)))
                        <i style="color:green;">Akan Dilaksanakan</i>
                    @elseif(  $mytime->year >= date('Y', strtotime($kegiatans->tanggal)) && 
                              $mytime->month >= date('m', strtotime($kegiatans->tanggal)) &&
                              $mytime->day >= date('d', strtotime($kegiatans->tanggal)) && 
                              $mytime->hour >= date('H', strtotime($kegiatans->jamselesai)))
                        <i style="color:blue;">Telah Selesai</i>
                    @endif
                </small>
            </h3>
            @if(    $mytime->year <= date('Y', strtotime($kegiatans->tanggal)) && 
                    $mytime->month <= date('m', strtotime($kegiatans->tanggal)) &&
                    $mytime->day <= date('d', strtotime($kegiatans->tanggal)) && 
                    $mytime->hour <= date('H', strtotime($kegiatans->jamselesai)))
                        <ul>
                          <li><strong>Acara</strong>: {{$kegiatans->acara}}</li>
                          <li><strong>Tempat</strong>: {{$kegiatans->tempat}}</li>
                          <li><strong>Tanggal</strong>: {{date('d F Y', strtotime($kegiatans->tanggal))}}</li>
                          <li><strong>Jam Mulai</strong>: {{$kegiatans->jammulai}}</li>
                          <li><strong>Jam Selesai</strong>: {{$kegiatans->jamselesai}}</li>
                        </ul>
            @elseif(  $mytime->year >= date('Y', strtotime($kegiatans->tanggal)) && 
                      $mytime->month >= date('m', strtotime($kegiatans->tanggal)) &&
                      $mytime->day >= date('d', strtotime($kegiatans->tanggal)) && 
                      $mytime->hour >= date('H', strtotime($kegiatans->jamselesai)))
                        <ul>
                          <li><strong>Acara</strong>: {{$kegiatans->acara}}</li>
                          <li><strong>Tempat</strong>: {{$kegiatans->tempat}}</li>
                          <li><strong>Tanggal</strong>: {{date('d F Y', strtotime($kegiatans->tanggal))}}</li>
                          <li><strong>Jam Mulai</strong>: {{$kegiatans->jammulai}}</li>
                          <li><strong>Jam Selesai</strong>: {{$kegiatans->jamselesai}}</li>
                          <li><strong>Jumlah Kehadiran</strong>: {{$kehadiranSemua}} Orang</li>
                          <li><strong>Download File Dokumen :</strong></li>
                          @if(!empty($pengumumans))
                          <a href="/{{ $pengumumans->download }}" class="btn btn-primary" download>Download File</a>
                          @endif
                        </ul>
            @endif
            
          </div>

        </div>

        <div class="portfolio-description">
          
          @if($mytime->year >= date('Y', strtotime($kegiatans->tanggal)) && 
                $mytime->month >= date('m', strtotime($kegiatans->tanggal)) &&
                $mytime->day >= date('d', strtotime($kegiatans->tanggal)) && 
                $mytime->hour >= date('H', strtotime($kegiatans->jamselesai)))
                <h2>Dokumentasi Kegiatan </h2>
                <p>
                  Acara telah selesai, berikut merupakan beberapa dokumentasi kegiatan <strong>{{$kegiatans->acara}}</strong>
                </p>
                @if(!empty($pengumumans))
                  <div class="row">
                    <div class="col-sm-4">
                      <img src="/{{ $pengumumans->gambar1 }}" style="width:400px;">
                    </div>
                    <div class="col-sm-4">
                      <img src="/{{ $pengumumans->gambar2 }}" class="img-fluid" alt="" style="width:400px;">
                    </div>
                    <div class="col-sm-4">
                      <img src="/{{ $pengumumans->gambar3 }}" class="img-fluid" alt="" style="width:400px;">
                    </div>
                </div>
                @endif
          @elseif (Auth::check() && empty($sudahHadir))
          <h2>Hadiri Kegiatan Ini </h2>
          <p>
            Tekan tombol berikut untuk menghadiri kegiatan <strong>{{$kegiatans->acara}}</strong>
          </p>
          <a class="btn btn-primary" id="create-new-kabupaten"   onclick="hadiriKegiatan()" class="btn btn-info">Hadiri Kegiatan</a>
          @elseif(Auth::check() && $sudahHadir)
          <h2>Hadiri Kegiatan Ini </h2>
          <p>
            Anda sudah mengisi kehadiran kegiatan <strong>{{$kegiatans->acara}}</strong>
          </p>
          <a href="javascript:void(0)" data-id="{{ Auth::user()->id }}" class="btn btn-danger" onclick="deleteKehadiran(event.target)">Batal Kehadiran</a>
          @else
          <h2>Hadiri Kegiatan Ini </h2>
          <p>
            Silahkan login terlebih dahulu untuk menghadiri kegiatan <strong>{{$kegiatans->acara}}</strong>
          </p>
          <a class="btn btn-primary" href="{{ route('login') }}" class="btn btn-info">Login</a>
          @endif
        </div>

      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Cancel Confirmation</h5>
                  
                </div>
                <div class="modal-body">
                  <p>Are You Sure Want to Cancel?.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-danger" id="btnDelete">Yes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="post-modal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Kehadiran Kegiatan<br>{{$kegiatans->acara}}, Tanggal {{$kegiatans->tanggal}}</h5>
                    
                  </div>
                  <div class="modal-body">
                      <form name="kehadiranForm" class="form-horizontal">
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                         <input type="hidden" name="id" id="id">
                         <input type="hidden" name="idKegiatan" id="idKegiatan" value="{{$kegiatans->id}}">
                         <input type="hidden" name="idKegiatan1" id="idKegiatan1" value="{{$kegiatans->id}}">
                         <input type="hidden" name="idKegiatan2" id="idKegiatan2" value="{{$kegiatans->id}}">
                         <input type="hidden" name="idKegiatan3" id="idKegiatan3" value="{{$kegiatans->id}}">
                         <div class="form-group">
                              <label for="name" class="col-sm-8">Nama</label>
                              <div class="col-sm-12">
                              @if (Auth::check())
                                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama yang akan Menghadiri" value="{{ Auth::user()->name }}" required disabled>
                              @else
                                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama yang akan Menghadiri" value="" required disabled>
                              @endif    
                                  <span id="namaError" class="alert-message"></span>
                              </div>
                          </div>
                          <br>
                          <div class="form-group">
                              <label for="name" class="col-sm-8">Jumlah yang akan mengikuti</label>
                              <div class="col-sm-12">
                                <select id="jumlahHadir" name="jumlahHadir">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>                                  
                                <span id="jumlahHadirError" class="alert-message"></span>
                              </div>
                          </div>
                          
                          <div id="form_container" >
                            <div id="form1" style="display: none;">
                                
                            </div>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="submitKehadiran()">Confirm</button>
                  </div>
              </div>
            </div>
          </div>
    </section><!-- End Portfolio Details Section -->
@endsection

@push('js')

<script>
    var num;
    $('#jumlahHadir').on('change', function(event) {
        // alert("This is the value selected in solutions: " + $(this).val());
        num = $(this).val();
        // var formHTML = $("#form1").html(); // Get the HTML content of '#form1'
        $('#form_container').html(''); // Clear the contents of form_container
        for(var i = 0; i < num; i++){
            var id = i + 1;
            var formHTML = '<div class="form-group">'+
                                '<label for="name" >Keterangan'+id+'</label>'+
                                '<div class="col-sm-12">'+
                                    '<input type="text" class="form-control" id="keterangan'+id+'" name="keterangan'+id+'" placeholder="Masukkan Keterangan Nama '+id+'" value="" required>'+
                                    '<span id="keterangan'+id+'Error" class="alert-message"></span>'+
                                '</div>'+
                            '</div>';
            $('#form_container').append('<div id="form1">'+formHTML);
        }
    });
</script>

<script>

  $("#post-modal").on('hidden.bs.modal', function(e) {
    $("#id").val('');
    $("#nama").val('');
    $("#jumlahHadir").val('');
    $("#keterangan1").val('');
    $("#keterangan2").val('');
    $("#keterangan3").val('');
    $("#idKegiatan").val('');
    $("#idKegiatan1").val('');
    $("#idKegiatan2").val('');
    $("#idKegiatan3").val('');
  })
</script>
<script>
    function hadiriKegiatan() {
        $("#id").val();
        $('#post-modal').modal('show');
    }
    function submitKehadiran() {
        var id = $('#id').val();
        var jumlahHadir = $('#jumlahHadir').val();
        var keterangan1 = $('#keterangan1').val();
        var keterangan2 = $('#keterangan2').val();
        var keterangan3 = $('#keterangan3').val();
        var idKegiatan = $("#idKegiatan").val();
        var idKegiatan1 = $("#idKegiatan1").val();
        var idKegiatan2 = $("#idKegiatan2").val();
        var idKegiatan3 = $("#idKegiatan3").val();
        var nama = $("#nama").val();
        
        let _url     = `/detailKegiatan`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $('#post-modal').modal('hide');


        $.ajax({
            url: _url,
            type: "POST",
            data: {
            id: id,
            jumlahHadir: jumlahHadir,
            keterangan1: keterangan1,
            keterangan2: keterangan2,
            keterangan3: keterangan3,
            idKegiatan: idKegiatan,
            idKegiatan1: idKegiatan1,
            idKegiatan2: idKegiatan2,
            idKegiatan3: idKegiatan3,
            _token: _token
            },

            success: function(response) {
                if(response.code == 200) {

                if(jumlahHadir != ""){
                    $("#row_"+id+" td:nth-child(2)").html(response.data.jumlaHadir);
                    $("#row_"+id+" td:nth-child(3)").html(response.data.keterangan1);
                    $("#row_"+id+" td:nth-child(4)").html(response.data.keterangan2);
                    $("#row_"+id+" td:nth-child(5)").html(response.data.keterangan3);
                    $("#row_"+id+" td:nth-child(6)").html(response.data.idKegiatan);
                    $("#row_"+id+" td:nth-child(7)").html(response.data.idKegiatan1);
                    $("#row_"+id+" td:nth-child(8)").html(response.data.idKegiatan2);
                    $("#row_"+id+" td:nth-child(9)").html(response.data.idKegiatan3);
                    // location.reload(true);
                } else {
                    $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.jumlahHadir+'</td></tr>');
                }
                $("#id").val('');
                $("#jumlahHadir").val('');
                $("#keterangan1").val('');
                $("#keterangan2").val('');
                $("#keterangan3").val('');
                $("#idKegiatan").val('');
                $("#idKegiatan1").val('');
                $("#idKegiatan2").val('');
                $("#idKegiatan3").val('');
                $("#nama").val('');

                $('#post-modal').modal('hide');

                // location.reload(true);

 
                }
                
                    
                
            },
            error: function(response) {
                // $('#jumlahHadirError').text(response.responseJSON.errors.jumlahHadir);
            // console.log(JSON.stringify(response.responseJSON.errors));
            }
        });
        
        
        setTimeout(function() {
            location.reload();  //Refresh page
        }, 1000);
                
    }

    function deleteKehadiran(event) {
        $('#delete-modal').modal('show');
        var id  = $(event).data("id");
        let _url = `/detailKegiatan/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click', '#btnDelete', function(){
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: _token
            },
            beforeSend: function(){
            $('#delete-modal').modal('hide');
            },
            success: function(response) {
            $("#row_"+id).remove();
            console.log(response.data);
            setTimeout(function() {
                location.reload();  //Refresh page
            }, 1000);
            }
        });
        });
        // setTimeout(function() {
        //     location.reload();  //Refresh page
        // }, 1000);
    }
</script>
@endpush