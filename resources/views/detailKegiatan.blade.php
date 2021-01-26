@extends('layouts.app1')

@section('tittle', 'Kegiatan')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><b>{{$kegiatans->acara}}</b></h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Berita</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
      <img src="assets3/img/berita1.jpg" class="img-fluid" alt="" style="width:600px;">
        <p align="justify">
        Perayaan Hari Ulang Tahun ke-225 Kota Denpasar disemarakkan pentas wayang kulit semalam suntuk menampilkan dalang bapak-anak Ki Sutio-Gatot dari Solo, Jawa Tengah, dengan lakon Gatotkaca Jadi Ratu.

Pentas wayang kulit yang didukung 35 kru, baik penabuh gamelan maupun tujuh sinden di arena pameran publik dan pasar rakyat Lapangan Lumintang, Jalan Gatot Subroto, Denpasar, itu berlangsung semarak dihadiri ratusan penonton yang rela begadang sejak Sabtu (2/3) malam hingga Minggu subuh.

Menurut Mardi Kuncoro selaku ketua panitia kegiatan, pentas wayang dengan biaya diskon Rp40 juta dari tarif normal Rp50 juta itu didukung 10 lintas paguyuban warga asal Pulau Jawa yang ada di Bali, selain sumbangan perorangan.

Perhimpunan warga pendatang di Pulau Dewata tersebut terdiri Paguyuban Ngeksigondo Yogyakarta, Osas Solo, Rumpun Banyumasan, Giri Putra Wonosari Kabupaten Gunung Kidul, Kusuma Klaten, Giriraharja Wonogiri, Sadulur Blitar (Gustar), Asosiasi Perajin Batik dan Sablon (APBS) Bali, Rukun Warga Muslim (RWN Suci) Pekambingan, dan Pedagang Kaki Lima Kertawijaya.

Pementasan tersebut terasa semarak sejak awal dipentaskan Jaran Kepang atau Kuda Lumping menampilkan Aji, siswa kelas 6 SD Saraswati Denpasar bersama adiknya, Wahyu, dari Gustar, disusul dua tarian dari Solo, anggota kru wayang kulit.

Pertunjukan wayang kulit khas Jawa yang di Bali tergolong langka itu bertambah semarak diwarnai sambutan meriah ratusan penonton ketika ditampilkan selingan sejumlah lagu campur sari oleh para pesinden, di antaranya istri dalang dan calon menantunya yang direncanakan dipersunting oleh dalang muda Gatot pada Mei 2013.

"Berkat dukungan 10 lintas paguyuban yang menyumbang sesuai kemampuan masing-masing ditambah bantuan perorangan, kami bisa menutup seluruh biaya mendatangkan kru wayang kulit ini," kata Mardi Kuncoro yang sukses mengelola usaha Andhes Entertainment di Jalan Teuku Umar, Denpasar.

Lakon wayang Gatotkaca Jadi Ratu menceritakan perjuangan Setiaki dan Pandawa melawan Kurawa untuk "melahirkan" Gatotkaca menjadi ratu setelah melalui kawah candra dimuka guna memimpin Pringgodani, negara di Astina, setelah gugurnya Pandu.

"Sayang pementasan ini terlalu banyak selingan campur sari dari sinden Putri, Hesti, Dita, maupun dari pihak lain, sehingga cerita pewayangannya banyak dipangkas. Tetapi pertunjukan ini mampu mengocok perut penonton, apalagi dengan tampilnya sinden banci Rio Hana," kata Triono Basuki, salah seorang penonton yang mengaku bisa mendalang.


Sumber: Antara
        </p>
      </div>
    </section>

  </main><!-- End #main -->
@endsection

@push('js')
<script>

</script>
@endpush