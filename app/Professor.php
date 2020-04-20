<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $timestamps  = false;

    protected $table = "professor";

    protected $fillable = [
        'name', 'email', 'picture_path', 'abbrev'
    ];

    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }

    public function teaches() {
        return $this->belongsToMany('App\Teaches');
    }
}
