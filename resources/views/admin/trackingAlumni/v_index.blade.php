<head>
    <title>{{ $tittle }}</title>
    <!-- Tambahkan link ke file CSS dari SweetAlert2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- CSS DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
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
            <div class="col col-sm-12">
                <a href="{{ route('tracking_alumni_tambahJenisPertanyaan') }}" class="btn btn-primary"><i
                        class="fa-solid fa-plus"></i>
                    Jenis Pertanyaan
                </a>
                <a href="{{ route('tracking_alumni_tambah') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                    Pertanyaan
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <table id="table-user" class="display wrap table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Pertanyaan</th>
                            <th>Publish(Tahun Lulus)</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($jenis_pertanyaan as $jp)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jp->jenis }}</td>
                                <td>
                                    @if ($jp->publish != 0)
                                        @foreach (explode(',', $jp->publish) as $tahun)
                                            <a href="{{ route('tracking_alumni_TahunLulusDanJpertanyaan', ['tahun' => $tahun, 'jenis_pertanyaan' => $jp->id]) }}"
                                                class="btn btn-success btn-sm rounded-pill">{{ $tahun }}</a>
                                        @endforeach
                                    @endif
                                </td>
                                <td> {{ $jp->created_at }} </td>
                                <td>
                                    <a href="{{ route('tracking_alumni_detailPertanyaan', $jp->id) }}"
                                        class="btn btn-outline-primary btn-sm"><i
                                            class="fa-solid fa-magnifying-glass"></i>
                                        Detail</a>
                                    <a href="{{ route('tracking_alumni_publish', $jp->id) }}"
                                        class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-gear"></i>
                                        publish</a>
                                    {{-- <a href="" class="btn btn-outline-success btn-sm"><i
                                            class="fa-solid fa-edit"></i>
                                        Edit Pertanyaan</a> --}}
                                    <a href="{{ route('tracking_alumni_editJenisPertanyaan', $jp->id) }}"
                                        class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-edit"></i>
                                        Edit Jenis Pertanyaan</a>
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
    <!-- Script DataTables CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    {{-- Script Data  Tables --}}
    <script>
        new DataTable('#table-user', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(1)'
            }
        });
    </script>

    <!-- Sweet Alert -->
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Anda yakin ingin menghapus?',
                text: "Tindakan ini tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            })
        }

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
