@extends('layouts.admin')



@section('content')


    <h1>USERS:</h1>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
            	<thead>
            		<tr>
                        <th>Id</th>
                        <th>Photo</th>
            			<th>User name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
            		</tr>
            	</thead>
            	<tbody>

                    @if($users)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <img height="50px" width="50px" src="{{$user->photo ? $user->photo->path : 'http://placeholder.it/50x50'}}" alt="..." class="img-circle">
                                </td>
                                <td><a href="{{action('AdminController@editUser',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles()->get() as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td>{{$user->is_active ? "active" : "not active"}}</td>
                                <td>{{$user->created_at? $user->created_at->diffForHumans() : $user->created_at}}</td>
                                <td>{{$user->updated_at? $user->updated_at->diffForHumans() : $user->updated_at}}</td>
                            </tr>
                        @endforeach
                    @endif

            	</tbody>
            </table>
        </div>
    </div>


@endsection