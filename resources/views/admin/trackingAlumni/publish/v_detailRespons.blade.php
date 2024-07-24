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
        <h1 class="mt-4">{{ $page2 }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('beranda_index') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $page }}</a></li>
            <li class="breadcrumb-item active">{{ $page2 }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12 d-flex flex-column">
                <div class="card">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="sejajar mb-3">
                                    <div class="sub-tittle">Nama</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumni->nama }} </div>
                                </div>
                                <div class="sejajar mb-3">
                                    <div class="sub-tittle">Kelas</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumni->kelas }} </div>
                                </div>
                                <div class="sejajar mb-3">
                                    <div class="sub-tittle">Tahun Lulus</div>
                                    <div class="batas"> : </div>
                                    <div> {{ $alumni->tahun_lulus }} </div>
                                </div>
                                <div class="sejajar">
                                    <div class="sub-tittle">Jenis Pertanyaan</div>
                                    <div class="batas"> : </div>
                                    <div>
                                        @foreach ($jenisPertanyaan as $jenis)
                                            {{ $jenis->jenis }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DETAIL RESPONS  --}}
                        <div class="row mt-5">
                            <div class="col-12">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pertanyaan as $item)
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <p>{{ $no++ }} . {{ $item->pertanyaan }}</p>
                                            @foreach ($item->jawaban as $jawaban)
                                                @if ($jawaban->alumni->id == $alumni->id)
                                                    <p><span style="font-weight:600">Jawaban :
                                                        </span>{{ $jawaban->jawaban }}</p>
                                                    @if ($jawaban->alasan)
                                                        <p><span style="font-weight:600">Alasan :
                                                            </span>{{ $jawaban->alasan }}</p>
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{-- <div class="row mt-3">
                                                <div class="col">
                                                    @if ($item->is_alasan == 'iya')
                                                        <textarea class="form-control" name="" id="" cols="30" name="alasan" rows="1"
                                                            placeholder="Alasan..."></textarea>
                                                    @endif
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <a href="{{ route('tracking_alumni_index') }}"
                                        class="btn btn-secondary">Kembali</a>
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
