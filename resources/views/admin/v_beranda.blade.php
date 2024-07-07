<head>
    <title>{{ $tittle }}</title>
</head>

@include('partials.header')
@include('partials.menu')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">{{ $page }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h4>Selamat Datang!!</h4>
                <p>Username : {{ Auth::user()->name }}</p>
                <p>Role : {{ Auth::user()->role->role }} </p>
            </div>
        </div>
    </div>

</main>

@include('partials.footer');
