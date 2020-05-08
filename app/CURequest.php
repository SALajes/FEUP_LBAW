<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CURequest extends Model
{
    public $timestamps  = false;

    protected $table = "cu_request";

    protected $fillable = [
        'name', 'abbrev', 'link_to_cu_page', 'additional_info', 'request_status', 'student_id'
    ];

    public function author(){
        return $this->belongs('App\Student');
    }

}
