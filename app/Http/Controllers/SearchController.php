<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CurricularUnit;

class SearchController extends Controller
{
    public function show(){
        if(!Auth::check()) return redirect('/');

        return view('pages.search');
    }

    public function search(Request $request){
        //if(!Auth::check()) return redirect('/');

        $query = $request->input('query');

        $results = NULL;
            
        if($query != ""){
            $stud = DB::table('student')
                    -> select('id', 'student_number', 'name', 'profile_image')
                    -> selectRaw('ts_rank(
                                setweight(to_tsvector(\'portuguese\', "student_number"), \'A\') ||
                                setweight(to_tsvector(\'portuguese\', "name"), \'B\'),
                                plainto_tsquery(\'portuguese\', ?)
                            ) AS rank', [$query])
                    -> orderByRaw('rank DESC')
                    -> get();

            $prof = DB::table('professor')
                    -> select('id', 'name', 'abbrev', 'picture_path')
                    -> selectRaw('ts_rank(
                                setweight(to_tsvector(\'portuguese\', "name"), \'A\') ||
                                setweight(to_tsvector(\'portuguese\', "abbrev"), \'B\'),
                                plainto_tsquery(\'portuguese\', ?)
                            ) AS rank', [$query])
                    -> orderByRaw('rank DESC')
                    -> get();

            $cu = DB::table('curricular_unit')
                    -> select('id', 'name', 'abbrev', 'description')
                    -> selectRaw('ts_rank(
                                setweight(to_tsvector(\'portuguese\', "name"), \'A\') ||
                                setweight(to_tsvector(\'portuguese\', "abbrev"), \'B\') ||
                                setweight(to_tsvector(\'portuguese\', "description"), \'C\'),
                                plainto_tsquery(\'portuguese\', ?)
                            ) AS rank', [$query])
                    -> orderByRaw('rank DESC')
                    -> get();

            $results = array(0=>$stud, 1=>$prof, 2=>$cu, 3=>[$query]);
        }

        return view('pages.search', ['results' => $results]);
    }

    public function filter(){

    }
}
