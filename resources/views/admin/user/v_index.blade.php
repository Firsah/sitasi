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
            <div class="col col-sm-12 d-flex justify-content-start">
                <a href="{{ route('user_tambah') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                    User Admin Baru
                </a>
            </div>

        </div>

        <div class="row mt-5">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0"
                        role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Admin Auth</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                        aria-controls="simple-tabpanel-1" aria-selected="false">Alumni Auth</a>
                </li>
            </ul>

            <div class="tab-content pt-5" id="tab-content">
                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="col-12">
                        <table id="table-user" class="display wrap table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Usename</th>
                                    <th>Role</th>
                                    <th>Terakhir Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($adminUsers as $adminUsr)
                                    <tr align="center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $adminUsr->name }}</td>
                                        <td>{{ $adminUsr->username }}</td>
                                        <td>{{ $adminUsr->role->role }}</td>
                                        <td>
                                            @if ($adminUsr->last_active_at && $adminUsr->last_active_at->diffInMinutes(now()) < 1)
                                                <span class="text-success">Online</span>
                                            @else
                                                {{ $adminUsr->last_active_at ? $adminUsr->last_active_at->timezone('Asia/Jakarta')->format('d-m-Y | H:i:s') : 'Tidak pernah aktif' }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user_edit', $adminUsr->id) }}"
                                                class="btn btn-primary btn-sm"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <form id="delete-form-{{ $adminUsr->id }}"
                                                action="{{ route('user_hapusUser', ['id' => $adminUsr->id]) }}"
                                                method="post" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $adminUsr->id }})"><i
                                                        class="fa-solid fa-trash""></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
                    <div class="col-12">
                        <table class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Usename</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Terakhir Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($alumniUsers as $alumniUSR)
                                    @if ($alumniUSR->role_id == '3')
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $alumniUSR->name }}</td>
                                            <td>{{ $alumniUSR->username }}</td>
                                            <td>{{ \Carbon\Carbon::parse($alumniUSR->alumni->tanggal_lahir)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ $alumniUSR->role->role }}</td>
                                            <td>
                                                @if ($alumniUSR->last_active_at && $alumniUSR->last_active_at->diffInMinutes(now()) < 1)
                                                    <span class="text-success">Online</span>
                                                @else
                                                    {{ $alumniUSR->last_active_at ? $alumniUSR->last_active_at->timezone('Asia/Jakarta')->format('d-m-Y | H:i:s') : 'Tidak pernah aktif' }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
