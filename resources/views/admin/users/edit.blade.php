@extends('layouts.admin')



@section('content')


    <h1>EDIT USER:</h1>

    <div class="col-sm-3">
        <img height="200" width="200" src="{{$user->photo ? $user->photo->path : "http://placeholder.it/200x200"}}" alt="{{$user->name.'photo'}}" class="img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::model($user,["action" => ["AdminController@updateUser", $user->id], 'files'=> true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'User name:',['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'User email:', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'User role:', ['class' =>'control-label']) !!}
            {!!
                Form::select(
                            'role_id',
                            $roles,
                            null,
                            ['placeholder' => 'Pick a role...',
                             'class' => 'form-control']
                            )
            !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active','User state:', ['class' => 'control-label']) !!}
            {!!
                Form::select(
                            'is_active',
                            array(
                                    '0' => 'Not Aative',
                                    '1' => 'Aative',
                            ),
                            null,
                            ['placeholder' => 'Pick a status...',
                             'class' => 'form-control']
                            )
            !!}
        </div>

        <div class="form-group">
            {!! Form::label('path', 'User photo: ', ['class'=>'form-label']) !!}
            {!! Form::file('path', ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'User password', ['class'=>'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label     ('created_at', 'Create at:', ['class'=>'control-label']) !!}
            {!! Form::date      ('created_at', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label     ('updated_at', 'Update at:', ['class'=>'control-label']) !!}
            {!! Form::date      ('updated_at', $user->update_at , ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>


        {!! Form::close() !!}
    </div>



@endsection