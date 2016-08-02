<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //Storage of user photos that were saved there during user creation.
    protected $storage = "/image/";

    public function user(){
        return $this->hasOne('App\User','photo_id','id');
    }

    public function getPathAttribute($photo){
        return $this->storage.$photo;
    }
}
