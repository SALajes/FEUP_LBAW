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
        $this->belongsTo('App\Student', 'student');
    }

    public function curricular_units() 
    {
        $this->belongsTo('App\CurricularUnit', 'curriculatUnit');
    }

    public function studentsCUs()
    {
        $this->belongsTo('App\Student', 'curricularUnit', 'student');
    }
}
