<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content'
    ];

    public function sender()
    {
        $this->hasOne('App\Student');
    }

    public function receiver()
    {
        $this->hasOne('App\Student');
    }
}
