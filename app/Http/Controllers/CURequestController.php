<?php

namespace App\Http\Controllers;

use App\CURequest;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CURequestController extends Controller
{

    public function requestCU()
    {
        if(!Auth::check()) return redirect('/');

        $cus = DB::table('enrolled')
            ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
            ->select('curricular_unit.abbrev', 'curricular_unit.id')
            ->where('enrolled.student_id', '=', Auth::user()->id)
            ->get();
        return view('pages.requestCU', ['cus' => $cus]);
    }

    public function submitRequest(Request $request)
    {
        if(!Auth::check()) return redirect('/');

        $cu_request = new CURequest();

        $cu_request->student_id = Auth::user()->id;
        $cu_request->cu_name = $request->input('cu_name');
        $cu_request->abbrev = $request->input('cu_abbrev');
        $cu_request->link_to_cu_page = $request->input('cu_page');
        $cu_request->additional_info = $request->input('additional_info');
        $cu_request->request_status = 'NotSeen';

        $saved = $cu_request->save();

        if ($saved) return redirect()->route('homepage')->with('success', 'You have successfully submited a request for a new CU.');

        else return back()->with('error', 'Failed to submit a request for a new CU.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CURequest  $cURequest
     * @return \Illuminate\Http\Response
     */
    public function show(CURequest $cURequest)
    {
        //
    }

    public function manageCreateRequests()
    {
        if(!Auth::check()) return redirect('/');

        $student = Auth::user();

        $likeCounter = DB::table('rating')
        ->where('student_id', '=', Auth::user()->id)
        ->count();

        $requests = DB::table('cu_request')
            ->join('student', 'student.id', '=', 'cu_request.student_id')
            ->select(
                'cu_request.id',
                'student.name as student_name',
                'student_id',
                'cu_name',
                'abbrev',
                'link_to_cu_page',
                'additional_info',
                'request_status'
            )
            ->where('request_status', '=', 'NotSeen')
            ->orwhere('request_status', '=', 'Seen')
            ->get();

        return view(
            'pages.manage_create_requests',
            ['student' => $student, 'reqs' => $requests, 'likeCounter' => $likeCounter]
        );
    }
    
    public function manageJoinRequests()
    {
        if(!Auth::check()) return redirect('/');

        $student = Auth::user();
        $requests = DB::table('cu_join_request')
            ->join('student', 'student.id', '=', 'cu_join_request.student_id')
            ->join('curricular_unit', 'curricular_unit.id', '=', 'cu_join_request.cu_id')
            ->select('curricular_unit.abbrev as cu_abbrev', 
                'student.name as student_name',
                'cu_join_request.id as id')
            ->where('request_status', '=', 'NotSeen')
            ->orwhere('request_status', '=', 'Seen')
            ->get();

        return view(
            'pages.manage_join_requests',
            ['student' => $student, 'reqs' => $requests]);
    }

    public function acceptCreateRequest($id)
    {
        if(!Auth::check()) return redirect('/');

        DB::table('cu_request')
            ->where('id', '=', $id)
            ->update(['request_status' => 'Accepted']);

        $cu = DB::table('cu_request')
            ->select('cu_name', 'abbrev', 'additional_info', 'id')
            ->where('id', '=', $id)
            ->get();

        $a = DB::table('curricular_unit')
            ->insert([
                'name' => $cu[0]->cu_name,
                'abbrev' => $cu[0]->abbrev,
                'description' => $cu[0]->additional_info
            ]);

        $a |= DB::table('moderator')
            ->insert([
                'student_id' => Auth::user()->id,
                'cu_id' => $cu[0]->id
            ]);

        $a |= DB::table('student')
            ->update(['administrator' => true]);
        
        if ($a) return redirect()->back()->with('success', 'Accepted Request!');
        else return redirect()->back()->with('error', 'Failed to accept request.');
    }

    public function denyCreateRequest($id)
    {   
        if(!Auth::check()) return redirect('/');
        $a = DB::table('cu_request')
            ->where('id', '=', $id)
            ->update(['request_status' => 'Rejected']);

        if ($a) return redirect()->back()->with('success', 'Rejected Request!');
        else return redirect()->back()->with('error', 'Failed to reject request.');
    }

    public function acceptJoinRequest($id)
    {
        if(!Auth::check()) return redirect('/');
        $a = DB::table('cu_join_request')
            ->where('id', '=', $id)
            ->update(['request_status' => 'Accepted']);

        $req = DB::table('cu_join_request')
            ->select('cu_id', 'student_id', 'id')
            ->where('id', '=', $id)
            ->get();

        $a |= DB::table('enrolled')
            ->insert([
                'cu_id' => $req[0]->cu_id,
                'student_id' => $req[0]->student_id,
                'identifier' => 'TBD'
            ]);

        if ($a) return redirect()->back()->with('success', 'Accepted Request!');
        else return redirect()->back()->with('error', 'Failed to accept request.');
    }

    public function denyJoinRequest($id)
    {
        if(!Auth::check()) return redirect('/');
        $a = DB::table('cu_join_request')
            ->where('id', '=', $id)
            ->update(['request_status' => 'Rejected']);

        if ($a) return redirect()->back()->with('success', 'Rejected Request!');
        else return redirect()->back()->with('error', 'Failed to reject request.');
    }

    public function askJoinCU($id)
    {
        if(!Auth::check()) return redirect('/');

        $isEnrolled = DB::table('enrolled')
            ->where('enrolled.cu_id', '=', $id)
            ->where('enrolled.student_id', '=', Auth::user()->id)
            ->get();

        if ($isEnrolled->count() != 0) {
            return redirect('/cu/' . $id)->with('error', 'Already enrolled in that CU.');
        }

        $aux = DB::table('cu_join_request')
            ->where('cu_join_request.cu_id', '=', $id)
            ->where('cu_join_request.student_id', '=', Auth::user()->id)
            ->where('cu_join_request.request_status', '!=', 'Accepted')
            ->where('cu_join_request.request_status', '!=', 'Rejected')
            ->get();

        if ($aux != null) {
            $a = DB::table('cu_join_request')
               ->insert([
                'cu_id' => $id,
                'student_id' => Auth::user()->id
            ]);

            if ($a) return back()->with('success', 'Submit request to join CU!');
            else return back()->with('error', 'Failed to submit request to join CU!');
        }

        return back()->with('error', 'Non existent CU!');
    }

    public function preventError()
    {
        return redirect('/');
    }
}
