<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessageReceiver extends Model
{
    protected $table = "group_message_receiver";

    protected $primaryKeys = ['group_id', 'student_id'];

    protected $fillable = [
        'group_name'
    ];

    public function receivers()
    {
        $this->hasOne('App\Student');
    }
}
