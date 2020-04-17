<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{   

    protected $table = "student";

    protected $fillable = [
        'name', 'student_number', 'bio', 'email', 'picture_path', 'administrator'
    ];

    protected $hidden = [
        'password'
    ];

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function curricularUnits()
    {
        return $this->belongsToMany('App\Group');
    }

    
}
