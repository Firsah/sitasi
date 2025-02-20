<?php

namespace App\Http\Controllers;

use App\Models\alumni;
use App\Models\jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\jenis_pertanyaan;
use App\Models\pertanyaan;
use App\Models\pilihan;



class trackingAlumniController extends Controller
{
    public function  index()
    {
        $tittle = "Sitasi | Tracking Alumni  ";
        $page   = "Tracking Alumni";

        $jenis_pertanyaan = jenis_pertanyaan::all();
        $pertanyaan = pertanyaan::all();


        return view('admin.trackingAlumni.v_index', compact(
            'tittle',
            'page',
            'pertanyaan',
            'jenis_pertanyaan'
        ));
    }

    public function tambah()
    {
        $tittle = "Sitasi|Tracking Alumni|Tambah";
        $page   = "Tambah Pertanyaan";

        $jenisPertanyaan = jenis_pertanyaan::all();

        return view('admin.trackingAlumni.v_tambah', compact(
            'tittle',
            'page',
            'jenisPertanyaan',
        ));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate(
            $request,
            [
                'jenis_pertanyaan_id' => 'required',
                'pertanyaan.*' => 'required',
                'alasan' => 'required'
            ],
            [
                'jenis_pertanyaan_id.required' => 'Jenis Pertanyaan Harus Diisi!!',
                'pertanyaan.*.required' => 'Pertanyaan Harus Diisi!!',
                'alasan.required' => 'Alasan Harus Diisi!!'
            ]
        );

        //debug Request Data
        // dd($request->all());

        foreach ($request->pertanyaan as $key => $pertanyaanText) {
            $pertanyaan = new pertanyaan();
            $pertanyaan->jenis_pertanyaan_id = $request->jenis_pertanyaan_id;
            $pertanyaan->pertanyaan = $pertanyaanText;
            // Mengatasi masalah indeks 'alasan' yang tidak berurutan
            $pertanyaan->is_alasan = $request->alasan[$key];
            $pertanyaan->save();

            $pilihan = [
                ['pertanyaan_id' => $pertanyaan->id, 'pilihan' => $request->pilihan1[$key]],
                ['pertanyaan_id' => $pertanyaan->id, 'pilihan' => $request->pilihan2[$key]],
                ['pertanyaan_id' => $pertanyaan->id, 'pilihan' => $request->pilihan3[$key]],
                ['pertanyaan_id' => $pertanyaan->id, 'pilihan' => $request->pilihan4[$key]],
            ];

            pilihan::insert($pilihan);
        }

        return redirect()->route('tracking_alumni_index')->with('success', 'Tambah Pertanyaan  Berhasil');
    }

    public function detailPertanyaan($id)
    {
        $tittle = "Sitasi | Tracking Alumni";
        $page   = "Detail Pertanyaan";

        $jenis_pertanyaan = jenis_pertanyaan::findOrFail($id);
        // Mengambil semua pertanyaan beserta pilihannya
        $pertanyaan = $jenis_pertanyaan->pertanyaan()->with('pilihan')->get();

        return view('admin.trackingAlumni.v_detailPertanyaan', compact(
            'tittle',
            'page',
            'pertanyaan',
            'jenis_pertanyaan'
        ));
    }

    public function publish($id)
    {
        $tittle = "Sitasi | Tracking Alumni";
        $page   = "Publish";

        $jPertanyaan = jenis_pertanyaan::findOrFail($id);

        $query = alumni::query();

        $alumni = $query
            ->select('tahun_lulus')
            ->distinct()
            ->pluck('tahun_lulus')
            ->unique()
            ->sort();

        // dd($alumni);

        return view('admin.trackingAlumni.publish.v_publish', compact([
            'tittle',
            'page',
            'alumni',
            'jPertanyaan'
        ]));
    }

    public function editOrCreate(Request $request, $id)
    {
        // Menggabungkan tahun_lulus menjadi satu string yang dipisahkan dengan koma
        $publish = $request->has('tahun_lulus') ? implode(',', $request->tahun_lulus) : '';

        // Mengupdate jenis_pertanyaan dengan tahun_lulus yang dipilih
        $jenisPertanyaan = jenis_pertanyaan::findOrFail($id);
        $jenisPertanyaan->publish = $publish;
        $jenisPertanyaan->save();

        return redirect()->route('tracking_alumni_index')->with('success', 'Settings Publisasi Berhasil!!');
    }

    public function TahunLulusDanJpertanyaan($tahun, $jenis_pertanyaan)
    {
        $tittle = "Sitasi | Tracking Alumni";
        $page   = "Tracking Alumni";
        $page2   = "Detail Publish";

        $alumni = alumni::where('tahun_lulus', $tahun)->get();
        $Jpertanyaan = jenis_pertanyaan::findOrFail($jenis_pertanyaan);

        $pertanyaanId = $Jpertanyaan->pertanyaan()->pluck('id')->toArray();

        //memeriksa apakah alumni sudah menjawab?
        $sudahMenjawabCount = 0;
        foreach ($alumni as $alumnus) {

            $alumnus->jenis_pertanyaan_id = $jenis_pertanyaan;

            if (jawaban::whereIn('pertanyaan_id', $pertanyaanId)
                ->where('alumni_id', $alumnus->id)
                ->exists()
            ) {
                $sudahMenjawabCount++;
                $alumnus->sudah_menjawab =  true;

                //mengecek user sedang login  apakah  telah menginput jawaban
                $jawabanAlumni = jawaban::where('alumni_id', $alumnus->id)
                    ->whereIn('pertanyaan_id', $pertanyaanId)
                    ->first();

                // Tambahkan informasi created_at ke dalam objek alumni
                $alumnus->created_at_jawaban = $jawabanAlumni->created_at;
            } else {
                $alumnus->sudah_menjawab = false;
                $alumnus->created_at_jawaban = null;
            }
        }

        $tahunLulus  = alumni::where('tahun_lulus', $tahun)->pluck('tahun_lulus')->first();
        $totAlumni   = $alumni->count();
        $belumMenjawabCount = $totAlumni - $sudahMenjawabCount;

        return view('admin.trackingAlumni.publish.v_tampilRespons', compact([
            'tittle',
            'page',
            'page2',
            'alumni',
            'tahunLulus',
            'sudahMenjawabCount',
            'belumMenjawabCount',
            'totAlumni',
            'Jpertanyaan',
        ]));
    }

    public  function detailRespons($id, $jenisPertanyaanId)
    {
        $tittle = "Sitasi|Tracking Alumni";
        $page   = "Tampil Respons";
        $page2  = "Detail Respons";

        $alumni = alumni::findOrFail($id);

        // Mengambil jenis pertanyaan yang sudah dijawab oleh alumni dan sesuai dengan ID jenis pertanyaan
        $pertanyaanId = jawaban::where('alumni_id', $id)
            ->whereHas('pertanyaan', function ($query) use ($jenisPertanyaanId) {
                $query->where('jenis_pertanyaan_id', $jenisPertanyaanId);
            })
            ->pluck('pertanyaan_id');


        $jenisPertanyaan = pertanyaan::whereIn('id', $pertanyaanId)
            ->with('jenis_pertanyaan')
            ->get()
            ->pluck('jenis_pertanyaan')
            ->unique('id');

        //Mengambil pertanyaan dan jawaban yang sudah dijawab oleh alumni

        $pertanyaan = pertanyaan::whereIn('id', $pertanyaanId)->with('jawaban')->get();
        $jawaban    = jawaban::where('alumni_id', $id)->get();

        return view('admin.trackingAlumni.publish.v_detailRespons', compact([
            'tittle',
            'page',
            'page2',
            'alumni',
            'jenisPertanyaan',
            'pertanyaan',
            'jawaban'
        ]));
    }

    public function tambahJenisPertanyaan()
    {
        $tittle = "Sitasi|Tracking Alumni|Tambah Jenis Pertanyaan";
        $page   = "Tambah Jenis Pertanyaan";

        return view('admin.trackingAlumni.v_tambahJenisPertanyaan', compact(
            'tittle',
            'page',
        ));
    }

    public function prosesTambahJenisPertanyaan(Request $request)
    {
        $this->validate(
            $request,
            [
                'jenis_pertanyaan' => 'required'
            ],
            [
                'jenis_pertanyaan.required' => 'Jenis Pertanyaan Wajib Diisi!!'
            ]
        );

        $jenisPertanyaan = new jenis_pertanyaan();
        $jenisPertanyaan->jenis = $request->jenis_pertanyaan;
        $jenisPertanyaan->save();

        return redirect()->route('tracking_alumni_index')->with('success', 'Tambah Jenis Pertanyaan  Berhasil!!');
    }

    public function editJenisPertanyaan($id)
    {
        $tittle = "Sitasi|Tracking Alumni|Edit Jenis Pertanyaan";
        $page   = "Edit Jenis Pertanyaan";

        $jenis = jenis_pertanyaan::findOrFail($id);

        return view('admin.trackingAlumni.v_editJenisPertanyaan', compact(
            'tittle',
            'page',
            'jenis',
        ));
    }

    public function prosesEditJenisPertanyaan(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'jenis_pertanyaan' => 'required'
            ],
            [
                'jenis_pertanyaan.required' => 'Jenis Pertanyaan Wajib Diisi!!'
            ]
        );

        $jPertanyaan = jenis_pertanyaan::findOrFail($id);
        $jPertanyaan->jenis = $request->jenis_pertanyaan;
        $jPertanyaan->save();

        return redirect()->route('tracking_alumni_index')->with('success', 'Edit Jenis Pertanyaan  Berhasil!!');
    }

    public function cetakTrackingAlumni($tahun, $jenisPertanyaanId)
    {
        $alumni = alumni::where('tahun_lulus', $tahun)->get();
        $jenisPertanyaan = jenis_pertanyaan::findOrFail($jenisPertanyaanId);

        $pertanyaanId = $jenisPertanyaan->pertanyaan()->pluck('id')->toArray();

        //memeriksa apakah alumni sudah menjawab?
        $sudahMenjawabCount = 0;
        foreach ($alumni as $alumnus) {

            $alumnus->jenis_pertanyaan_id = $jenisPertanyaanId;

            if (jawaban::whereIn('pertanyaan_id', $pertanyaanId)
                ->where('alumni_id', $alumnus->id)
                ->exists()
            ) {
                $sudahMenjawabCount++;
                $alumnus->sudah_menjawab =  true;

                //mengecek user sedang login  apakah  telah menginput jawaban
                $jawabanAlumni = jawaban::where('alumni_id', $alumnus->id)
                    ->whereIn('pertanyaan_id', $pertanyaanId)
                    ->first();

                // Tambahkan informasi created_at ke dalam objek alumni
                $alumnus->created_at_jawaban = $jawabanAlumni->created_at;
            } else {
                $alumnus->sudah_menjawab = false;
                $alumnus->created_at_jawaban = null;
            }
        }

        $tahunLulus  = alumni::where('tahun_lulus', $tahun)->pluck('tahun_lulus')->first();
        $totAlumni   = $alumni->count();
        $belumMenjawabCount = $totAlumni - $sudahMenjawabCount;

        $data =  compact([
            'alumni',
            'tahunLulus',
            'sudahMenjawabCount',
            'belumMenjawabCount',
            'totAlumni',
            'jenisPertanyaan'
        ]);

        $pdf = Pdf::loadView('admin.trackingAlumni.publish.v_cetakRespons', $data);
        return $pdf->download('bukti_pengisian_tracking_alumni.pdf');

        // return view('admin.trackingAlumni.publish.v_cetakRespons', compact(
        //     'alumni',
        //     'tahunLulus',
        //     'sudahMenjawabCount',
        //     'belumMenjawabCount',
        //     'totAlumni',
        //     'jenisPertanyaan'
        // ));
    }
}
