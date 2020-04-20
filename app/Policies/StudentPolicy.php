<?php

namespace App\Policies;

use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function show(Student $student){
        return Auth::check();
    }

    public function update(Student $student){
        return Auth::user()->id == $student->id;
    }
    
    public function delete(Student $student){
        return Auth::user()->id == $student->id;
    }
}
