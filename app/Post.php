<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'public_feed', 'type'
    ];

    public function author()
    {
        return $this->belongsTo('App\Student');
    }

    public function curricularUnit()
    {
        $this->belongsTo('App\CurricularUnit');
    }

    public function comments()
    {
        $this->hasMany('App\Comments');
    }
}
