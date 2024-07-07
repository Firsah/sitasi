<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StaffTrackingController extends Controller
{
    public function profile()
    {
        $tittle = "Sibragi | Profile";
        $page   = "Profile";
        $user = Auth::user();

        return view('staffTracking.profile', compact(
            'tittle',
            'page',
            'user'
        ));
    }

    public function editProfile()
    {
        $tittle = "Sibragi | EditProfile";
        $page   = "Edit Profile";
        $page2  = "Edit Profile";
        $user = Auth::user();

        return view('staffTracking.editProfile', compact(
            'tittle',
            'page',
            'page2',
            'user'
        ));
    }

    public function prosesEditProfile(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password Harus Diisi',
        ]);

        $user = Auth::user();
        $user->password  = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Update Password  Berhasil');
    }
}
