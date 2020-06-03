<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CurricularUnit;

class SearchController extends Controller
{

    public function search(Request $request){
        if(!Auth::check()) return redirect('/');

        $request->validate(['query'=>'string|nullable']);

        $query = htmlspecialchars($request->input('query'));

        $results = NULL;
            
        if($query != ""){
            $stud = $this->getStudents($query);

            $prof = $this->getProfessors($query);

            $cu = $this->getCUs($query);

            $results = array(0=>$stud, 1=>$prof, 2=>$cu, 3=>[$query]);
        }

        return view('pages.search', ['results' => $results]);
    }

    public function advanced($query, $stud, $prof, $cu){
        if(!Auth::check()) return redirect('/');

        $query = htmlspecialchars($query);

        $students=[];
        if($stud == 'yes' && $query != ""){
            $students = $this->getStudents($query);
        }

        $professors=[];
        if($prof == 'yes' && $query != ""){
            $professors = $this->getProfessors($query);
        }

        $cus=[];
        if($cu == 'yes' && $query != ""){
            $cus = $this->getCUs($query);
        }

        return response()->json(['stud'=>$students, 'prof'=>$professors, 'cu'=>$cus, 'query'=>$query]);
    }

    public function getStudents($query){
        $stud = DB::table('student')
                -> select('id', 'student_number', 'name', 'profile_image')
                -> selectRaw('ts_rank(
                            setweight(to_tsvector(\'portuguese\', "student_number"), \'A\') ||
                            setweight(to_tsvector(\'portuguese\', "name"), \'B\'),
                            plainto_tsquery(\'portuguese\', ?)
                        ) AS rank', [$query])
                -> orderByRaw('rank DESC')
                -> get();

        for($i=0; $i < sizeof($stud); $i++){
            if($stud[$i]->rank == 0){
                if($i == 0){
                    $stud = [];
                }
                else{
                    $stud = $stud->slice(0, $i);
                }
                break;
            }
        }

        return $stud;
    }

    public function getProfessors($query){
        $prof = DB::table('professor')
                    -> select('id', 'name', 'abbrev', 'profile_image')
                    -> selectRaw('ts_rank(
                                setweight(to_tsvector(\'portuguese\', "name"), \'A\') ||
                                setweight(to_tsvector(\'portuguese\', "abbrev"), \'B\'),
                                plainto_tsquery(\'portuguese\', ?)
                            ) AS rank', [$query])
                    -> orderByRaw('rank DESC')
                    -> get();

        for($i=0; $i < sizeof($prof); $i++){
            if($prof[$i]->rank == 0){
                if($i == 0){
                    $prof = [];
                }
                else{
                    $prof = $prof->slice(0, $i);
                }
                break;
            }
        }            
            
        return $prof;
    }

    public function getCUs($query){
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

        for($i=0; $i < sizeof($cu); $i++){
            if($cu[$i]->rank == 0){
                if($i == 0){
                    $cu = [];
                }
                else{
                    $cu = $cu->slice(0, $i);
                }
                break;
            }
        }            
            
        return $cu;
    }
}
