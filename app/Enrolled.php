<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model
{
    protected $table = "enrolled";

    protected $primaryKey = ['student', 'curricularUnit'];

    protected $fillable = [
        'identifier'
    ];

    public function students() 
    {
        $this->belongsToMany('App\Student', 'student');
    }

    public function curricular_units() 
    {
        $this->belongsToMany('App\CurricularUnit', 'curriculatUnit');
    }
}
