<?php

namespace App\Policies;

use App\Student;
use App\Post;
use App\CurricularUnit;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostPolicy
{
    use HandlesAuthorization;

    public function show(Student $student, Post $post){
      if($post->public_feed == TRUE || $student->administrator)
        return true && Auth::check();

      $result = DB::table('enrolled')
        ->select('enrolled.student_id')
        ->where('enrolled.student_id', '=', $student->id)
        ->where('enrolled.cu_id', '=', $post->cu_id)
        ->get();
  
      if(sizeof($result) > 0)
        return true && Auth::check();
      
      return false;
    }

    public function createPublic(Student $student)
    {
      return Auth::check();
    }

    public function createCU(Student $student, CurricularUnit $cu)
    {
      $result = DB::table('enrolled')
      ->select('enrolled.student_id')
      ->where('enrolled.student_id', '=', $student->id)
      ->where('enrolled.cu_id', '=', $cu->id)
      ->get();

      if(sizeof($result) > 0)
        return true && Auth::check();
      
      return false;
    }

    public function deletePost(Student $student, Post $post){
      if(Auth::user()->administrator || $student->id == $post->author_id)
        return true && Auth::check();

      //se for mod da cu onde o post foi publicado 
      if($post->public_feed == FALSE){
        $result = DB::table('moderator')
        ->select('moderator.student_id')
        ->where('moderator.student_id', '=', $student->id)
        ->where('moderator.cu_id', '=', $post->cu_id)
        ->get();
        
        if(sizeof($result) > 0)
          return true && Auth::check();
      }

      return false;
    }
}
