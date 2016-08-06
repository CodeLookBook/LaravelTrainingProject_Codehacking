<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Получение списка ролей пользователя
    public function roles(){
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    //Получение фотографии пользователя
    public  function photo(){
        return $this->belongsTo('App\Photo', 'photo_id', 'id');
    }

    //Получение списка постов пользователя
    public function posts(){
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    //Является ли пользователь администратором
    public function isAdmin(){
        $isAdmin = false;

         if($this->roles->name == "administrator" && $this->is_active == 1) {
             $isAdmin = true;
         }

        return $isAdmin;
    }
}
