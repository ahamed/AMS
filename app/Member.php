<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = ['building_id','name','mobile','email','designation','address','institute','image_link'];
}
