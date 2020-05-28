<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    public function show($id)
    {
        $professor = Professor::find($id);
        return view('pages.profile_prof', ['professor' => $professor]);
    }
}
