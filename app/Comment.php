<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content'
    ];

    protected $primaryKey = ['comment_id', ''];

    public function author()
    {
        $this->hasOne('App\Student');
    }

    public function post()
    {
        $this->hasOne('App\Post');
    }
}
