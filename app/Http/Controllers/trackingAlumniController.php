<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $tittle = "Sitasi | Tracking Alumni  ";
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
}
