<head>
    <title>{{ $tittle }}</title>
    <style>
        textarea {
            border-top: 1px solid #fff !important;
            border-left: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
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
            <li class="breadcrumb-item"><a href="{{ route('tracking_alumni_index') }}">Tracking Alumni</a></li>
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card p-3">
                    <h5>Jenis Pertanyaan : {{ $jenis_pertanyaan->jenis }} </h5>
                </div>
            </div>
            {{-- DAFTAR PERTANYAAN  --}}
            <div class="row mt-5">
                <div class="col-12">
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
                                                name="pertanyaan[{{ $item->id }}]" value=" {{ $pilihan->pilihan }}"
                                                id="flexRadioDefault{{ $item->id }}_{{ $loop->index }}">
                                            <label class="form-check-label"
                                                for="flexRadioDefault{{ $item->id }}_{{ $loop->index }}">
                                                {{ $pilihan->pilihan }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="row mt-3">
                                    <div class="col">
                                        @if ($item->is_alasan == 'iya')
                                            <textarea class="form-control" name="" id="" cols="30" name="alasan" rows="1"
                                                placeholder="Alasan..."></textarea>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tracking_alumni_index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer');
