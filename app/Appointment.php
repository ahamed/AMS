<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    public function visitors(){
        return $this->belongsTo('App\Visitor','visitor_id','mobile');
    }

    public function members(){
        return $this->belongsTo('App\Member','member_id','mobile');
    }
}
