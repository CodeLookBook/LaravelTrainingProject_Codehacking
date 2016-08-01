<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user(){
        return $this->hasOne('App\User','photo_id','id');
    }
}
