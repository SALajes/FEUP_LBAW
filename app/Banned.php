<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banned extends Model
{
    protected $table = "banned";

    protected $primaryKey = ['student_id', 'cu_id'];

    protected $fillable = [
        'reason'
    ];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function curricular_units()
    {
        return $this->belongsToMany('App\CurricularUnit');
    }

    public function moderator()
    {
        return $this->hasOne('App\Student');
    }
}
