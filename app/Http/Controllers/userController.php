<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $tittle = "Sitasi |Data User ";
        $page   = "Data User";

        $user = User::with('role')->get();

        $adminUsers = $user->filter(function ($user) {
            return  $user->role->role != 'alumni';
        });

        $alumniUsers = $user->filter(function ($user) {
            return $user->role->role == 'alumni';
        });


        return view('admin.user.v_index', compact(
            'tittle',
            'page',
            'user',
            'adminUsers',
            'alumniUsers'
        ));
    }

    public function tambah()
    {
        $tittle = "Sitasi|Data User|Tambah";
        $page   = "Tambah User";

        $role = Role::all();

        return view('admin.user.v_tambah', compact(
            'tittle',
            'page',
            'role',
        ));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:role,id'
        ], [
            'name.required' => 'Nama Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'role.required' => 'Role Harus Diisi'
        ]);

        $passwordHash =  Hash::make($request->password);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $passwordHash;
        $user->role_id = $request->role;
        $user->save();

        return redirect()->route('user_index')->with('success', 'User Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $tittle = "Sibragi|Data User|Edit";
        $page   = "Edit User";

        $user = User::findOrFail($id);

        return view('admin.user.v_edit', compact(
            'tittle',
            'page',
            'user'
        ));
    }

    public  function prosesEdit(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password Harus Diisi',
            'password.confirmed' => 'Password Harus Sama',
        ]);

        $passwordHash = Hash::make($request->password);

        $user =  User::findOrFail($id);
        $user->username =  $request->username;
        $user->password = $passwordHash;
        $user->save();

        return redirect()->route('user_index')->with('success', 'User Berhasil Di Update!!');
    }

    public function hapusUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user_index')->with('success', 'User Berhasil Di Hapus!!');
    }
}
