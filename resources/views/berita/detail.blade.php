@extends('layouts.app1')

@section('tittle', 'Home')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{ $beritas->judul_berita }}</h2>
         
          <ol>
            <li><a href="/">Home</a></li>
            <li>{{ $beritas->judul_berita }}</li>
          </ol>
        </div>
        <img src="/{{ $beritas->gambar }}" class="img-fluid" alt="" style="width:600px;">
        <p > </p>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <p align="justify">
        <i>{{ $beritas->tanggal_berita }}</i>. {{ $beritas->isi_berita }}
        </p>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@push('js')

@endpush