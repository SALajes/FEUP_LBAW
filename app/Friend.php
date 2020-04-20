<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $primaryKey = ['student1_id', 'student2_id'];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
