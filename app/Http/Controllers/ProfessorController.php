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
        $likeCounter = DB::table('rating')
                       ->where('student_id', '=', $id)
                       ->count();
        return view('pages.profile_prof', ['professor' => $professor, 
                                           'likeCounter' => $likeCounter]);
    }
    public function editName($id, Request $request)
    {
        $prof = Professor::find($id);

        $prof->name = $request->input('prof_name');
        $prof->save();

        return back()
            ->with('success', 'You have successfully updated the name.');
    }

    public function editEmail($id, Request $request)
    {
        $prof = Professor::find($id);

        $prof->email = $request->input('prof_email');
        $prof->save();

        return back()
            ->with('success', 'You have successfully updated the email.');
    }

    public function editAbbrev($id, Request $request)
    {
        $prof = Professor::find($id);

        $prof->abbrev = $request->input('prof_abbrev');
        $prof->save();

        return back()
            ->with('success', 'You have successfully updated the abbrev.');
    }

    public function editProfilePicture($id, Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $prof = Professor::find($id);

        $profile_image_name = $prof->id . '_profile_image_' . time() . '.' . request()->profile_image->getClientOriginalExtension();

        $request->profile_image->storeAs('profile_image', $profile_image_name);

        $prof->profile_image = $profile_image_name;
        $prof->save();

        return back()
            ->with('success', 'You have successfully uploaded the image.');
    }

    public function listCUs($id) {
        $cus = DB::table('teaches')
            ->select('curricular_unit.abbrev', 'curricular_unit.id', 'curricular_unit.name')
            ->join('curricular_unit', 'curricular_unit.id', '=', 'teaches.cu_id')
            ->where('teaches.professor_id', '=', $id)
            ->get();

        return response()->json(['cus' => $cus]);
    }
}
