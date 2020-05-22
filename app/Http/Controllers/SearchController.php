<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(){
        if(!Auth::check()) return redirect('/');

        return view('pages.search');
    }

    public function search(Request $request){
        $request->query;
        return view('pages.search');
    }
}
