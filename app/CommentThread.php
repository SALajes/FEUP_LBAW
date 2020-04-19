<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentThread extends Model
{
    public $timestamps  = false;
    
    protected $table = "comment_thread";
    protected $primaryKey = ['comment_id', 'parent_id'];

    public function parent()
    {
        $this->belongsTo('App\Comment', 'parent_id');
    }

    public function children()
    {
        $this->hasMany('App\Comment', 'parent_id');
    }
}
