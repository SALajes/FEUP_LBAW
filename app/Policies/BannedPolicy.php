<?php

namespace App\Policies;

use App\Student;
use App\Banned;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannedPolicy
{
    use HandlesAuthorization;

    public function show(Student $student, Banned $banned)
    {
        if( $student->id == $banned->student_id || $student->administrator )
            return true;

        $result = DB::table('moderator')
            ->select('moderator.student_id', 'moderator.cu_id')
            ->where('moderator.student_id', '=', $student->id)
            ->where('moderator.cu_id', '=', $banned->cu_id)
            ->get();
        if(sizeof($result) > 0)
            return true;
        
        return false;
    }

    //only a moderator may create and delete an entry in Banned table
    public function create(Student $student, CurricularUnit $cu){
        if($student->administrator )
            return true;

        $result = DB::table('moderator')
            ->select('moderator.student_id', 'moderator.cu_id')
            ->where('moderator.student_id', '=', $student->id)
            ->where('moderator.cu_id', '=', $cu->cu_id)
            ->get();
        if(sizeof($result) > 0)
            return true;
        
        return false;
    }

    public function delete(Student $student, CurricularUnit $cu){
        if($student->administrator )
            return true;
            
        $result = DB::table('moderator')
            ->select('moderator.student_id', 'moderator.cu_id')
            ->where('moderator.student_id', '=', $student->id)
            ->where('moderator.cu_id', '=', $banned->cu_id)
            ->get();
        if(sizeof($result) > 0)
            return true;
        
        return false;
    }
}
