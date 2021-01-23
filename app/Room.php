<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

	protected $table = 'rooms';

    public function images(){
        return $this->hasMany('App\Image', 'room_id', 'id');
    }

    public function house(){
        return $this->belongsTo('App\House', 'house_id','id');
    }
}
