<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps  = false;

    protected $table = "post";

    protected $fillable = [
        'content', 'public_feed', 'type'
    ];

    public function author_id()
    {
        return $this->belongsTo('App\Student');
    }

    public function cu_id()
    {
        $this->belongsTo('App\CurricularUnit');
    }

    public function comments()
    {
        $this->hasMany('App\Comments');
    }
}
