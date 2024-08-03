<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\jawaban;

class responsTrackingController extends Controller
{
    public function  responsAlumni(Request $request)
    {
        $user = Auth::user();

        if ($user->alumni) {

            $alumniId = $user->alumni->id;

            foreach ($request->pertanyaan as $pertanyaanId => $jawaban) {
                $jenisPertanyaanId = $request->input("jenis_pertanyaan_id.{$pertanyaanId}");
                // Tambahkan debug untuk memastikan nilainya
                // dd($jenisPertanyaanId);


                jawaban::create([
                    'alumni_id' => $alumniId,
                    'jenis_pertanyaan_id' => $jenisPertanyaanId,
                    'pertanyaan_id' => $pertanyaanId,
                    'jawaban' => $jawaban,
                    'alasan' => $request->input("alasan.{$pertanyaanId}", null)
                ]);
            }

            return redirect()->route('beranda_index')->with('success', 'Jawaban Berhasil Disimpan');
        } else {
            return  redirect()->route('beranda_index')->with('error', 'Anda Bukan Alumni');
        }
    }
}
