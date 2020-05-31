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
                    -> select('student.id', 'student.student_number', 'student.name', 'student.bio', 'student.picture_path')
                    -> selectRaw('ts_rank(
                                    setweight(to_tsvector(\'portuguese\', student."student_number"), \'A\') ||
                                    setweight(to_tsvector(\'portuguese\', student."name"), \'B\') ||
                                    setweight(to_tsvector(\'portuguese\', student."bio"), \'C\'),
                                    plainto_tsquery(\'portuguese\', ?)
                                ) AS rank', [$query])
                    -> where('rank > 1')
                    -> orderByDesc('rank')
                    -> get();

            $prof = DB::table('professor')
                    -> select('professor.id', 'professor.name', 'professor.abbrev')
                    -> selectRaw('ts_rank(
                                    setweight(to_tsvector(\'portuguese\', professor."name"), \'A\') ||
                                    setweight(to_tsvector(\'portuguese\', professor."abbrev"), \'B\'),
                                    plainto_tsquery(\'portuguese\', ?)
                                ) AS rank', [$query])
                    -> where('rank > 1')
                    -> orderByDesc('rank')
                    -> get();

            $cu = DB::table('curricular_unit')
                    -> select('curricular_unit.id', 'curricular_unit.name', 'curricular_unit.abbrev', 'curricular_unit.description')
                    -> selectRaw('ts_rank(
                                    setweight(to_tsvector(\'portuguese\', curricular_unit."name"), \'A\') ||
                                    setweight(to_tsvector(\'portuguese\', curricular_unit."abbrev"), \'B\') ||
                                    setweight(to_tsvector(\'portuguese\', curricular_unit."description"), \'C\'),
                                    plainto_tsquery(\'portuguese\', ?)
                                ) AS rank', [$query])
                    -> where('rank > 1')
                    -> orderByDesc('rank')
                    -> get();

            $results = array(0=>$stud, 1=>$prof, 2=>$cu);
        }

        return view('pages.search', ['results' => $results]);
    }
}
