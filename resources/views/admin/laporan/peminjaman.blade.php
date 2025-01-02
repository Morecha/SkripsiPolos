<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .kop-surat {
            width: 100%;
            text-align: center;
            margin-bottom: 40px;
        }

        .kop-logo {
            width: 100px; /* Ukuran logo */
            height: auto;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h1 {
            font-size: 20px;
            margin: 10px 0 5px;
        }

        .kop-text h2 {
            font-size: 16px;
            margin: 5px 0;
            font-weight: bold;
        }

        .kop-text p {
            margin: 5px 0;
            font-size: 12px;
        }
        hr {
        border: 0;
        border-top: 5px solid #000;
        margin: 20px 0;
        width: 100%;
        }

        .isi-laporan {
            margin: 20px 0;
        }

        .text-center {
            text-align: center;
        }

        .padding-top {
            padding-top: 20px;
        }

        .pb-1 {
            padding-bottom: 10px;
        }

        .pb-2 {
            padding-bottom: 20px;
        }

        .pb-4 {
            padding-bottom: 40px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            /* margin-bottom: 50px; */
        }

        .col {
            flex: 1;
            padding: 3px;
            box-sizing: border-box;
        }

        .col-3 {
            flex: 0 0 25%;
        }

        .col-12 {
            flex: 0 0 100%;
        }
    </style>
</head>
<body>

    <table class="kop-surat" cellspacing="0" cellpadding="0">
        <tr>
            <!-- Logo kiri -->
            <td style="width: 20%; text-align: center;">
                <img src="{{$base64TutWuri}}" class="kop-logo" alt="Logo Tut Wuri">
            </td>
            <!-- Teks tengah -->
            <td class="kop-text" style="width: 60%; text-align: center;">
                <h1>PEMERINTAH KOTA MALANG</h1>
                <h2>SD NEGERI 4 BANDUNGREJOSARI MALANG</h2>
                <p>Jalan Danuri No.18, Bandungrejosari, Kec. Sukun, Kota Malang, Jawa Timur 65148</p>
                <p>Telepon: (0341) 835344 | Email: info@sekolahcontoh.sch.id</p>
            </td>
            <!-- Logo kanan -->
            <td style="width: 20%; text-align: center;">
                <img src="{{$base64SD}}" class="kop-logo" alt="Logo Sekolah">
            </td>
        </tr>
    </table>

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
                                <td>{{ $d->jenis_peminjaman }}</td>
                                <td>{{ $d->nama_peminjaman }}</td>
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
