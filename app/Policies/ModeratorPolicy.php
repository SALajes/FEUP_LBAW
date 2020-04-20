<?php

namespace App\Policies;

use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeratorPolicy
{
    use HandlesAuthorization;

    public function show(Student $student, CurricularUnit $cu)
    {
        $result = DB::table('moderator')
        ->select('moderator.student_id', 'moderator.cu_id')
        ->where('moderator.student_id', '=', $student->id)
        ->where('moderator.cu_id', '=', $cu->id)
        ->get();
        
        if(sizeof($result) > 0)
            return true;
        
        return false;
    }

    public function create(Student $student, CurricularUnit $cu)
    {
        if($student->administrator)
            return true;
        
        $result = DB::table('moderator')
        ->select('moderator.student_id', 'moderator.cu_id')
        ->where('moderator.student_id', '=', $student->id)
        ->where('moderator.cu_id', '=', $cu->id)
        ->get();
        
        if(sizeof($result) > 0)
            return true;
        
        return false;
    }

    public function delete(Student $student, CurricularUnit $cu)
    {
        if($student->administrator)
            return true;
    }
}
