<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pengisian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 600px;
            margin: auto;
            margin-top: 80px;
            padding: 10px;
            border: 2px solid #000;
            border-radius: 0px;
        }

        .header {
            text-align: center;
            padding: 10px;
            border-bottom: 3px solid #000;
        }

        .header .text-1 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header .text-2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header .text-3 {
            font-style: italic;
        }

        .content-head {
            margin: 25px 0px;
            font-size: 14px;
            /* border: 1px solid red; */
        }


        .sejajar {
            display: flex;
            flex-direction: row;
            justify-content: start;
            margin-bottom: 8px;
        }

        .sub-tittle {
            width: 140px;
            font-weight: 600;
            /* border: 1px solid red; */
        }

        .batas {
            padding: 0 10px 0 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
        }

        th {
            background-color: #3a5a40;
            color: #fff;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="text-1">BUKTI PENGISIAN TRACKING ALUMNI</div>
            <div class="text-2">MI MA'ARIF NU BANTERAN</div>
            <div class="text-3">Alamat : Desa Banteran RT 02 RW 11 Kecamatan Sumbang 5381 Telp.(0281) 6445674</div>
        </div>
        <div class="content-head">
            <div class="sejajar">
                <span class="sub-tittle">Jenis Pertanyaan</span>
                <span class="batas"> : {{ $jenisPertanyaan->jenis }}</span>
                <span> </span>
            </div>
            <div class="sejajar">
                <span class="sub-tittle">Tahun Lulus</span>
                <span class="batas"> : {{ $tahunLulus }}</span>
                <span> </span>
            </div>
            <div class="sejajar">
                <span class="sub-tittle">Total Alumni</span>
                <span class="batas"> : {{ $totAlumni }}</span>
                <span> </span>
            </div>
            <div class="sejajar">
                <span class="sub-tittle">Sudah Menjawab</span>
                <span class="batas"> : {{ $sudahMenjawabCount }}</span>
                <span> </span>
            </div>
            <div class="sejajar">
                <span class="sub-tittle">Belum Menjawab</span>
                <span class="batas"> : {{ $belumMenjawabCount }}</span>
                <span> </span>
            </div>
        </div>
        <div class="content-isi mt">
            <div>Berikut adalah bukti bahwa alumni telah melakukan pengisian tracking alumni:</div>
            <table border="1" cellspacing="1">
                <tr align="center" style="font-size: 14px !important;">
                    <th>No</th>
                    <th>Nama Alumni</th>
                    <th>Kelas</th>
                    <th>Keterangan</th>
                    <th>Tanggal Mengisi</th>

                </tr>
                @foreach ($alumni as $alumnus)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $alumnus->nama }}</td>
                        <td>{{ $alumnus->kelas }}</td>
                        <td>{{ ($alumnus->sudah_menjawab) ? 'Sudah Menjawab' : 'Belum Menjawab' }}</td>
                        <td>{{ ($alumnus->sudah_menjawab) ? \Carbon\Carbon::parse($alumnus->created_at_jawaban)->format('d-m-Y H:i:s') : '-' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
