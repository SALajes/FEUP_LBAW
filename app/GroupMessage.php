<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $table = "group_message";

    protected $fillable = [
        'group_id', 'content'
    ];

    public function sender()
    {
        $this->belongsTo('App\Student');
    }
}
