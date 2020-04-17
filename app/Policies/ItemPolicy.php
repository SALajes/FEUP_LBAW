<?php

namespace App\Policies;

use App\User;
use App\Card;
use App\Item;

use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    public function create(Student $student, Item $item)
    {
      // Student can only create items in cards they own
      return $student->id == $item->card->user_id;
    }

    public function update(Student $student, Item $item)
    {
      // Student can only update items in cards they own
      return $student->id == $item->card->student_id;
    }

    public function delete(User $student, Item $item)
    {
      // Student can only delete items in cards they own
      return $student->id == $item->card->student_id;
    }
}
