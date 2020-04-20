<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps  = false;
    
    protected $table = "comment";

    protected $fillable = [
        'content'
    ];

    public function author_id()
    {
        $this->belongsTo('App\Student');
    }

    public function post_id()
    {
        $this->belongsTo('App\Post');
    }
}
