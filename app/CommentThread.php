<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentThread extends Model
{
    protected $table = "comment_thread";

    public function parent()
    {
        $this->belongsTo('App\Comment', 'parent_id');
    }

    public function children()
    {
        $this->hasMany('App\Comment', 'parent_id');
    }
}
