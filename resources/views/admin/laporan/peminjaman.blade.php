<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <title>Laporan Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 40px;
        }
        .kop-surat img {
            width: 100px;
            height: auto;
        }
        .kop-surat h1 {
            font-size: 24px;
            margin: 10px 0 5px;
        }
        .kop-surat p {
            margin: 5px 0;
        }
        .isi-laporan {
            text-align: justify;
        }
        .isi-laporan h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .isi-laporan p {
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
        }
        .kop-logo {
            width: 180px !important;
            height: auto !important;
            object-fit: contain !important;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <div class="row align-items-justify">
            <div class="col-md-2 text-center">
                <img src="{{asset('/storage/gambar/logo/tut-wuri-handayani.png')}}"
                class="kop-logo" alt="tut wuri">
            </div>
            <div class="col-md-8 text-center">
                <h1>PEMERINTAH KOTA MALANG</h1>
                <h2 style="font-weight: bold">SD NEGERI 4 BANDUNGREJOSARI MALANG</h2>
                <h5>Jalan Danuri No.18, Bandungrejosari, Kec. Sukun, Kota Malang, Jawa Timur 65148</h5>
                <p>Telepon: (0341) 835344 | Email: info@sekolahcontoh.sch.id</p>
            </div>
            <div class="col-md-2 text-center">
                <img src="{{asset('/storage/gambar/logo/logo-sd.png')}}"
                class="kop-logo" alt="Logo Sekolah">
            </div>
        </div>
    </div>

    <hr style="border:0; border-top:5px solid #000000; margin:40px 0, width:100%">

    <div class="isi-laporan">
        <div class="row">
            <h1 class="text-center padding-top">Laporan {{$request->jenis}} Perpustakaan</h1>
        </div>
        <div class="row">
            <p>
                {!! $request->deskripsi !!}
            </p>
            <br>
            <h1 class="text-center pb-1">Peminjaman</h1>
            <div class="row">
                <div class="col-md-3">
                    Total Peminjaman: {{$total_peminjaman}}
                </div>
                <div class="col-md-3">
                    Total Pengembalian: {{$total_pengembalian}}
                </div>
                <div class="col-md-3">
                    Total Buku Telah Dipinjam: {{$total_buku_dipinjam}}
                </div>
                <div class="col-md-3">
                    Total Buku Hilang: {{$total_buku_hilang}}
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-3">
                    Total Peminjaman Periode: {{$total_peminjaman_periode}}
                </div>
                <div class="col-md-3">
                    Total Pengembalian Periode: {{$total_pengembalian_periode}}
                </div>
                <div class="col-md-3">
                    Periodo Mulai dari : {{$request->dari}}
                </div>
                <div class="col-md-3">
                    Periode Hingga saat : {{$request->hingga}}
                </div>
                <div class="col-md-12">
                    Total Buku Dipinjam Periode: {{$total_buku_dipinjam_periode}}
                </div>
                <div class="col-md-12">
                    Total Buku Hilang Pediode: {{$total_buku_hilang_periode}}
                </div>
            </div>
            <div class="row pb-4">
                <h2>Tabel Peminjaman</h2>
                <table class="table pt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah Buku</th>
                            <th>Lama Peminjaman</th>
                            <th>Status</th>
                            <th>tanggal peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($peminjaman as $d)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{$d['jenis_peminjaman']}}</td>
                                @if($d['jenis_peminjaman'] == 'kelompok')
                                    <td>{{$d['id_user']}}</td>
                                @else
                                    <td>{{$d['id_anggota']}}</td>
                                @endif
                                <td>{{$d['pivot_count']}}</td>
                                <td>{{$d['lama_peminjaman']}}</td>
                                <td>{{$d['status']}}</td>
                                <td>{{ Carbon\Carbon::parse($d['created_at'])->format('d-m-Y')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        <!-- Tambahkan lebih banyak paragraf sesuai kebutuhan -->
    </div>

</body>
</html>
