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

    public function feed($id){
        $posts = CurricularUnit::find($id)->posts()->where('feed_type', 'General')->get();
        return response()->json(['posts' => $posts, 'feed' => "feed"]);
    }

    public function doubts($id){
        return "doubts";
    }

    public function tuttoring($id){
        return "tuttoring";
    }

    public function classes($id){
        return "classes";
    }

    public function about($id){
        return "about";
    }
}
