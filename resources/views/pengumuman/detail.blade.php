@extends('layouts.app1')

@section('tittle', 'Home')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>PENGUMUMAN ({{ $pengumumans->tgl_tayang }})</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Pengumuman</li>
          </ol>
        </div>
        
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="owl-carousel portfolio-details-carousel">
          @if(!empty($pengumumans->gambar1))
            <img src="/{{ $pengumumans->gambar1 }}" style="width:400px;">
          @endif
          @if(!empty($pengumumans->gambar2))
            <img src="/{{ $pengumumans->gambar2 }}" style="width:400px;">
          @endif
          @if(!empty($pengumumans->gambar3))
            <img src="/{{ $pengumumans->gambar3 }}" style="width:400px;">
          @endif 
        </div>
        <br>
        <p align="justify">
          <textarea readonly rows="30" cols="47"> {{$pengumumans->isi}}</textarea>            
        </p>
        <br>
        
        <br>
        @if(!empty($pengumumans->download))
        <h3>Download File</h3>
        <p>
            Berikut merupakan beberapa file yang dapat diunduh dari Pengumuman ini<br>
            
                <a href="/{{ $pengumumans->download }}" class="btn btn-primary" download>Download File</a>
            
        </p>
        @endif
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@push('js')

@endpush