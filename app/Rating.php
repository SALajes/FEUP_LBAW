<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'has_voted'
    ];

    public function reviewer()
    {
        return $this->hasOne('App\Student');
    }

    public function reviewedStudent()
    {
        return $this->hasMany('App\Student');
    }

    public function reviewedProfessor()
    {
        return $this->hasMany('App\Professor');
    }

    public function reviewedCurricularUnit()
    {
        return $this->hasMany('App\CurricularUnit');
    }
}
