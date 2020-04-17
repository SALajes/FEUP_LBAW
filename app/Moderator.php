<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    protected $primaryKeys = ['student_id', 'cu_id'];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function curricular_units()
    {
        return $this->belongsToMany('App\CurricularUnit');
    }
}
