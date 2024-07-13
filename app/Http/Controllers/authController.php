<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class authController extends Controller
{
    public function login()
    {
        $tittle = "Sitasi |Login";

        return  view('auth.login', compact('tittle'));
    }

    public  function prosesLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username Wajib Diisi',
                'password.required' => 'Password Wajib Diisi'
            ]
        );

        $credintials  =  $request->only('username', 'password');

        Auth::attempt($credintials);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Akun tidak terdaftar']);
        }

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password]) == false) {
                if (!password_verify($request->password, $user->password)) {
                    return redirect()->back()->withErrors(['password' => 'Password Salah']);
                }
            }
            return redirect()->back()->withErrors(['username' => 'Username Salah']);
        }

        return redirect()->route('beranda_index');
    }

    public function logout()
    {
        Auth::logout();
        return  redirect()->route('authController-login');
    }
}
