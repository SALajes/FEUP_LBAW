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

        $id = Auth::user()->id;

        $posts = DB::table('post')
                    ->select('post.id', 'post.content', 'post.date', 'student.name')            
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->whereIn('post.cu_id', function($query) use($id) {
                        $query->select('enrolled.cu_id')
                                ->from('enrolled')
                                ->where('enrolled.student_id', '=', $id);
                    })
                    ->orWhere('post.public_feed', '=', True)
                    ->orderBy('post.date', 'desc')
                    ->limit(10)
                    ->get();
        
        $cus = DB::table('enrolled')
                ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
                ->select('curricular_unit.abbrev', 'curricular_unit.id')
                ->where('enrolled.student_id', '=', $id)
                ->get();

        print_r($cus);

        return view('pages.homepage', ['posts' => $posts, 'cus' => $cus]);
    }

    public function createPost(Request $request)
    {
        $post = new Post();
        $this->authorize('createPublic', $post);
        
        $id = Auth::user()->id;

        $post->content = $request->input('content');
        $post->public_feed = true;
        $post->author_id = $id;
        $post->save();

        $name = Auth::user()->name;

        return ['post'=>$post, 'name'=>$name, 'id'=>$id];
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find(1);
        var_dump("LMAO");
        // $this->authorize('delete', Auth::user(), $post);
        $post->delete();

        return $post;
    }
}
