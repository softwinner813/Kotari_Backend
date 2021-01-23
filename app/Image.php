<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
	protected $table = 'images';

    public function room(){
        return $this->belongsTo('App\Room', 'room_id','id');
    }

    public function house(){
        return $this->belongsTo('App\House', 'house_id','id');
    }
}
