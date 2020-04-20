<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps  = false;

    protected $table = "message";

    protected $fillable = [
        'content'
    ];

    public function sender_id()
    {
        return $this->belongsTo('App\Student');
    }

    public function receiver_id()
    {
        return $this->hasOne('App\Student');
    }
}
