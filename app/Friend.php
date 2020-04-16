<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $primaryKey = ['student1', 'student2'];
    
    // ?
    // I can be friends with many students
    public function studentsThatAreMyFriends()
    {
        return $this->belongsToMany('App\Student', 'student1', 'student2');
    }

    // ?
    // Many students can be friends with me
    public function studentsImFriendsWith()
    {
        return $this->belongsToMany('App\Student', 'student2', 'student1');
    }

    // ?
    // All of my friends
    public function friends()
    {
        return $this->studentsThatAreMyFriends()->get()->merge(
            $this->studentsImFriendsWith()->get()
        )->unique('id');
    }

}
