<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function show()
    {
        if(!Auth::check()) return redirect('/');

        // Ir buscar nome e student id do user que está logged in e passar no array

        $user = Auth::user();
        print($user->name);

        return view('pages.homepage', []);
    }
}
