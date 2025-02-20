<head>
    <title>{{ $tittle }}</title>
    <style>
        textarea {
            border-top: 1px solid #fff !important;
            border-left: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
        }

        .fa-download {
            color: #000;
        }

        .ket-cetak {
            color: #000;
            font-size: 16px;
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
            @if (auth()->check() && !auth()->user()->Role->role == 'alumni')
                <li class="breadcrumb-item"><a href="{{ route('tracking_alumni_index') }}">Tracking Alumni</a></li>
            @else
                <li class="breadcrumb-item">Tracking Alumni</li>
            @endif
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card p-3">
                    <h5>Jenis Pertanyaan : {{ $jenis_pertanyaan->jenis }} </h5>
                </div>
            </div>

            @if ($sudahMenjawab)
                <div class="row mt-5 mb-4">
                    <div class="col-12">
                        <div class="alert alert-success">
                            Selamat, Anda Sudah Menginput Jawaban!!
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('beranda_cetakBuktiPengisian', ['id' => $jenis_pertanyaan->id]) }}">
                            <div class="mb-4">
                                <i class="fa-solid fa-download fa-2xl"></i>
                            </div>
                            <div class="ket-cetak"><button class="btn btn-outline-success btn-sm">Cetak Bukti
                                    Pengisian!!</button>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                {{-- DAFTAR PERTANYAAN  --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="{{ route('responsTracking_responsAlumni') }}" method="post">
                            @csrf
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pertanyaan as $item)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <p>{{ $no++ }} . {{ $item->pertanyaan }}</p>
                                        @foreach ($item->pilihan as $pilihan)
                                            @if (!is_null($pilihan->pilihan))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="pertanyaan[{{ $item->id }}]"
                                                        value=" {{ $pilihan->pilihan }}"
                                                        id="flexRadioDefault{{ $item->id }}_{{ $loop->index }}">
                                                    <label class="form-check-label"
                                                        for="flexRadioDefault{{ $item->id }}_{{ $loop->index }}">
                                                        {{ $pilihan->pilihan }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach

                                        <!-- menginput secara  tersempunyi jenis  pertanyaan -->
                                        <input type="hidden" name="jenis_pertanyaan_id[{{ $item->id }}]"
                                            value="{{ $item->jenis_pertanyaan_id }}">

                                        <div class="row mt-3">
                                            <div class="col">
                                                @if ($item->is_alasan == 'iya')
                                                    <textarea class="form-control" name="alasan[{{ $item->id }}]" id="" cols="30" name="alasan"
                                                        rows="1" placeholder="Alasan..."></textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row mb-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-success">Kirim</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>
</main>

@include('partials.footer');
