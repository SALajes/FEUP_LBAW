<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{   
    use Notifiable;

    public $timestamps  = false;

    protected $table = "student";

    protected $fillable = [
        'name', 'student_number', 'bio', 'email', 'profile_image', 'administrator', 'password'
    ];

    public function getImageAttribute()
    {
        return $this->profile_image;
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function curricularUnits()
    {
        return $this->belongsToMany('App\Group');
    }   

    public function reviewer()
    {
        return $this->hasMany('App\Rating');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }

    public function friendsWith()
    {
        return $this->belongsToMany('App\Friend');
    }

    public function enrolments()
    {
        return $this->belongsToMany('App\Enrolled');
    }

    public function bans()
    {
        return $this->hasMany('App\Banned');
    }

    public function banned()
    {
        return $this->belongsToMany('App\Banned');
    }

    public function moderator()
    {
        return $this->belongsToMany('App\Moderator');
    }

    public function posts()
    {
        $this->hasMany('App\Posts');
    }

    public function sender()
    {
        $this->hasMany('App\Message');
    }

    public function receiver()
    {
        $this->belongsToMany('App\Message');
    }

    public function groupSender()
    {
        $this->hasMany('App\GroupMessage');
    }

    public function groupReceiver()
    {
        $this->belongsToMany('App\GroupMessageReceiver');
    }
}
