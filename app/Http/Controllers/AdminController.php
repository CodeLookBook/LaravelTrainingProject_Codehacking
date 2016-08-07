<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        //сохранения данных об операции в сессии
        Session::flash('data_state', 'has been updated');
        Session::flash('user_name', $user->name);

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
                    if(file_exists(public_path().$user->photo->path)){
                        unlink(public_path().$user->photo->path);
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

    public function destroyUser($id){
        //поиск пользователя в БД
        $user = User::findOrFail($id);

        //сохранение данных в сессию для их вывода в инф.сообщении
        Session::flash('data_state','Has been deleted');
        Session::flash('user_name',$user->name);

        //удаление существующей аватарки пользователя
        if($user->photo_id){
            if($user->photo){
                if(file_exists(public_path().$user->photo->path)){
                    unlink(public_path().$user->photo->path);
                }
            }
        }

        $user->delete();
        return redirect('admin/users');
    }

    public function posts(){
        $posts = Post::all();
        return view('admin/posts/index', compact('posts'));
    }

    public  function createPost(){
        $categories = Category::lists('name', 'id');
        return view('admin/posts/create', compact('categories'));
    }

    public function storePost(PostCreateRequest $request){
        $user   = Auth::user();
        $file  = $request->hasFile('photo_id') ? $request->file('photo_id') : null;

        if($user){
            if($request->hasFile('photo_id')){
                $post               = new Post();
                $post->user_id      = $user->id;
                $post->category_id  = $request->input('category_id');
                $post->title        = $request->input('title');
                $post->body         = $request->input('body');

                if($file){
                    $photo          = new Photo();
                    $photo->path    = time().$file->getClientOriginalName();

                    $file->move('image', $photo->path);

                    $photo->save();

                    $post->photo_id = $photo->id;
                }

                $post->save();
            }

            return redirect('admin/posts');
        }

        return $request->all();
    }

    public function editPost($id){
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id');
        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    public function updatePost(Request $request, $id){
        $post = Post::findOrFail($id);

        if($request->has('category_id')){
            if(!empty($request->input('category_id'))){
                $post->category_id = $request->input('category_id');
            }
        }

        if($request->has('title')){
            if(!empty($request->input('title'))){
                $post->title = $request->input('title');
            }
        }

        if($request->has('body')){
            if(!empty($request->input('body'))){
                $post->body = $request->input('body');
            }
        }

        if($request){
            if($request->hasFile('photo_id')){
                if(!empty($post->photo->path)){
                    if(file_exists(public_path().$post->photo->path)){
                        unlink(public_path().$post->photo->path);
                    }
                }
                $photo = $post->photo ? $post->photo : new Photo();
                $photo->path = time().$request->file('photo_id')->getClientOriginalName();
                $request->file('photo_id')->move('image',$photo->path);

                $photo->save();

                $post->photo_id = $photo->id;
            }

        }

        $post->save();
        return redirect('/admin/posts');
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);

        if($post->photo){
            if(file_exists(public_path().$post->photo->path)){
                unlink(public_path().$post->photo->path);
            }
            $post->photo->delete();
        }

        $post->delete();

        redirect('/admin/posts');
    }

    public function categories(){
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function createCategory(){
        return view('admin.categories.create');
    }

    public function storeCategory(CategoryCreateRequest $request){
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return redirect('/admin/categories');
    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }

    public function updateCategory(CategoryCreateRequest $request, $id){
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect('admin/categories');
    }

    public function destroyCategory($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('admin/categories');
    }
}
