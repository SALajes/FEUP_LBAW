<?php

namespace App\Policies;

use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function createPost(Student $student)
    {
      // Any student can create a new post
      return Auth::check();
    }
}
