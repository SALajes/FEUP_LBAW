<?php

namespace App\Policies;

use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

   public function createComment(Student $student)
   {
       return Auth::check();
   }

   public function createSubcomment(Student $student)
   {
       return Auth::check();
   }
}
