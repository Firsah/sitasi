<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class berandaController extends Controller
{
    public  function index()
    {
        $tittle = "Sitasi | Beranda";
        $page   = "Beranda";

        return  view('admin.v_beranda', compact('tittle', 'page'));
    }
}
