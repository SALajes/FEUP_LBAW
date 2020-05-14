<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($postId)
    {
        if(!Auth::check()) return redirect('/');

        $post = DB::table('post')
                    ->select('post.id', 'post.content', 'post.date', 'student.name', 'post.author_id', 'post.cu_id', 'curricular_unit.abbrev')            
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->leftjoin('curricular_unit', 'post.cu_id', '=', 'curricular_unit.id')
                    ->where('post.id', '=', $postId)
                    ->orderBy('post.date', 'desc')
                    ->get();

        $numComments = DB::table('comment')
                    ->select(DB::raw('count(*)'))
                    ->where('comment.post_id', '=', $postId)
                    ->get();
             
        $comments = DB::table('comment')
                    ->select('comment.id', 'comment.content', 'comment.date', 'comment.author_id', 'student.name')
                    ->join('student', 'comment.author_id', '=', 'student.id')
                    ->where('comment.post_id', '=', $postId)
                    ->orderBy('comment.date', 'asc')
                    ->get();

        return view('pages.postpage', ['post'=>$post, 'numComments'=>$numComments, 'comments'=>$comments]);
    }
}
