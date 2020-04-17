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
        return $this->belongsTo('App\Student');
    }

    public function receiver()
    {
        return $this->hasOne('App\Student');
    }
}
