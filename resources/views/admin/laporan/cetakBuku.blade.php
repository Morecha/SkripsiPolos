<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Columns Table</title>
    <style>
        .label {
            margin: 10px;
        }
        .school-name {
            font-weight: bold;
        }
        .divider {
            margin: 10px 0;
            border-top: 1px solid #000;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            border: none; /* Remove borders */
            vertical-align: top;
            padding: 10px;
        }
        .label {
            border: 1px solid #000;
            padding: 10px;
            width: calc(50% - 10px); /* Adjusting width to fit four columns with gap */
            box-sizing: border-box;
            text-align: center;
        }
        .label .school-name {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .label .divider {
            width: 100%;
            height: 1px;
            background-color: #000;
            margin: 10px 0;
        }
        .label .book-code,
        .label .pengarang,
        .label .judul,
        .label .copy {
            margin-top: 10px;
        }
        .label .book-code {
            font-size: 20px;
            font-weight: bold;
        }
        .label .pengarang{
            font-size: 18px;
            font-weight: bold;
        }
        .label .judul {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <table class="table">
            @php
                $i = 0;
            @endphp
            @foreach ($data as $data)
                @php
                    $i++;
                @endphp
                @if ($i % 2 == 1)
                    <tr>
                @endif
                <td>
                    <div class="label">
                        <div class="school-name">Perpustakaan</div>
                        <div class="school-name">SDN Bandungrejosari 4 Malang</div>
                        <div>Dinas Pendidikan Kota Malang</div>
                        <div class="divider"></div>
                        <div class="book-code">{{ $data['kodeddc'] }}</div>
                        <div class="pengarang">{{ $data['pengarang'] }}</div>
                        <div class="judul">{{ $data['judul'] }}</div>
                        <div class="copy">Copy {{ $data['copy'] }}</div>
                    </div>
                </td>
                @if ($i % 2 == 0)
                    </tr>
                @endif
            @endforeach
            {{-- <td>
                <div class="label">
                    <div class="school-name">Perpustakaan</div>
                    <div class="school-name">SDN Bandungrejosari 4 Malang</div>
                    <div>Dinas Pendidikan Kota Malang</div>
                    <div class="divider"></div>
                    <div class="book-code">789.101</div>
                    <div class="pengarang">RAN</div>
                    <div class="judul">S</div>
                    <div class="copy">Copy 1</div>
                </div>
            </td> --}}
    </table>
</body>
</html>
