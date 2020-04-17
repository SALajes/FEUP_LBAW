<?php

namespace App\Policies;

use App\Student;
use App\Card;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CardPolicy
{
    use HandlesAuthorization;

    public function show(Student $student, Card $card)
    {
      // Only a card owner can see it
      return $student->id == $card->student_id;
    }

    public function list(Student $student)
    {
      // Any student can list its own cards
      return Auth::check();
    }

    public function create(Student $student)
    {
      // Any student can create a new card
      return Auth::check();
    }

    public function delete(Student $student, Card $card)
    {
      // Only a card owner can delete it
      return $student->id == $card->student_id;
    }
}
