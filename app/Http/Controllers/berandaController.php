<?php

namespace App\Http\Controllers;

use App\Models\alumni;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\jenis_pertanyaan;
use App\Models\pertanyaan;

class berandaController extends Controller
{
    public function index()
    {
        $title = "Sitasi | Beranda";
        $page = "Beranda";

        // Mengambil data yang sedang login
        $user = Auth::user();
        if ($user->alumni) {
            // Ambil tahun lulus dari data alumni yang terkait dengan user yang sedang login
            $tahunLulus = $user->alumni->tahun_lulus;
            $jenisPertanyaan = Jenis_Pertanyaan::whereRaw("FIND_IN_SET(?, publish)", [$tahunLulus])->get();
            $alumni_id = $user->alumni_id;

            // Ambil jawaban yang relevan
            $jawaban = jawaban::where('alumni_id', $alumni_id)->get()->keyBy(function ($item) {
                return $item->jenis_pertanyaan_id . '-' . $item->pertanyaan_id;
            });
        } else {
            $jenisPertanyaan = collect([]);
            $alumni_id = null;
            $jawaban = collect([]);
        }

        return view('admin.v_beranda', compact('title', 'page', 'jenisPertanyaan', 'jawaban', 'alumni_id'));
    }

    public function fullPertanyaan($id)
    {
        $tittle = "Sitasi | Tracking Alumni";
        $page   = "Pertanyaan";

        $user = auth()->user();
        $alumni_id = $user->alumni_id;

        $jenis_pertanyaan  =  jenis_pertanyaan::findOrFail($id);
        $pertanyaan  = $jenis_pertanyaan->pertanyaan()->with('pilihan')->get();

        //mengecek user sedang login  apakah  telah menginput jawaban
        $sudahMenjawab = jawaban::where('alumni_id', $alumni_id)
            ->where('jenis_pertanyaan_id', $id)
            ->exists();

        // dd($sudahMenjawab);


        return view('user_alumni.v_fullpertanyaan', compact([
            'tittle',
            'page',
            'pertanyaan',
            'jenis_pertanyaan',
            'sudahMenjawab'
        ]));
    }

    public function cetakBuktiPengisian($id)
    {
        $user = auth()->user();
        $alumni_id = $user->alumni_id;
        $jenis_pertanyaan  = jenis_pertanyaan::findOrFail($id);
        $pertanyaanId = $jenis_pertanyaan->pertanyaan()->pluck('id')->toArray();

        //Mengambil data berdasarkan alumni ID
        $alumnus = alumni::findOrFail($alumni_id);
        $alumnus->jenis_pertanyaan_id = $jenis_pertanyaan->id;

        if (jawaban::whereIn('pertanyaan_id', $pertanyaanId)
            ->where('alumni_id', $alumnus->id)
            ->exists()
        ) {
            $alumnus->sudah_menjawab =  true;

            // Ambil jawaban terbaru
            $jawabanAlumni = jawaban::where('alumni_id', $alumnus->id)
                ->whereIn('pertanyaan_id', $pertanyaanId)
                ->latest('created_at')
                ->first();


            // Tambahkan informasi created_at ke dalam objek alumni
            $alumnus->created_at_jawaban = $jawabanAlumni->created_at;
        } else {
            $alumnus->sudah_menjawab = false;
            $alumnus->created_at_jawaban = null;
        }

        // dd($status);

        // $data =  compact(
        //     'user',
        //     'jenis_pertanyaan',
        //     'alumni_id',
        //     'status'
        // );

        // $pdf = Pdf::loadView('user_alumni.bukti_pengisian', $data);
        // return $pdf->download('bukti_pengisian.pdf');

        return view('user_alumni.bukti_pengisian', [
            'user' => $user,
            'jenis_pertanyaan' => $jenis_pertanyaan,
            'status' => [$alumnus]
        ]);
    }
}
