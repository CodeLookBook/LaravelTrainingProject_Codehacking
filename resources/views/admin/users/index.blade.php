@extends('layouts.admin')



@section('content')
    <h1>USERS:</h1>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
            	<thead>
            		<tr>
                        <th>Id</th>
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
                                <td>{{$user->name}}</td>
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