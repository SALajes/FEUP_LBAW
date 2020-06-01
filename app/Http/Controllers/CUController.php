<?php

namespace App\Http\Controllers;

use App\CURequest;
use Illuminate\Http\Request;
use App\CurricularUnit;
use App\Enrolled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $enrolled = DB::table('enrolled')
                    ->select('enrolled.student_id')
                    ->from('enrolled')
                    ->where('enrolled.cu_id', '=', $id)
                    ->where('enrolled.student_id', '=', Auth::user()->id)
                    ->get();
        
        if($enrolled->isEmpty())
            $enrolled = true;
        else
            $enrolled = false;

        return view('pages.cupage', ['cu' => $cu, 'likeCounter' => $likeCounter, 'teachers' => $teachers, 'enrolled'=>$enrolled]);
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
        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')
            ->select('post.id', 'post.author_id', 'student.name', 'post.content')
            ->where('feed_type', 'General')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        return response()->json($posts);
    }

    public function doubts($id)
    {
        if(!Auth::check()) return redirect('/');

        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')
            ->select('post.id', 'post.author_id', 'student.name', 'post.content')
            ->where('feed_type', 'Doubts')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        return response()->json($posts);
    }

    public function tutoring($id)
    {   
        if(!Auth::check()) return redirect('/');
        $posts = CurricularUnit::find($id)->posts()->join('student', 'post.author_id', '=', 'student.id')
            ->select('post.id', 'post.author_id', 'student.name', 'post.content')
            ->where('feed_type', 'Tutoring')
            ->orderBy('post.date', 'desc')
            ->limit(10)->get();
        return response()->json($posts);
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

        $saved = DB::table('curricular_unit')
                ->where('id', '=', $id)
                ->update(['name' => $request->input('cu_name')]);

        if ($saved) return redirect()->back()->with('success', 'You have successfully updated the name');
        else return back()->with('error', 'Update on name failed.');
    }

    public function editAbbrev(Request $request, $id)
    {   
        if(!Auth::check()) return redirect('/');
        $saved = DB::table('curricular_unit')
                ->where('id', '=', $id)
                ->update(['abbrev' => $request->input('cu_abbrev')]);

        if ($saved) return back()->with('success', 'You have successfully updated the abbrev.');
        else return back()->with('error', 'Update on abbrev failed.');
    }

    public function editDescription(Request $request, $id)
    {   
        if(!Auth::check()) return redirect('/');
        $saved = DB::table('curricular_unit')
                ->where('id', '=', $id)
                ->update(['description' => $request->input('cu_description')]);

        if ($saved) return back()->with('success', 'You have successfully updated the description.');
        else return back()->with('error', 'Update on description failed.');
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
            $a = DB::table('rating')
                ->insert(['reviewer_id' => Auth::user()->id, 
                'has_voted' => true,
                'review' => $request->input('cu_review'),
                'cu_id' => $reviewed_cu]);
            
            if ($a) return back()->with('success', 'You have successfully rated this CU.');
            else return back()->with('error', 'Failed to rated this CU.');
        }
        
        return back()->with('error', 'Failed to rated this profile.');
    }

    public function preventError()
    {
        return redirect('/');
    }
}
