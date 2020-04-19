<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function show()
    {
        if(!Auth::check()) return redirect('/');

        $posts = DB::table('post')
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->select('post.id', 'post.content', 'post.date', 'student.name', 'post.author_id')
                    ->orderBy('post.date', 'desc')
                    ->limit(10)
                    ->get();

        return view('pages.homepage', ['posts' => $posts]);
    }
}
