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
            <li class="breadcrumb-item">{{ $page }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ $user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ $user->username }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Role</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ $user->role->role }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <button type="button" onclick="window.history.back()" class="btn btn-primary">Kembali</button>
                <a href="{{ route('StaffTrackingController_editProfile') }}" class="btn btn-outline-secondary">Upadate
                    Password</a>
            </div>
        </div>
    </div>
</main>

@include('partials.footer');
