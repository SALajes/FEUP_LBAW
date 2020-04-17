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

    public function professors() {
        return $this->belongsToMany('App\Teaches');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }

    public function enrolments()
    {
        return $this->belongsToMany('App\Enrolled');
    }

    public function bans()
    {
        return $this->belongsToMany('App\Banned');
    }

    public function moderators()
    {
        return $this->belongsToMany('App\Moderator');
    }

    public function posts()
    {
        $this->hasMany('App\Posts');
    }
}
