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
              <div class="row d-flex justify-content-center align-items-center">
                  <div class="col-12 col-md-8 col-lg-6 col-xl-12">
                      {{-- Triger Button Filter --}}
                      <div class="row">
                          <div class="col col-sm-12 d-flex justify-content-start">
                              <a href="{{ route('authController-login') }}" class="btn btn-secondary"
                                  style="margin-right: 10px">
                                  <i class="fa-solid fa-circle-left fa-1x" style="margin-top: 5px"></i>
                              </a>
                              <button href="#" class="btn btn-outline-primary" style="margin-right: 10px"
                                  data-bs-toggle="modal" data-bs-target="#kelasModal"> <i
                                      class="fa-solid fa-filter"></i>
                                  Kelas
                              </button>
                              <button class="btn btn-outline-success" style="margin-right: 10px" data-bs-toggle="modal"
                                  data-bs-target="#tahunLulusModal"><i class="fa-solid fa-filter"></i>
                                  Tahun Lulus
                              </button>
                              <a href="{{ route('daftarAlumniController-index') }}" class="btn btn-danger"><i
                                      class='bx bx-reset' style="margin-right:3px"></i>Reset Filter</a>
                          </div>
                      </div>
                      {{-- Batas Triger Button Filter --}}
                      <div class="row mt-5">
                          <div class="col-12">
                              <table class="table table-striped table-bordered table-responsive">
                                  <thead>
                                      <tr align="center">
                                          <th>No</th>
                                          <th>NISN</th>
                                          <th>LAHIR</th>
                                          <th>NAMA</th>
                                          <th>LULUS</th>
                                          <th>KELAS</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php
                                          $no = 1;
                                      @endphp
                                      @foreach ($hasilQuery as $all)
                                          <tr align="center">
                                              <td> {{ $no++ }}</td>
                                              <td>{{ $all['nisn'] }}</td>
                                              <td>{{ $all['tanggal_lahir'] }}</td>
                                              <td>{{ $all['nama'] }}</td>
                                              <td>{{ $all['tahun_lulus'] }}</td>
                                              <td>{{ $all['kelas'] }}</td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </section>


      <!-- MODAL FILTER TAHUN  LULUS  -->
      <div class="modal fade" style="padding-right: 0px; width: 100% !important;" id="tahunLulusModal" tabindex="-1"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header p-3">
                      <h5 class="modal-title" id="exampleModalLabel1">Filter Data Berdasarkan Tahun
                          Lulus
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="filterForm" action="" method="GET">
                          <div class="row g-2">
                              <div class="col mb-0">
                                  <!-- <label for="produk" class="form-label">Produk</label> -->
                                  <div class="row">
                                      <div class="col-md-6 mb-4">
                                          @php
                                              $selectdTahunLulus = request('tahun_lulus', []);
                                              $anySelected = !empty($selectdTahunLulus);
                                          @endphp
                                          <!-- Checbox untuk mengontrol semua produk -->
                                          <div class="form-check col-md-12 mb-3">
                                              <input type="checkbox" id="select_all" class="form-check-input"
                                                  {{ !$anySelected ? 'checked' : '' }}>
                                              <label for="select_all" style="margin-left: 10px"><span
                                                      style="font-weight: 600">ALL
                                                      TAHUN LULUS</span></label><br>
                                          </div>

                                          @foreach ($dataTahunLulus as $tahunLulus)
                                              @php
                                                  $checked =
                                                      !$anySelected || in_array($tahunLulus, (array) $selectdTahunLulus)
                                                          ? 'checked'
                                                          : '';
                                              @endphp
                                              <div class="form-check col-md-12 mb-3">
                                                  <input id="tahun_lulus_{{ $loop->index }}" name="tahun_lulus[]"
                                                      type="checkbox" class="form-check-input product-checkbox"
                                                      value="{{ $tahunLulus }}" {{ $checked }}>
                                                  <label for="tahun_lulus_{{ $loop->index }}"
                                                      style="margin-left: 10px;">{{ $tahunLulus }}</label><br>
                                              </div>
                                          @endforeach
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6 mb-4" style="display: none;">
                              <!-- Menambahkan hidden input untuk menyimpan Team yang dipilih -->
                              @foreach ($dataKelas as $kelas)
                                  @php
                                      $checkedKelas = in_array($kelas, (array) request('kelas', [])) ? 'checked' : '';
                                  @endphp
                                  <input id="kelas_{{ $loop->index }}" name="kelas[]" type="checkbox"
                                      class="form-check-input" value="{{ $kelas }}" {{ $checkedKelas }}>
                                  <label for="kelas_{{ $loop->index }}">{{ $kelas }}</label><br>
                              @endforeach
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Apply</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <!-- MODAL FILTER KELAS -->
      <div class="modal fade" id="kelasModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Filter Data Berdasarkan Kelas
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="filterFormTeam" action="" method="GET">
                          <div class="row g-2">
                              <div class="col mb-0">
                                  <!-- <label for="team" class="form-label">Team</label> -->
                                  <div class="row">
                                      <div class="col-md-6 mb-4">
                                          @php
                                              $selectedKelas = request('kelas', []);
                                              $anySelected = !empty($selectedKelas);
                                          @endphp
                                          <!-- Checbox  untuk mengontrol semua platfrom -->
                                          <div class="form-check col-md-12 mb-3">
                                              <!-- <input type="checkbox" id="select_all_platfrom" class="form-check-input" checked> -->
                                              <input type="checkbox" id="select_all_team" class="form-check-input"
                                                  {{ !$anySelected ? 'checked' : '' }}>
                                              <label for="select_all_team" style="margin-left: 10px"><span
                                                      style="font-weight: 600">ALL
                                                      KELAS</span></label><br>
                                          </div>

                                          @foreach ($dataKelas as $kelas)
                                              @php
                                                  $checked =
                                                      !$anySelected || in_array($kelas, (array) $selectedKelas)
                                                          ? 'checked'
                                                          : '';
                                              @endphp
                                              <div class="form-check col-md-12 mb-3">
                                                  <input id="kelas_{{ $loop->index }}" name="kelas[]"
                                                      type="checkbox" class="form-check-input team-checkbox"
                                                      value="{{ $kelas }}" {{ $checked }}>
                                                  <label for="kelas_{{ $loop->index }}"
                                                      style="margin-left: 10px;">{{ $kelas }}</label><br>
                                              </div>
                                          @endforeach
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Menambahkan hidden input untuk menyimpan Produk yang dipilih -->
                          <div class="col-md-6 mb-4" style="display: none;">
                              @foreach ($dataTahunLulus as $tahunLulus)
                                  @php
                                      $checked = in_array($tahunLulus, (array) request('tahun_lulus', []))
                                          ? 'checked'
                                          : '';
                                  @endphp
                                  <div class="form-check col-md-12 mb-3">
                                      <input id="tahun_lulus_{{ $loop->index }}" name="tahun_lulus[]"
                                          type="checkbox" class="form-check-input" value="{{ $tahunLulus }}"
                                          {{ $checked }}>
                                      <label for="tahun_lulus_{{ $loop->index }}">{{ $tahunLulus }}</label><br>
                                  </div>
                              @endforeach
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Apply</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
      {{-- Script Font Awesome --}}
      <script src="{{ asset('assets/vendor/fontawesome-free-6.5.1-web//all.min.js') }}"></script>

      {{-- Script check box all product  & team  --}}
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const selectAllCheckbox = document.getElementById('select_all');
              const productCheckboxes = document.querySelectorAll('.product-checkbox');
              const selectTeamAllCheckbox = document.getElementById('select_all_team');
              const teamsCheckboxes = document.querySelectorAll('.team-checkbox');

              //PRODUK
              // mengalihkan checkbbox produk menjadi centang  ketika checkbox select_all tercentang
              selectAllCheckbox.addEventListener('change', function() {
                  const isChecked = this.checked;
                  productCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
              })

              //Memperbarui select_all berdasarkan checkbox masing-masing product
              productCheckboxes.forEach(checkbox => {
                  checkbox.addEventListener('change', function() {
                      const allChecked = [...productCheckboxes].every(cb => cb.checked);
                      const allUnchecked = [...productCheckboxes].every(cb => !cb.checked);

                      selectAllCheckbox.checked = allChecked;
                      // selectAllCheckbox.indeterminate = !allChecked && !allUnchecked;
                  });
              });

              //TEAM
              selectTeamAllCheckbox.addEventListener('change', function() {
                  const isChecked = this.checked;
                  teamsCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
              })

              teamsCheckboxes.forEach(checkbox => {
                  checkbox.addEventListener('change', function() {
                      const allChecked = [...teamsCheckboxes].every(cb => cb.checked);
                      const allUnchecked = [...teamsCheckboxes].every(cb => !cb.checked);

                      selectTeamAllCheckbox.checked = allChecked;
                  });
              });
          });
      </script>
  </body>
