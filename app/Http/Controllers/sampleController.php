<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sampleController extends Controller
{
    public  function dashboard()
    {
        return  view('dashboard');
    }

    public  function chart()
    {
        return  view('chart');
    }

    public  function  table()
    {
        return  view('table');
    }
}
