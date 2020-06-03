<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    public function show($id)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $professor = Professor::find($id);
        $likeCounter = DB::table('rating')
                       ->where('professor_id', '=', $id)
                       ->count();
        return view('pages.profile_prof', ['professor' => $professor, 
                                           'likeCounter' => $likeCounter]);
    }
    
    public function editName($id, Request $request)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'prof_name' => 'string|min:6|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/ui',
        ]);

        $prof = Professor::find($id);
        
        if ($prof != null){
            $prof->name = htmlspecialchars($request->input('prof_name'));
            $saved = $prof->save();

            if ($saved) return back()->with('success', 'You have successfully updated the name.');
            else return back()->with('error', 'Update on name failed.');
        }

        else return back()->with('error', 'Update on name failed.');
    }

    public function editEmail($id, Request $request)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'prof_email' => 'string|min:1|email',
        ]);

        $prof = Professor::find($id);
        if ($prof != null){
            $prof->email = htmlspecialchars($request->input('prof_email'));
            $saved = $prof->save();

            if ($saved) return back()->with('success', 'You have successfully updated the email.');

            else return back()->with('error', 'Update on email failed.');
        }
        
        else return back()->with('error', 'Update on email failed.');
    }

    public function editAbbrev($id, Request $request)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'prof_abbrev' => 'string|min:2|regex:/[A-Z]{2,8}/',
        ]);

        $prof = Professor::find($id);
        
        if ($prof != null){
            $prof->abbrev = htmlspecialchars($request->input('prof_abbrev'));
            $saved = $prof->save();

            if ($saved) return back()->with('success', 'You have successfully updated the abbrev.');

            else return back()->with('error', 'Update on abbrev failed.');
        }
        
        else return back()->with('error', 'Update on abbrev failed.');

    }

    public function editProfilePicture($id, Request $request)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $prof = Professor::find($id);
        
        if ($prof != null){

            $profile_image_name = $prof->id . '_profile_image_' . time() . '.' . request()->profile_image->getClientOriginalExtension();

            $path = $request->profile_image->storeAs('profile_image', $profile_image_name);

            $prof->profile_image = $profile_image_name;
            $saved = $prof->save();

            if ($saved && $path != null) return back()->with('success', 'You have successfully updated the profile picture.');

            else return back()->with('error', 'Update on profile picture failed.');
        }
        
        else return back()->with('error', 'Update on profile picture failed.');

    }

    public function rateProf($reviewed_prof, Request $request)
    {   
        if (!is_numeric($reviewed_prof)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $request->validate([
            'review' => 'string|nullable'
        ]);

        $review = DB::table('rating')
        ->where('reviewer_id', '=', Auth::user()->id)
        ->where('professor_id', '=', $reviewed_prof)
        ->where('has_voted', '=', true)
        ->count();

        if ($review == 0) {
            $inserted = DB::table('rating')
                        ->insert(['reviewer_id' => Auth::user()->id, 
                        'has_voted' => true,
                        'review' => htmlspecialchars($request->review),
                        'professor_id' => $reviewed_prof]);

            if ($inserted) return back()->with('success', 'You have successfully rated this profile.');

            else return back()->with('error', 'Failed to rated this profile.');
        }

        else return back()->with('error', 'You have already rated this profile.');
    }

    public function listCUs($id)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');

        $cus = DB::table('teaches')
            ->select('curricular_unit.abbrev', 'curricular_unit.id', 'curricular_unit.name')
            ->join('curricular_unit', 'curricular_unit.id', '=', 'teaches.cu_id')
            ->where('teaches.professor_id', '=', $id)
            ->get();

        return response()->json(['cus' => $cus]);
    }

    public function requestRatings($id)
    {   
        if (!is_numeric($id)) return redirect('/');
        if(!Auth::check()) return redirect('/');
        
        $reviews = DB::table('rating')
        ->select('review')
        ->join('professor', 'professor.id', '=', 'rating.professor_id')
        ->where('professor_id', '=', $id)
        ->get();
        return response()->json(['reviews' => $reviews]);
    }

    public function preventError()
    {
        return redirect('/');
    }
}
