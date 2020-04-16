<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'student_number', 'bio', 'email', 'picture_path', 'abbrevr'
    ];

    protected $hidden = [
        'password'
    ];

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    // I can be friends with many students
    public function studentsThatAreMyFriends()
    {
        return $this->belongsToMany('App\Student', 'student1_id', 'student2_id');
    }

    // Many students can be friends with me
    public function studentsImFriendsWith()
    {
        return $this->belongsToMany('App\Student', 'student2_id', 'student1_id');
    }

    // All of my friends
    public function friends()
    {
        return $this->studentsThatAreMyFriends()->get()->merge(
            $this->studentsImFriendsWith()->get()
        )->unique('id');
    }
}
