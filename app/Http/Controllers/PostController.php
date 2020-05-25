<?php

namespace App\Http\Controllers;

use App\Post;
use App\CurricularUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\String_;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        if(!Auth::check()) return redirect('/');

        $id = Auth::user()->id;

        $posts = DB::table('post')
                    ->select('post.id', 'post.content', 'post.date', 'student.name', 'post.author_id', 'post.cu_id', 'curricular_unit.abbrev')            
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->leftjoin('curricular_unit', 'post.cu_id', '=', 'curricular_unit.id')
                    ->whereIn('post.cu_id', function($query) use($id) {
                        $query->select('enrolled.cu_id')
                                ->from('enrolled')
                                ->where('enrolled.student_id', '=', $id);
                    })
                    ->orWhere('post.public_feed', '=', True)
                    ->orderBy('post.date', 'desc')
                    ->limit(10)
                    ->get();
        

        $postsId = array_column($posts->toArray(), 'id');

        $numComments = DB::table('comment')
                        ->select('comment.post_id', DB::raw('count(*)'))
                        ->whereIn('comment.post_id', $postsId)
                        ->whereNotIn('comment.id', function($query) {
                            $query->select('comment_id')
                                    ->from('comment_thread');
                        })                    
                        ->groupBy('comment.post_id')
                        ->get();

        $cus = DB::table('enrolled')
                ->select('curricular_unit.abbrev', 'curricular_unit.id')
                ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
                ->where('enrolled.student_id', '=', $id)
                ->get();
        
        return view('pages.homepage', ['posts' => $posts, 'cus' => $cus, 'numComments'=>$numComments]);
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

    public function createPostInCUInFeed(Request $request, $cu_id, $feed){
        $post = new Post();

        //$this->authorize('createCU', CurricularUnit::find($cu_id));
        $this->authorize('createPublic', $post);
        
        $id = Auth::user()->id;

        $post->content = $request->input('content');
        $post->public_feed = false;
        $post->cu_id = $cu_id;
        $post->feed_type = $feed;
        $post->author_id = $id;
        $post->save();

        $name = Auth::user()->name;

        return ['post'=>$post, 'name'=>$name, 'id'=>$id];
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $this->authorize('deletePost', $post);
        $post->delete();

        return $post;
    }
}
