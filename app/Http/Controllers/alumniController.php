<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SheetDB\SheetDB;
use GuzzleHttp\Client;
use Carbon\Carbon;

\Carbon\Carbon::setLocale('id');

use App\Models\alumni;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class alumniController extends Controller
{
    public function index(Request $request)
    {
        $tittle = "Sitasi | Data Alumni";
        $page   = "Data Alumni";

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

        $alumniAll = $query->get();

        return view('admin.alumni.v_index', compact(
            'tittle',
            'page',
            'alumniAll',
            'dataTahunLulus',
            'dataKelas',
        ));
    }

    public  function update_data()
    {
        try {
            DB::beginTransaction();

            set_time_limit(900);

            // mengecek data
            // $sheetdb = new SheetDB('a4lcb9cx8o76a?sheet=Sheet1');
            // dd($sheetdb->get());

            $client = new Client();

            // Mengambil API DARI sheetDB
            $response = $client->get('https://sheetdb.io/api/v1/a4lcb9cx8o76a?sheet=Sheet1');
            $data = json_decode($response->getBody(), true);

            foreach ($data as $item) {
                // Convert the date format from DD-MM-YYYY to YYYY-MM-DD
                $tanggal_lahir = \DateTime::createFromFormat('d-m-Y', $item['TANGGAL LAHIR'])->format('Y-m-d');

                // Check  jika  data tersedia
                $exist =  DB::table('alumni')->where('no_alumni', $item['NO'])->exists();

                $alumniRole = Role::where('role', 'alumni')->first();

                if ($exist) {
                    //update
                    DB::table('alumni')
                        ->where('no_alumni', $item['NO'])
                        ->update([
                            'nis' => $item['NIS'],
                            'nisn' => $item['NISN'],
                            'nama' => $item['NAMA SISWA'],
                            'nama_panggilan' => $item['PANGGILAN'],
                            'kelas' => $item['KELAS'],
                            'tahun_lulus' => $item['TAHUN LULUS'],
                            'tempat' => $item['TEMPAT'],
                            'tanggal_lahir' => $tanggal_lahir,
                            'jenis_kelamin' => $item['L/P'],
                            'nama_ayah' => $item['NAMA AYAH'],
                            'nama_ibu' => $item['NAMA IBU'],
                            'alamat' => $item['ALAMAT'],
                            'ket' => $item['KET']
                        ]);

                    $alumni = DB::table('alumni')->where('no_alumni', $item['NO'])->first();
                } else {
                    DB::table('alumni')->insert([
                        'no_alumni' => $item['NO'],
                        'nis' => $item['NIS'],
                        'nisn' => $item['NISN'],
                        'nama' => $item['NAMA SISWA'],
                        'nama_panggilan' => $item['PANGGILAN'],
                        'kelas' => $item['KELAS'],
                        'tahun_lulus' => $item['TAHUN LULUS'],
                        'tempat' => $item['TEMPAT'],
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $item['L/P'],
                        'nama_ayah' => $item['NAMA AYAH'],
                        'nama_ibu' => $item['NAMA IBU'],
                        'alamat' => $item['ALAMAT'],
                        'ket' => $item['KET']
                    ]);
                    $alumni = DB::table('alumni')->where('no_alumni', $item['NO'])->first();
                }

                // menangani update atau  create  user
                $username = substr($alumni->nisn, 0, 4);
                // Mengkonversi tanggal_lahir dari string ke objek Carbon
                $passwordDate = Carbon::createFromFormat('Y-m-d', $alumni->tanggal_lahir);
                $password = $passwordDate->format('d-m-Y');

                // Check  if User Alumni Exist
                $userAlumniExist = DB::table('users')->where('alumni_id', $alumni->id)->first();

                if ($userAlumniExist) {
                    DB::table('users')
                        ->where('alumni_id', $alumni->id)
                        ->update([
                            'username' => $username,
                            'password' => Hash::make($password),
                            'name'     => $alumni->nama,
                            'role_id' => $alumniRole->id,
                            'alumni_id' => $alumni->id
                        ]);
                } else {
                    DB::table('users')->insert([
                        'username' => $username,
                        'password' => Hash::make($password),
                        'name'     => $alumni->nama,
                        'role_id' => $alumniRole->id,
                        'alumni_id' => $alumni->id
                    ]);
                }
            }

            DB::commit();

            return Redirect()->route('alumni_index')->with('success', 'Update Data Alumni Berhasil!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th;
        }
    }

    public  function detail_data($id)
    {
        $tittle = "Sitasi | Data Alumni";
        $page   = "Data Alumni";
        $page2  = "Detail Alumni";

        $alumniDetail = alumni::findOrFail($id);

        return view('admin.alumni.v_detail', compact('alumniDetail', 'tittle', 'page', 'page2'));
    }
}
