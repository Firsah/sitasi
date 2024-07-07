<head>
    <title>{{ $tittle }}</title>
    <style>
        .sejajar {
            display: flex;
            flex-direction: row;
            justify-content: start;
        }

        .sub-tittle {
            width: 140px;
            font-weight: 600;
            /* border: 1px solid red; */
        }

        .batas {
            padding: 0 10px 0 0;
        }
    </style>
</head>

@include('partials.header')
@include('partials.menu')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $page }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('beranda_index') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('alumni_index') }}">{{ $page }}</a></li>
            <li class="breadcrumb-item active">{{ $page2 }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12 d-flex flex-column">
                <div class="card">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="sejajar">
                                    <div class="sub-tittle"> NIS</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nis }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">NISN</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nisn }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Nama</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nama }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Panggilan</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nama_panggilan }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Kelas</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->kelas }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Tahun Lulus</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->tahun_lulus }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="sejajar">
                                    <div class="sub-tittle">Tanggal lahir</div>
                                    <div class="batas"> : </div>
                                    <div>
                                        {{ $alumniDetail->tempat . ', ' . \Carbon\Carbon::parse($alumniDetail->tanggal_lahir)->translatedFormat('d-m-Y') }}
                                    </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Jenis Kelamin</div>
                                    <div class="batas"> : </div>
                                    <div>
                                        @php
                                            if ($alumniDetail->jenis_kelamin == 'L') {
                                                echo 'Laki-Laki';
                                            } elseif ($alumniDetail->jenis_kelamin == 'P') {
                                                echo 'PEREMPUAN';
                                            } else {
                                                echo 'NULL';
                                            }
                                        @endphp
                                    </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Nama Ayah</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nama_ayah }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Nama Ibu</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->nama_ibu }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Alamat</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->alamat }} </div>
                                </div>
                                <hr>
                                <div class="sejajar">
                                    <div class="sub-tittle">Keterangan</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumniDetail->keterangan }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer');
