<?php

namespace App\Http\Controllers;

use App\CURequest;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CURequestController extends Controller
{

    public function requestCU(){
        $cus = DB::table('enrolled')
                ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
                ->select('curricular_unit.abbrev', 'curricular_unit.id')
                ->where('enrolled.student_id', '=', Auth::user()->id)
                ->get();
        return view('pages.requestCU', ['cus' => $cus]);
    }

    public function submitRequest(Request $request){

        $cu_request = new CURequest();
        
        $cu_request->student_id = Auth::user()->id;
        $cu_request->name = $request->input('cu_name');
        $cu_request->abbrev = $request->input('cu_abbrev');
        $cu_request->link_to_cu_page = $request->input('cu_page');
        $cu_request->additional_info = $request->input('additional_info');
        $cu_request->request_status = 'NotSeen';

        $cu_request->save();

        $notification = new Notification();
        $notification->student_id = Auth::user()->id;
        $notification->content = "You have submited a request for a new CU!";
        $notification->seen = false;
        $notification->notification_type = 'RequestCU';

        $notification->save();

        return redirect()->route('homepage');
    }

    public function testPoll(){
        $test = DB::table('cu_request')->select()->get();
        return response()->json(['reqs' => $test]);
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

    public function manageRequests()
    {
        $student = Auth::user();

        $requests = DB::table('cu_request')
            ->join('student', 'student.id', '=', 'cu_request.student_id')
            ->select('cu_request.id', 'student_id', 'cu_name', 'abbrev', 'link_to_cu_page', 
            'additional_info', 'request_status')
            ->where('request_status', '=', 'NotSeen')
            ->orwhere('request_status', '=', 'Seen')
            ->get();

        return view(
            'pages.manage_requests',
            ['student' => $student, 'reqs' => $requests]
        );
    }

    public function acceptRequest($id) {
        DB::table('cu_request')
        ->where('id', '=', $id)
        ->update(['request_status' => 'Accepted']);

        return redirect()->back();
    }

    public function denieRequest($id) {
        DB::table('cu_request')
        ->where('id', '=', $id)
        ->update(['request_status' => 'Rejected']);

        return redirect()->back();        
    }
}
