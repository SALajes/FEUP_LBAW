<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurricularUnit extends Model
{
    protected $table = "curricular_unit";

    protected $fillable = [
        'name', 'abbrevr', 'description'
    ];

    public function student() {
        return $this->belongsToMany('App\Student');
    }

    // ? 
    public function teaches() {
        return $this->belongsToMany('App\Teaches');
    }
}
