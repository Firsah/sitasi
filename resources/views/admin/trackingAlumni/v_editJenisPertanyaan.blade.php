<head>
    <title>{{ $tittle }}</title>
</head>

@include('partials.header')
@include('partials.menu')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $page }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('tracking_alumni_index') }}">Tracking
                    Alumni</a></li>
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>
        <div class="row mt-5">
            <form action="{{ route('tracking_alumni_prosesEditJenisPertanyaan', $jenis->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div id="formContainer">
                        <div class="mb-3 formInput">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="jenis_pertanyaan" class="form-label">Jenis Pertanyaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('jenis_pertanyaan') is-invalid @enderror"
                                        name="jenis_pertanyaan" id="jenis_pertanyaan"
                                        placeholder="Input Jenis Pertanyaan" value="{{ $jenis->jenis }}"></input>
                                    @if ($errors->has('jenis_pertanyaan'))
                                        <div class="text-danger" style="font-size: 14px;">
                                            {{ $errors->first('jenis_pertanyaan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('tracking_alumni_index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('partials.footer');
