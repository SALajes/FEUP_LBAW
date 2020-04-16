<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    protected $primaryKey = ['student', 'curricularUnit'];

    protected $fillable = [
        'identifier'
    ];

    public function students() 
    {
        $this->belongsTo('App\Student', 'student');
    }

    public function curricular_units() 
    {
        $this->belongsTo('App\CurricularUnit', 'curriculatUnit');
    }

    public function studentsCUs()
    {
        $this->hasMany('App\Student', 'curricularUnit', 'student');
    }

}
