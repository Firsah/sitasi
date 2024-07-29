<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\alumni;

class daftarAlumniController extends Controller
{
    public  function index(Request $request)
    {
        $tittle = 'Daftar Alumni';

        $selected_tahunLulus    =  $request->input('tahun_lulus');
        $selected_kelas         =  $request->input('kelas');

        $query = alumni::query();

        if ($selected_tahunLulus) {
            $tahunLulusArray =  is_array($selected_tahunLulus) ? $selected_tahunLulus : explode(',', $selected_tahunLulus);
            $tahunLulusArray =  array_filter($tahunLulusArray);

            if (!empty($tahunLulusArray)) {
                $query->whereIn('tahun_lulus', $tahunLulusArray);
            }
        }

        if ($selected_kelas) {
            $kelasArray =  is_array($selected_kelas) ? $selected_kelas : explode(',', $selected_kelas);
            $kelasArray =  array_filter($kelasArray);

            if (!empty($selected_kelas)) {
                $query->whereIn('kelas', $kelasArray);
            }
        }

        $dataTahunLulus = DB::table('alumni')
            ->select('tahun_lulus', 'kelas')
            ->distinct()
            ->pluck('tahun_lulus')
            ->unique()
            ->sort();

        $dataKelas = DB::table('alumni')
            ->select('kelas')
            ->distinct()
            ->pluck('kelas');

        // Membuat query terpisah untuk menampilkan hasil dengan filter yang sama

        $hasilQuery = $query->get();

        // if ($selected_tahunLulus) {
        //     $hasilQuery->whereIn('tahun_lulus', $tahunLulusArray);
        // }

        // if ($selected_kelas) {
        //     $hasilQuery->whereIn('kelas', $kelasArray);
        // }

        // $alumni = alumni::all();

        return  view('v_daftarAlumni', compact(
            'tittle',
            'dataTahunLulus',
            'dataKelas',
            'hasilQuery'
        ));
    }
}
