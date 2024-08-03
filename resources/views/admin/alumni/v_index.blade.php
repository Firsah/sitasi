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
                <button href="#" class="btn btn-outline-primary" style="margin-right: 10px" data-bs-toggle="modal"
                    data-bs-target="#kelasModal"> <i class="fa-solid fa-filter"></i>
                    Kelas
                </button>
                <button class="btn btn-outline-secondary" style="margin-right: 10px" data-bs-toggle="modal"
                    data-bs-target="#tahunLulusModal"><i class="fa-solid fa-filter"></i>
                    Tahun Lulus
                </button>

                <a href="{{ route('alumni_index') }}" style="margin-right: 10px" class="btn btn-danger"><i
                        class='bx bx-reset' style="margin-right:3px"></i>Reset Filter</a>
                {{-- <a href="{{ route('akuisisiController-update-data') }}" class="btn btn-success btn-outline">
                    <i class='bx bx-refresh' style="margin-right:3px"></i>Update Data
                </a> --}}
                @if (auth()->check() && (auth()->user()->Role->role == 'super admin' || auth()->user()->Role->role == 'staff tracking alumni'))
                    <a href="{{ route('alumni_updateData') }}" class="btn btn-success"><i
                            class="fa-solid fa-arrows-rotate"></i>
                        Update Data Alumni
                    </a>
                @endif
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

    <!-- MODAL FILTER TAHUN  LULUS  -->
    <div class="modal fade" style="padding-right: 0px; width: 100% !important;" id="tahunLulusModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title" id="exampleModalLabel1">Filter Data Berdasarkan Tahun
                        Lulus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" action="" method="GET">
                        <div class="row g-2">
                            <div class="col mb-0">
                                <!-- <label for="produk" class="form-label">Produk</label> -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        @php
                                            $selectdTahunLulus = request('tahun_lulus', []);
                                            $anySelected = !empty($selectdTahunLulus);
                                        @endphp
                                        <!-- Checbox untuk mengontrol semua produk -->
                                        <div class="form-check col-md-12 mb-3">
                                            <input type="checkbox" id="select_all" class="form-check-input"
                                                {{ !$anySelected ? 'checked' : '' }}>
                                            <label for="select_all" style="margin-left: 10px"><span
                                                    style="font-weight: 600">ALL
                                                    TAHUN LULUS</span></label><br>
                                        </div>

                                        @foreach ($dataTahunLulus as $tahunLulus)
                                            @php
                                                $checked =
                                                    !$anySelected || in_array($tahunLulus, (array) $selectdTahunLulus)
                                                        ? 'checked'
                                                        : '';
                                            @endphp
                                            <div class="form-check col-md-12 mb-3">
                                                <input id="tahun_lulus_{{ $loop->index }}" name="tahun_lulus[]"
                                                    type="checkbox" class="form-check-input product-checkbox"
                                                    value="{{ $tahunLulus }}" {{ $checked }}>
                                                <label for="tahun_lulus_{{ $loop->index }}"
                                                    style="margin-left: 10px;">{{ $tahunLulus }}</label><br>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4" style="display: none;">
                            <!-- Menambahkan hidden input untuk menyimpan Team yang dipilih -->
                            @foreach ($dataKelas as $kelas)
                                @php
                                    $checkedKelas = in_array($kelas, (array) request('kelas', [])) ? 'checked' : '';
                                @endphp
                                <input id="kelas_{{ $loop->index }}" name="kelas[]" type="checkbox"
                                    class="form-check-input" value="{{ $kelas }}" {{ $checkedKelas }}>
                                <label for="kelas_{{ $loop->index }}">{{ $kelas }}</label><br>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL FILTER KELAS -->
    <div class="modal fade" id="kelasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Filter Data Berdasarkan Kelas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filterFormTeam" action="" method="GET">
                        <div class="row g-2">
                            <div class="col mb-0">
                                <!-- <label for="team" class="form-label">Team</label> -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        @php
                                            $selectedKelas = request('kelas', []);
                                            $anySelected = !empty($selectedKelas);
                                        @endphp
                                        <!-- Checbox  untuk mengontrol semua platfrom -->
                                        <div class="form-check col-md-12 mb-3">
                                            <!-- <input type="checkbox" id="select_all_platfrom" class="form-check-input" checked> -->
                                            <input type="checkbox" id="select_all_team" class="form-check-input"
                                                {{ !$anySelected ? 'checked' : '' }}>
                                            <label for="select_all_team" style="margin-left: 10px"><span
                                                    style="font-weight: 600">ALL
                                                    KELAS</span></label><br>
                                        </div>

                                        @foreach ($dataKelas as $kelas)
                                            @php
                                                $checked =
                                                    !$anySelected || in_array($kelas, (array) $selectedKelas)
                                                        ? 'checked'
                                                        : '';
                                            @endphp
                                            <div class="form-check col-md-12 mb-3">
                                                <input id="kelas_{{ $loop->index }}" name="kelas[]" type="checkbox"
                                                    class="form-check-input team-checkbox"
                                                    value="{{ $kelas }}" {{ $checked }}>
                                                <label for="kelas_{{ $loop->index }}"
                                                    style="margin-left: 10px;">{{ $kelas }}</label><br>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Menambahkan hidden input untuk menyimpan Produk yang dipilih -->
                        <div class="col-md-6 mb-4" style="display: none;">
                            @foreach ($dataTahunLulus as $tahunLulus)
                                @php
                                    $checked = in_array($tahunLulus, (array) request('tahun_lulus', []))
                                        ? 'checked'
                                        : '';
                                @endphp
                                <div class="form-check col-md-12 mb-3">
                                    <input id="tahun_lulus_{{ $loop->index }}" name="tahun_lulus[]" type="checkbox"
                                        class="form-check-input" value="{{ $tahunLulus }}" {{ $checked }}>
                                    <label for="tahun_lulus_{{ $loop->index }}">{{ $tahunLulus }}</label><br>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
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
