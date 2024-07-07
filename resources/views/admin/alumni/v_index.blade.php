<head>
    <title>{{ $tittle }}</title>
    <!-- Tambahkan link ke file CSS dari SweetAlert2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .swal2-confirm {
            background-color: #198754 !important;
            border: 1px solid #FFF !important;
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
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>
        <div class="row">
            <div class="col col-sm-12 d-flex justify-content-end">
                <a href="#" class="btn btn-outline-primary" style="margin-right: 10px"> <i
                        class="fa-solid fa-filter"></i>
                    Kelas
                </a>
                <a href="#" class="btn btn-outline-danger" style="margin-right: 10px"><i
                        class="fa-solid fa-filter"></i>
                    Tahun Lulus
                </a>

                {{-- <a href="{{ route('akuisisiController-update-data') }}" class="btn btn-success btn-outline">
                    <i class='bx bx-refresh' style="margin-right:3px"></i>Update Data
                </a> --}}

                <a href="{{ route('alumni_updateData') }}" class="btn btn-success"><i
                        class="fa-solid fa-arrows-rotate"></i>
                    Update Data Alumni
                </a>
            </div>

        </div>
        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>NAMA SISWA</th>
                            <th>KELAS</th>
                            <th>TAHUN LULUS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($alumniAll as $all)
                            <tr align="center">
                                <td> {{ $no++ }}</td>
                                <td>{{ $all['nis'] }}</td>
                                <td>{{ $all['nisn'] }}</td>
                                <td>{{ $all['nama'] }}</td>
                                <td>{{ $all['kelas'] }}</td>
                                <td>{{ $all['tahun_lulus'] }}</td>
                                <td>
                                    <a href="{{ route('alumni_detailData', $all['id']) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Script SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet Alert -->
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Oke'
            });
        @endif
    </script>

</main>

@include('partials.footer');
