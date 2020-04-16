<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessageReceiver extends Model
{
    protected $table = "group_message_receiver";

    protected $fillable = [
        'group_id'
    ];

    public function sender()
    {
        $this->hasOne('App\Student');
    }
}
