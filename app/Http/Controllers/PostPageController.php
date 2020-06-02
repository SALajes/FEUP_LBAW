<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentThread;
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
        if (!is_numeric($postId)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        // Post content
        $post = DB::table('post')
                    ->select('post.id', 'post.content', 'post.date', 'student.name', 'post.author_id', 'post.cu_id', 'curricular_unit.abbrev')            
                    ->join('student', 'post.author_id', '=', 'student.id')
                    ->leftjoin('curricular_unit', 'post.cu_id', '=', 'curricular_unit.id')
                    ->where('post.id', '=', $postId)
                    ->orderBy('post.date', 'desc')
                    ->get();

        // Number of comments on post
        $numComments = DB::table('comment')
                    ->select(DB::raw('count(*)'))
                    ->where('comment.post_id', '=', $postId)
                    ->whereNotIn('comment.id', function($query) {
                        $query->select('comment_id')
                                ->from('comment_thread');
                    })
                    ->get();
             
        // Main comments
        $comments = DB::table('comment')
                    ->select('comment.id', 'comment.content', 'comment.date', 'comment.author_id', 'student.name')
                    ->join('student', 'comment.author_id', '=', 'student.id')
                    ->where('comment.post_id', '=', $postId)
                    ->whereNotIn('comment.id', function($query) {
                        $query->select('comment_id')
                                ->from('comment_thread');
                    })
                    ->orderBy('comment.date', 'asc')
                    ->get();

        $commentsId = array_column($comments->toArray(), 'id');

        $subcomments = DB::table('comment_thread')
                        ->select('comment_thread.parent_id', 'comment_thread.comment_id', 'comment.content', 'comment.date', 'comment.author_id', 'student.name')
                        ->join('comment', 'comment_thread.comment_id', '=', 'comment.id')
                        ->join('student', 'comment.author_id', '=', 'student.id')
                        ->whereIn('comment_thread.parent_id', $commentsId)
                        ->orderBy('comment.date', 'asc')
                        ->get();
        
        return view('pages.postpage', ['post'=>$post, 'numComments'=>$numComments, 'comments'=>$comments, 'subcomments'=>$subcomments]);
    }

    public function createComment(Request $request)
    {
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'content' => 'string|min:1',
            'postId' => 'numeric|min:1'

        ]);

        $comment = new Comment();
        $this->authorize('createComment', $comment);
        
        $id = Auth::user()->id;

        $comment->content = htmlspecialchars($request->input('content'));
        $comment->author_id = $id;
        $comment->post_id = htmlspecialchars($request->input('postId'));
        $comment->save();

        $name = Auth::user()->name;

        return ['comment'=>$comment, 'name'=>$name];
    }

    public function createSubcomment(Request $request, $commentId)
    {   
        if (!is_numeric($commentId)) return redirect('/');
        if(!Auth::check()) return redirect('/');
        
        $request->validate([
            'content' => 'string|min:1',
            'postId' => 'numeric|min:1'

        ]);

        $subcomment = new Comment();
        $this->authorize('createSubcomment', $subcomment);

        $id = Auth::user()->id;

        $subcomment->content = htmlspecialchars($request->input('content'));
        $subcomment->author_id = $id;
        $subcomment->post_id = htmlspecialchars($request->input('postId'));
        $subcomment->save();
        
        $commentThread = new CommentThread();

        $commentThread->comment_id = $subcomment->id;
        $commentThread->parent_id = $commentId;
        $commentThread->save();

        $name = Auth::user()->name;

        return ['subcomment'=>$subcomment, 'name'=>$name, 'parentId'=>$commentId];
    }
}
