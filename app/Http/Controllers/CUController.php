<?php

namespace App\Http\Controllers;

use App\CURequest;
use Illuminate\Http\Request;
use App\CurricularUnit;
use App\Enrolled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function post_to_string($post)
{
    $str = "";
    $str .= "<article class=\"card post post-margins\" data-id=\"" .  $post->id . "\">";
    $str .=  "<div class=\"post-header d-flex justify-content-between\">";
    $str .= "<div class=\"post-header-left\">";
    $str .= "<a href=\"/users/" . $post->author_id . "\"><i class=\"icon-user post-user-icon\"></i>" . $post->name . "</a>";
    $str .= "<a href=\"/cu/" . $post->cu_id . "\" class=\"badge badge-pill badge-primary cu-badge\">" . $post->abbrev . "</a>";
    $str .= "</div>";
    $str .= " <a class=\"delete-post\"><i class=\"icon-trash post-delete\"></i></a>";
    $str .= "</div>";
    $str .= "<div class=\"card-body\">" . $post->content . "</div>";
    $str .= "<div class=\"post-footer\"><a href=\"#\" class=\"number-comments\">X comments</a></div></article>";
    return $str;
}

class CUController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        if(!Auth::check()) return redirect('/');

        $cu = CurricularUnit::find($id);
        $teachers = DB::table('teaches')
            ->select('professor.name', 'professor.id')
            ->join('professor', 'professor.id', '=', 'teaches.professor_id')
            ->where('teaches.cu_id', '=', $id)
            ->get();

        $likeCounter = DB::table('rating')
                       ->where('cu_id', '=', $id)
                       ->count();
        return view('pages.cupage', ['cu' => $cu, 'likeCounter' => $likeCounter, 'teachers' => $teachers]);
    }

    public function showAll()
    {
        if(!Auth::check()) return redirect('/');

        $cus = DB::table('curricular_unit')
            ->select('curricular_unit.abbrev', 'curricular_unit.name as cu_name', 'curricular_unit.description as description', 'curricular_unit.id as cu_id', 'student.id as su_id', 'student.student_number', 'student.name', 'student.email')
            ->leftJoin('enrolled', 'curricular_unit.id', '=', 'enrolled.cu_id')
            ->leftJoin('student', 'enrolled.student_id', '=', 'student.id')
            ->get();
        return response()->json(['cus' => $cus]);
    }

    public function feed($id)
    {
        if(!Auth::check()) return redirect('/');

        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')->where('feed_type', 'General')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        $text = "";
        foreach ($posts as $post) $text .= post_to_string($post);
        return $text; //response()->json(['posts' => $posts, 'feed' => "feed"]);
    }

    public function doubts($id)
    {
        if(!Auth::check()) return redirect('/');

        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')->where('feed_type', 'Doubts')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        $text = "";
        foreach ($posts as $post) $text .= post_to_string($post);
        return $text; //response()->json(['posts' => $posts, 'feed' => "feed"]);
    }

    public function tutoring($id)
    {
        if(!Auth::check()) return redirect('/');

        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')->where('feed_type', 'Tutoring')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        $text = "";
        foreach ($posts as $post) $text .= post_to_string($post);
        return $text; //response()->json(['posts' => $posts, 'feed' => "feed"]);
    }

    public function classes($id)
    {
        if(!Auth::check()) return redirect('/');

        return "classes";
    }

    public function about($id)
    {
        if(!Auth::check()) return redirect('/');

        $review = DB::table('rating')
        ->where('cu_id', '=', $id)
        ->get();

        $description = DB::table('curricular_unit')
        ->select('curricular_unit.description')
        ->where('id', '=', $id)
        ->get();

        return ["review" => $review, "description" => $description];
    }

    public function destroy(Request $request)
    {
        if(!Auth::check()) return redirect('/');

        DB::table('curricular_unit')
            ->select('curricular_unit.abbrev')
            ->where('curricular_unit.abbrev', '=', $request->input('content'))
            ->delete();

        return response()->json([]);
    }

    public function editName(Request $request, $id)
    {
        if(!Auth::check()) return redirect('/');

        DB::table('curricular_unit')
            ->where('id', '=', $id)
            ->update(['name' => $request->input('cu_name')]);

        return redirect()->back();
    }

    public function editAbbrev(Request $request, $id)
    {
        if(!Auth::check()) return redirect('/');

        DB::table('curricular_unit')
            ->where('id', '=', $id)
            ->update(['abbrev' => $request->input('cu_abbrev')]);

        return redirect()->back();
    }

    public function editDescription(Request $request, $id)
    {
        if(!Auth::check()) return redirect('/');

        DB::table('curricular_unit')
            ->where('id', '=', $id)
            ->update(['description' => $request->input('cu_description')]);

        return redirect()->back();
    }

    public function rateCU($reviewed_cu, Request $request)
    {
        if(!Auth::check()) return redirect('/');

        $enrolled = DB::table('enrolled')
            ->where('student_id', '=', Auth::user()->id)
            ->where('cu_id', '=', $reviewed_cu)
            ->count();

        $review = DB::table('rating')
        ->where('reviewer_id', '=', Auth::user()->id)
        ->where('cu_id', '=', $reviewed_cu)
        ->where('has_voted', '=', true)
        ->count();

        if ($review == 0 && $enrolled != 0) {
            DB::table('rating')
            ->insert(['reviewer_id' => Auth::user()->id, 
                  'has_voted' => true,
                  'review' => $request->input('cu_review'),
                  'cu_id' => $reviewed_cu]);
        }
        return redirect('/cu/' . $reviewed_cu);    
    }
}
