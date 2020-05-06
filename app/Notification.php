<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps  = false;

    protected $table = 'notification';
    
    protected $fillable = [
        'content','notification_type', 'seen'
    ];

    public function owner(){
        return $this->belongsTo('App\Student');
    }

}
