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
            <form action="{{ route('tracking_alumni_editOrCreate', $jPertanyaan->id) }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
                        <label for="jenis_pertanyaan" class="form-label">Jenis Pertanyaan <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenis" value="{{ $jPertanyaan->jenis }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="publish" class="form-label">Pilih Tahun Lulus Alumni<span
                                class="text-danger">*</span></label>
                        <div class="form-check">
                            @php
                                $published = explode(',', $jPertanyaan->publish);
                            @endphp
                            @foreach ($alumni as $tahunLulus)
                                <input id="tahun_lulus_{{ $loop->index }}" class="form-check-input" type="checkbox"
                                    name="tahun_lulus[]" value="{{ $tahunLulus }}"
                                    {{ in_array($tahunLulus, $published) ? 'checked' : '' }}>
                                <label for="tahun_lulus_{{ $loop->index }}">
                                </label>
                                <!-- Logging -->
                                <p>{{ $tahunLulus }}</p>
                            @endforeach
                        </div>
                        @if ($errors->has('tahun_lulus.*'))
                            <div class="text-danger" style="font-size: 14px;">
                                {{ $errors->first('Tahun Lulus') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('tracking_alumni_index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('partials.footer');
