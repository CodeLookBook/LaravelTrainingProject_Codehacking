<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index',compact("users"));
    }

    public function createUser(){
        $roles = Role::lists('name','id');
        return view('admin.users.create', compact('roles'));
    }

    public  function storeUser(UsersRequest $request){

        $user = new User();
        $file = $request->file('photo');

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->role_id      = $request->role_id;
        $user->is_active    = $request->is_active;
        $user->password     = bcrypt($request->password);
        $user->created_at   = $request->created_at;
        $user->updated_at   = $request->updated_at;

        if($file){
            $name = time().$file->getClientOriginalName();
            $date = new \DateTime();

            $photo = new Photo();
            $photo->path = $name;
            $photo->created_at = $date->getTimestamp();
            $photo->updated_at = $date->getTimestamp();
            $photo->save();
            $user->photo_id = $photo->id;

            $file->move('image', $name);

        }

        $user->save();

        return redirect('admin/users');
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function updateUser(EditUserRequest $request, $id){

        //поиск данных редактируемого профиля пользователя
        $user = User::findOrfail($id);

        //получение указателя на файл загруженный пользователем
        $file = $request->file('path');

        //сохраненние отредактированных данных пользователя
        $user->name = $request->name;
        $user->email= $request->email;
        $user->is_active = $request->is_active;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->password);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;

        //сохранение новой аватарки пользователя
        if($file){

            //удаление сущестующей аватарки пользователя
            if($user->photo_id){
                if($user->photo){
                    if(file_exists($user->photo->path)){
                        unlink($user->photo->path);
                    }
                }
            }

            //сохранение новой аватарки
            $name = time().$file->getClientOriginalName();
            $date = new \DateTime();


            $photo = $user->photo ? $user->photo : new Photo();
            $photo->path = $name;
            $photo->updated_at = $date->getTimestamp();
            $photo->save();
            $user->photo_id = $photo->id;

            $file->move('image', $name);
        }

        //сохранения в БД отредактированных данных
        $user->save();

        return redirect('admin/users');
    }
}
