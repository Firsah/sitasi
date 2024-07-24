<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\jenis_pertanyaan;
use App\Models\pertanyaan;

class berandaController extends Controller
{
    public  function index()
    {
        $tittle = "Sitasi | Beranda";
        $page   = "Beranda";

        //Mengambil data yang sedang login
        $user = Auth::user();
        if ($user->alumni) {
            //Ambil tahun lulus dari data alumni yang terkait dengan user yang sedang login
            $tahunLulus = $user->alumni->tahun_lulus;
            $jenisPertanyaan = Jenis_Pertanyaan::whereRaw("FIND_IN_SET(?, publish)", [$tahunLulus])->get();
            $alumni_id =  $user->alumni_id;
        } else {
            $jenisPertanyaan = collect([]);
            $alumni_id = null;
        }

        $jawaban =  jawaban::where('alumni_id', $alumni_id)->get()->groupBy('alumni_id');

        return  view('admin.v_beranda', compact('tittle', 'page', [
            'jenisPertanyaan',
            'jawaban',
            'alumni_id'
        ]));
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
            ->whereIn('pertanyaan_id', $pertanyaan->pluck('id'))
            ->exists();


        return view('user_alumni.v_fullpertanyaan', compact([
            'tittle',
            'page',
            'pertanyaan',
            'jenis_pertanyaan',
            'sudahMenjawab'
        ]));
    }
}
