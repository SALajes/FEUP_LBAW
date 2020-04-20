<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model
{
    public $timestamps  = false;

    protected $table = "enrolled";
    protected $primaryKey = ['student_id', 'cu_id'];

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
