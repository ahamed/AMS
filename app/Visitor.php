<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    //
    protected $fillable = ['user_id','building_id','name','mobile','profession','email','address','image_link','flag'];
    public function appointments(){
        return $this->hasMany('App\Appointment','visitor_id','mobile');
    }
}
