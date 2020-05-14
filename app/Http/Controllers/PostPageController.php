<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostPageController extends Controller
{
    public function show($postId)
    {
        if(!Auth::check()) return redirect('/');

        $id = Auth::user()->id;

        $post = DB::table('post')
                    ->select('post.id', 'post.content', 'post.date', 'student.name', 'post.author_id', 'post.cu_id', 'curricular_unit.abbrev')            
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->leftjoin('curricular_unit', 'post.cu_id', '=', 'curricular_unit.id')
                    ->whereIn('post.cu_id', function($query) use($id) {
                                $query->select('enrolled.cu_id')
                                ->from('enrolled')
                                ->where('enrolled.student_id', '=', $id);
                    })
                    ->orWhere('post.public_feed', '=', True)
                    ->where('post.id', '=', $postId)
                    ->orderBy('post.date', 'desc')
                    ->get();

        return view('pages.postpage');
    }
}
