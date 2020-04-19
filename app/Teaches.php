<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaches extends Model
{
    protected $table = 'teaches';
    protected $primaryKey = ['professor_id', 'cu_id'];

    public function professors() {
        return $this->belongsToMany('App\Professor');
    }

    public function curricularUnits() {
        return $this->belongsToMany('App\CurricularUnits');
    }
}
