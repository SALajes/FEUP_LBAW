<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps  = false;

    protected $table = "group";
    protected $primaryKey = ['group_id', 'student_id'];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
