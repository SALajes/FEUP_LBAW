<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps  = false;

    protected $table = "rating";

    protected $fillable = [
        'has_voted'
    ];

    public function reviewer()
    {
        return $this->belongsTo('App\Student');
    }

    public function reviewedStudent()
    {
        return $this->belognsTo('App\Student');
    }

    public function reviewedProfessor()
    {
        return $this->belongsTo('App\Professor');
    }

    public function reviewedCurricularUnit()
    {
        return $this->belongsTo('App\CurricularUnit');
    }
}
