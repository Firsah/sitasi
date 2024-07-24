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
            <form action="{{ route('tracking_alumni_Prosestambah') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
                        <label for="jenis_pertanyaan" class="form-label">Jenis Pertanyaan <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_pertanyaan_id') is-invalid  @enderror"
                            id="jenis_pertanyaan" name="jenis_pertanyaan_id" aria-label="Default select example">
                            <option value="" {{ old('jenis_pertanyaan_id') == '' ? 'selected' : '' }}>-- Pilih
                                Jenis Pertanyaan --</option>
                            @foreach ($jenisPertanyaan as $jp)
                                <option value="{{ $jp->id }}"
                                    {{ old('jenis_pertanyaan_id') == $jp->id ? 'selected' : '' }}>
                                    {{ $jp->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('jenis_pertanyaan_id'))
                            <div class="text-danger" style="font-size: 14px;">
                                {{ $errors->first('jenis_pertanyaan_id') }}
                            </div>
                        @endif
                    </div>
                    <!-- Fitur Tambah Pertanyaan -->
                    <div class="mb-3">
                        <button id="tambahPertanyaan" type="button" class="btn btn-outline-primary btn-pill"><i
                                class="fa fa-plus" style="margin-right:5px;"></i>Form Pertanyaan </button>
                    </div>
                    <div id="formContainer">
                        <div class="mb-3 formInput">
                            <div class="card p-3 mb-3">
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan No.1<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('pertanyaan.*') is-invalid @enderror" name="pertanyaan[]" id="pertanyaan"
                                        cols="30" rows="1" placeholder="Input Pertanyaan"></textarea>
                                    @if ($errors->has('pertanyaan.*'))
                                        <div class="text-danger" style="font-size: 14px;">
                                            {{ $errors->first('pertanyaan.*') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="pilihan1" class="form-label">Pilihan Jawaban Ke-1</label>
                                            <input class="form-control" name="pilihan1[]"
                                                placeholder="Input Pilihan Jawaban">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pilihan2" class="form-label">Pilihan Jawaban Ke-2</label>
                                            <input class="form-control" name="pilihan2[]"
                                                placeholder="Input Pilihan Jawaban">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="pilihan3" class="form-label">Pilihan Jawaban Ke-3</label>
                                            <input class="form-control" name="pilihan3[]"
                                                placeholder="Input Pilihan Jawaban">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pilihan4" class="form-label">Pilihan Jawaban Ke-4</label>
                                            <input class="form-control" name="pilihan4[]"
                                                placeholder="Input Pilihan Jawaban">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Apakah Anda Ingin Menyediakan Kolom Input
                                        Alasan?<span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alasan[0]" value="iya"
                                            id="flexRadioDefault1_0">
                                        <label class="form-check-label" for="flexRadioDefault1_0">
                                            Iya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alasan[0]" value="tidak"
                                            id="flexRadioDefault2_0">
                                        <label class="form-check-label" for="flexRadioDefault2_0">
                                            Tidak
                                        </label>
                                    </div>
                                    @if ($errors->has('alasan'))
                                        <div class="text-danger" style="font-size: 14px;">
                                            {{ $errors->first('alasan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {

        //SCRIPT UNTUK TAMBAH PERTANYAAN
        var no = 1;
        var counter = 1;

        // Menangani tindakan klik pada tombol
        document.getElementById('tambahPertanyaan').addEventListener("click", function() {
            //Membuat elemen form  baru
            var newFormInput = document.createElement("div");
            newFormInput.classList.add("mb-3", "formInput");

            //Menambahkan form kedalam container
            document.getElementById('formContainer').appendChild(newFormInput);

            newFormInput.innerHTML =
                `<div class="card p-3 mb-3">
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan No.${++no}<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('pertanyaan.*') is-invalid @enderror" name="pertanyaan[]" id="pertanyaan"
                            cols="30" rows="1" placeholder="Input Pertanyaan"></textarea>
                        @if ($errors->has('pertanyaan.*'))
                            <div class="text-danger" style="font-size: 14px;">
                                {{ $errors->first('pertanyaan.*') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pilihan1_${counter}" class="form-label">Pilihan Jawaban Ke-1</label>
                                <input class="form-control" name="pilihan1[]"
                                    placeholder="Input Pilihan Jawaban">
                            </div>
                            <div class="mb-3">
                                <label for="pilihan2_${counter}" class="form-label">Pilihan Jawaban Ke-2</label>
                                <input class="form-control" name="pilihan2[]"
                                    placeholder="Input Pilihan Jawaban">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pilihan3_${counter}" class="form-label">Pilihan Jawaban Ke-3</label>
                                <input class="form-control" name="pilihan3[]"
                                    placeholder="Input Pilihan Jawaban">
                            </div>
                            <div class="mb-3">
                                <label for="pilihan4_${counter}" class="form-label">Pilihan Jawaban Ke-4</label>
                                <input class="form-control" name="pilihan4[]"
                                    placeholder="Input Pilihan Jawaban">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Apakah Anda Ingin Menyediakan Kolom Input
                            Alasan?<span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alasan[${counter}]" value="iya"
                                id="flexRadioDefault1_${counter}">
                            <label class="form-check-label" for="flexRadioDefault1_${counter}">
                                Iya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alasan[${counter}]" value="tidak"
                                id="flexRadioDefault2_${counter}">
                            <label class="form-check-label" for="flexRadioDefault2_${counter}">
                                Tidak
                            </label>
                        </div>
                        @if ($errors->has('alasan'))
                            <div class="text-danger" style="font-size: 14px;">
                                {{ $errors->first('alasan') }}
                            </div>
                        @endif
                    </div>
                    <span class="btn btn-outline-danger btn-sm hapus-pertanyaan"><i class="fa fa-trash" style="margin-right:10px"></i>Hapus Pertanyaan,pada bagian ini!!</span>
                </div>`;

            counter++;
        });

        // Menambah event listener pada tombol "fa fa-trash"
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-pertanyaan')) {
                // Menghapus parent element dari tombol yang diklik
                e.target.parentElement.parentElement.remove();
            }
        });
    });
</script>

@include('partials.footer');
