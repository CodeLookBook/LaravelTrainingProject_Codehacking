<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function photo(){
        return $this->belongsTo('App\Photo','photo_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id','id');
    }
}
