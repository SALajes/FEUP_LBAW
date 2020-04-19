<?php

namespace App\Policies;

use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function createPublic(Student $student)
    {
      return Auth::check();
    }

    public function createCU(Student $student, CurricularUnit $cu_id)
    {
      $result = DB::table('enrolled')
      ->select('enrolled.student_id')
      ->where('enrolled.student_id', '=', $student->id)
      ->where('enrolled.cu_id', '=', $cu->id)
      ->get();

      if(sizeof($result) > 0)
      return true;
      
      return false;
    }

    public function delete(Student $student, Post $post){
      //se for admin
      //se for mod da cu onde o post foi publicado 
      //se for o dono do post
    }
}
