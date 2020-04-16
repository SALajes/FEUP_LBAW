<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'cu_id', 'public_feed', 'type'
    ];

    public function author()
    {
        $this->hasOne('App\Student');
    }
}
