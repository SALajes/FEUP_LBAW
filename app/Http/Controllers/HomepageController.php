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
                    ->select('post.id', 'post.content', 'post.date', 'student.name')
                    ->orderBy('post.date', 'desc')
                    ->limit(10)
                    ->get();
        
        $id = Auth::user()->id;

        $cus = DB::table('enrolled')
                ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
                ->select('curricular_unit.abbrev', 'curricular_unit.id')
                ->where('enrolled.student_id', '=', $id)
                ->get();

        print_r($cus);

        return view('pages.homepage', ['posts' => $posts, 'cus' => $cus]);
    }
}
