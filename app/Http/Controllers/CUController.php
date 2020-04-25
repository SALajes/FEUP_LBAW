<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CurricularUnit;

class CUController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id){

        $cu = CurricularUnit::find($id);
        return view('pages.cupage', ['cu' => $cu]);
    }
}
