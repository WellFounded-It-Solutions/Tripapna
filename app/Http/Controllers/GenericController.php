<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericController extends Controller
{
    //
    public function comming_soon()
    {
        return view('user.comming-soon');
    }
}
