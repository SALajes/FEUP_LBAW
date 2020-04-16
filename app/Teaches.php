<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaches extends Model
{
    protected $table = 'teaches';

    public function professors() {
        return $this->belongsToMany('App\Professor');
    }

    public function curricularUnits() {
        return $this->belongsToMany('App\CurricularUnits');
    }
}
