<head>
    <title>{{ $tittle }}</title>
    <!-- Tambahkan link ke file CSS dari SweetAlert2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Sweet Alert */
        .swal2-confirm {
            background-color: #198754 !important;
            border: 1px solid #FFF !important;
        }

        /*Batas Sweet Alert */

        .tagA {
            color: #000 !important;
        }

        #noStep {
            padding: 15px;
            background-color: #588157;
            display: flex;
            justify-content: center;
            font-size: 25px;
            font-weight: 600;
            color: #fff;
        }

        #stepContent {
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: 600;
        }

        #contVerif {
            padding: 20px;
            border-bottom: 8px solid #FF7F3E;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        #cont {
            padding: 20px;
            border-bottom: 8px solid #EF5A6F;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .jPertanyaan {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
    </style>
</head>

@include('partials.header')
@include('partials.menu')


<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">{{ $page }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h4>Selamat Datang!!</h4>
                <div>{{ Auth::user()->name }} ({{ Auth::user()->role->role }})</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card p-0 mb-3">
                    <a href="" class="tagA">
                        <div class="col-12" id="contVerif">
                            <div class="jPertanyaan">VERIFIKASI DATA DIRI</div>
                            <div>Status :</div>
                        </div>
                    </a>
                </div>
            </div>

            @foreach ($jenisPertanyaan as $jp)
                <div class="col-12 col-md-6">
                    <div class="card p-0 mb-3">
                        <a href="{{ route('beranda_fullPertanyaan', $jp->id) }}" class="tagA">
                            <div class="col-12" id="cont">
                                <div class="jPertanyaan">{{ $jp->jenis }}</div>
                                <div>Status :
                                    @php
                                        $sudahMenjawab = $jawaban->has($alumni_id);
                                    @endphp
                                    @if ($sudahMenjawab)
                                        @php
                                            $jawabanAlumni = $jawaban[$alumni_id]->first();
                                        @endphp
                                        <span class="text-success">Sudah Menjawab |
                                            {{ \Carbon\Carbon::parse($jawabanAlumni->created_at)->format('d-m-Y H:m:s') }}</span>
                                    @else
                                        <span class="text-danger">Belum Menjawab</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Script SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
