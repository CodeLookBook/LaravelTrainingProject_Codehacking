<?php

namespace App\Http\Controllers;

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

    public  function storeUser(Requests\UsersRequest $request){

        $user = new User();
        $file = $request->file('photo');

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->role_id      = $request->role_id;
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
}
