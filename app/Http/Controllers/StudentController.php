<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $owner = false;
        $likeCounter = DB::table('rating')
                       ->where('student_id', '=', $id)
                       ->count();
        if ($id == Auth::user()->id) $owner = true;
        return view('pages.profile', ['student' => $student, 'owner' => $owner, 'likeCounter' => $likeCounter]);
    }

    public function requestCUs($id)
    {
        $cus = DB::table('enrolled')
            ->join('curricular_unit', 'enrolled.cu_id', '=', 'curricular_unit.id')
            ->select('curricular_unit.abbrev', 'curricular_unit.id')
            ->where('enrolled.student_id', '=', $id)
            ->get();

        return response()->json(['cus' => $cus]);
    }

    public function requestRatings($id)
    {

        return response()->json(['success' => 'Requested Ratings.' . $id]);
    }

    public function pollNotifications($id)
    {
        $notification = Student::find($id)->notifications()->orderBy('date', 'desc')->limit(1)->get();
        if ($notification[0]->seen == false) return "true";
        return "false";
    }

    public function notifications($id)
    {
        $notifications = Student::find($id)->notifications()->orderBy('date', 'desc')->limit(25)->get();
        for ($i = 0; $i < sizeof($notifications); $i++) DB::table('notification')->where('id', $notifications[$i]->id)->update(['seen' => TRUE]);
        return response()->json(['notifications' => $notifications]);
    }

    public function editPassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New password cannot be your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => '',
            'new-password' => 'string|min:6|confirmed'
        ]);

        //Change Password
        $user = Student::findOrFail(auth()->user()->id);
        $user->password = bcrypt($request->get('new-password'));

        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

    public function editProfilePicture(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $profile_image_name = $user->id . '_profile_image_' . time() . '.' . request()->profile_image->getClientOriginalExtension();

        $request->profile_image->storeAs('profile_image', $profile_image_name);

        $user->profile_image = $profile_image_name;
        $user->save();

        return back()
            ->with('success', 'You have successfully upload image.');
    }

    public function editBio(Request $request)
    {
        $request->validate([
            'bio' => 'string|min:6',
        ]);

        $user = Auth::user();

        $user->bio = $request->bio;
        $user->save();

        return back()
            ->with('success', 'You have successfully updated the bio.');
    }

    public function deleteAccount() {
        $user = Auth::user();
        $user->delete();
        auth()->logout();
        return redirect('/');
    }

    public function rateStudent($reviewed_student, Request $request) {
        $review = DB::table('rating')
        ->where('reviewer_id', '=', Auth::user()->id)
        ->where('student_id', '=', $reviewed_student)
        ->where('has_voted', '=', true)
        ->count();

        if ($review == 0) {
            DB::table('rating')
            ->insert(['reviewer_id' => Auth::user()->id, 
                  'has_voted' => true,
                  'review' => $request->review,
                  'student_id' => $reviewed_student]);
        }
        return redirect('/users/' . $reviewed_student);
    }
}
