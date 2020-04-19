<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    public $timestamps  = false;
    
    protected $table = "group_message";

    protected $fillable = [
        'group_id', 'content'
    ];

    public function sender_id()
    {
        $this->belongsTo('App\Student');
    }
}
