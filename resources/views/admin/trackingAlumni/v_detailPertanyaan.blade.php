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
                        <p>{{ $no++ }} . {{ $item->pertanyaan }}</p>
                        @foreach ($item->pilihan as $pilihan)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="" value=""
                                    id="flexRadioDefault1_0">
                                <label class="form-check-label" for="flexRadioDefault1_0">
                                    {{ $pilihan->pilihan }}
                                </label>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer');
