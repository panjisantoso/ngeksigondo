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
            <img src="/{{ $pengumumans->gambar1 }}" style="width:400px;">
            <img src="/{{ $pengumumans->gambar2 }}" style="width:400px;">
            <img src="/{{ $pengumumans->gambar3 }}" style="width:400px;">
        </div>
        <p align="justify">
            {{ $pengumumans->isi }}
        </p>
        <br>
        
        <br>
        <h3>Download File</h3>
        <p>
            Berikut merupakan beberapa file yang dapat diunduh dari Pengumuman ini<br>
            @if(!empty($pengumumans->download))
                <a href="/{{ $pengumumans->download }}" class="btn btn-primary" download>Download File</a>
            @endif
        </p>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@push('js')

@endpush