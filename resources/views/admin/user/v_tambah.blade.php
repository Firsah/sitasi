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
            <li class="breadcrumb-item"><a href="{{ route('user_index') }}">User</a></li>
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>
        <div class="row mt-5">
            <form action="{{ route('user_prosesTambah') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Input Nama">
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Input Username">
                        @if ($errors->has('username'))
                            <div class="text-danger">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Input Password" minlength="8">
                                @if ($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Ulangi Password" minlength="8">
                                @if ($errors->has('password_confirmation'))
                                    <div class="text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option>-- Pilih Role --</option>
                            @foreach ($role as $r)
                                @if ($r->role != 'alumni' && $r->role != 'super admin')
                                    <option value="{{ $r->id }}">{{ $r->role }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <div class="text-danger">
                                {{ $errors->first('role') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</main>

@include('partials.footer');
