<head>
    <title>{{ $tittle }}</title>
</head>

@include('partials.header')
@include('partials.menu')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $page }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('beranda_index') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tracking_alumni_index') }}">{{ $page }}</a></li>
            <li class="breadcrumb-item active">{{ $page2 }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12 d-flex flex-column">
                <div class="card">
                    <div class="col-12 p-3">
                        <div class="row">
                            <h4>{{ $Jpertanyaan->jenis }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row mt-5">
                    <!-- Tahun  Lulus -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-80 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Tahun Lulus</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $tahunLulus }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Alumni -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-80 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Total Alumni</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totAlumni }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-graduation-cap fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sudah  Menjawab -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-80 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Sudah Menjawab</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sudahMenjawabCount }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-check fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belum Menjawab -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-80 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Belum Menjawab</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $belumMenjawabCount }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-clock fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->

                <div class="row">
                    <div class="col col-sm-12 d-flex justify-content-end">
                        <a href="{{ route('tracking_alumni_print_respons', ['tahun' => $tahunLulus, 'jenis_pertanyaan' => $Jpertanyaan->id]) }}" class="btn btn-primary"><i
                                class="fa-solid fa-print"></i>
                            Print
                        </a>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tahun Lulus</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumni as $alumnus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $alumnus->nama }}</td>
                                        <td>{{ $alumnus->kelas }}</td>
                                        <td>{{ $alumnus->tahun_lulus }}</td>
                                        @if ($alumnus->sudah_menjawab)
                                            <td>
                                                <a href="{{ route('tracking_alumni_detailRespons', ['id' => $alumnus->id, 'jenisPertanyaanId' => $alumnus->jenis_pertanyaan_id]) }}"
                                                    class="btn btn-success btn-sm">Sudah Menjawab |
                                                    {{ \Carbon\Carbon::parse($alumnus->created_at_jawaban)->format('d-m-Y H:i:s') }}</a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm">Belum Menjawab</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer');
