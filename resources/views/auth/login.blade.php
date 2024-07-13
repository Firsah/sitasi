  <head>
      <title>{{ $tittle }}</title>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      {{-- Font Awesome --}}
      <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free-6.5.1-web/css/all.min.css') }}">

      <style>
          .btn-primary {
              background-color: #198754 !important;
          }

          .content-note {
              background-color: #eae2b7;
              border-radius: 10px;
              padding: 5px;
              font-size: 13px !important;
          }

          .btn-outline-secondary {
              border-left: 0px solid grey !important;
              border-top: 1px solid #DEE2E6 !important;
              border-right: 1px solid #DEE2E6 !important;
              border-bottom: 1px solid #DEE2E6 !important;

          }
      </style>
  </head>

  <body>
      <section class="vh-100" style="background-color: #fff;">
          <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                      <div class="card shadow-2-strong" style="border-radius: 1rem;">
                          <div class="card-body p-4">
                              <h2 class="mb-4" style="text-align:center">Hello,<span
                                      style="color: #198754">Alumni!!</span></h2>
                              <form action="{{ route('authController-prosesLogin') }}" method="post">
                                  @csrf
                                  <div data-mdb-input-init class="form-outline mb-4">
                                      <label class="form-label" for="username">Username</label>
                                      <input type="text" id="username" name="username"
                                          class="form-control form-control @error('username') is-invalid @enderror" placeholder="Input Username" />
                                      @if ($errors->has('username'))
                                          <div class="text-danger" style="font-size: 13px !important">
                                              {{ $errors->first('username') }}
                                          </div>
                                      @endif
                                  </div>
                                  {{-- <div data-mdb-input-init class="form-outline mb-4">
                                      <label class="form-label" for="password">Password</label>
                                      <input type="password" id="password" name="password"
                                          class="form-control form-control" placeholder="Input Password" /> --}}
                                  {{-- <span class="input-group-text">
                                          <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                      </span> --}}
                                  {{-- @if ($errors->has('password'))
                                          <div class="text-danger text-sm" style="font-size: 13px !important">
                                              {{ $errors->first('password') }}
                                          </div>
                                      @endif
                                  </div> --}}

                                  <label for="password" class="form-label">Password</label>
                                  <div class="input-group mb-3">
                                      <input type="password" id="password" class="form-control" name="password"
                                          placeholder="Input Password" aria-describedby="button-addon">
                                      <button class="btn btn-outline-secondary" type="button" id="button-addon"><i
                                              class="fa fa-eye" id="togglePassword"
                                              style="cursor: pointer;"></i></button>
                                  </div>
                                  @if ($errors->has('password'))
                                      <div class="text-danger text-sm"
                                          style="font-size: 13px !important;margin-top:-15px">
                                          {{ $errors->first('password') }}
                                      </div>
                                  @endif

                                  <div class="col-12">
                                      <div class="row mb-4 mt-4">
                                          <button type="submit" data-mdb-ripple-init
                                              class="btn btn-primary btn btn-block mb-3" type="submit">Masuk <i
                                                  class="fa-solid fa-arrow-up-from-bracket fa-rotate-90"
                                                  style="margin-left: 5px"></i></button>
                                          <button data-mdb-button-init data-mdb-ripple-init
                                              class="btn btn-outline-dark btn btn-block" type="button"><i
                                                  class="fa-solid fa-clipboard-list"
                                                  style="margin-right: 5px"></i>Daftar
                                              Alumni</button>
                                      </div>
                                      <div class="col">
                                          <div class="row content-note">
                                              <div style="font-weight: 600">Note!!</div>
                                              <div>Alumni Ketika Melakukan Login Menggunakan:</div>
                                              <div>Username : 4 digit angka pertama dari NISN</div>
                                              <div>Password : Tanggal Lahir dengan Format (dd-mm-yyyy) </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
      {{-- Script Font Awesome --}}
      <script src="{{ asset('assets/vendor/fontawesome-free-6.5.1-web//all.min.js') }}"></script>
      <script>
          document.getElementById('togglePassword').addEventListener('click', function() {
              var passwordInput = document.getElementById('password');
              var icon = this;

              if (passwordInput.type === 'password') {
                  passwordInput.type = 'text';
                  icon.classList.remove('fa-eye');
                  icon.classList.add('fa-eye-slash');
              } else {
                  passwordInput.type = 'password';
                  icon.classList.remove('fa-eye-slash');
                  icon.classList.add('fa-eye');
              }
          });
      </script>

  </body>
