<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{   
    use Notifiable;

    public $timestamps  = false;

    protected $table = "student";

    protected $fillable = [
        'name', 'student_number', 'bio', 'email', 'picture_path', 'administrator', 'password'
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
