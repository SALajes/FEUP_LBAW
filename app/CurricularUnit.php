<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurricularUnit extends Model
{
    public $timestamps  = false;

    protected $table = "curricular_unit";

    protected $fillable = [
        'name', 'abbrev', 'description'
    ];

    public function student() {
        return $this->hasMany('App\Student');
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
        return $this->hasMany('App\Post', 'cu_id', 'id');
    }
}
