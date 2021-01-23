<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{

	protected $table = 'houses';

    public function rooms(){
        return $this->hasMany('App\Room', 'house_id', 'id');
    }

    public function images(){
        return $this->hasMany('App\Image', 'house_id', 'id');
    }

}
