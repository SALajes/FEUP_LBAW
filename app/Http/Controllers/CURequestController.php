<?php

namespace App\Http\Controllers;

use App\CURequest;
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

}
