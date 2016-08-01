@extends('layouts.admin')



@section('content')


    <h1>CREATE USER:</h1>

    {!! Form::open(["method"=>"POST", "action"=>"AdminController@storeUser" , 'role'=>'form', 'files' => true]) !!}

        <div class="form-group {{count($errors) ? $errors->has('name') ? 'has-error':'has-success' : ''}}">
            {!! Form::label('name', 'User name: ', ['class' =>'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control'])!!}
            @if(count($errors))
                @if($errors->has('name'))
                    @foreach($errors->get('name') as $msg)
                        <span class="help-block">{{$msg}}</span>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="form-group {{ count($errors) ? $errors->has('email') ? 'has-error':'has-success' : '' }}">
            {!! Form::label('email','E-mail', ['class' =>'control-label']) !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @if(count($errors))
                @if($errors->has('email'))
                    @foreach($errors->get('email') as $msg)
                        <span class="help-block">{{$msg}}</span>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="form-group {{ count($errors) ? $errors->has('role_id') ? 'has-error':'has-success' : '' }}">
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
            @if(count($errors))
                @if($errors->has('role_id'))
                    @foreach($errors->get('role_id') as $msg)
                        <span class="help-block">{{$msg}}</span>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="form-group {{ count($errors) ? $errors->has('is_active') ? 'has-error':'has-success' : '' }}">
            {!! Form::label('is_active', 'User status:', ['class' =>'control-label']) !!}
            {!!
                Form::select(
                            'is_active',
                            array(
                                    '0' => 'Active',
                                    '1' => 'Not Cative',
                            ),
                            null,
                            ['placeholder' => 'Pick a status...',
                             'class' => 'form-control']
                            )
            !!}
            @if(count($errors))
                @if($errors->has('is_active'))
                    @foreach($errors->get('is_active') as $msg)
                        <span class="help-block">{{$msg}}</span>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('photo', 'User photo: ')!!}
            {!! Form::file('photo', ['class'=>'form-control', 'value'=>'Chose file']) !!}
        </div>

        <div class="form-group {{ count($errors) ? $errors->has('password') ? 'has-error':'has-success' : '' }}">
            {!! Form::label     ('password', 'User password:', ['class' =>'control-label']) !!}
            {!! Form::password  ('password', ['class' => 'form-control']) !!}
            @if(count($errors))
                @if($errors->has('password'))
                    @foreach($errors->get('password') as $msg)
                        <span class="help-block">{{$msg}}</span>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="form-group">
            {!! Form::label     ('created_at', 'Create at:', ['class'=>'control-label']) !!}
            {!! Form::date      ('created_at', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label     ('updated_at', 'Update at:', ['class'=>'control-label']) !!}
            {!! Form::date      ('updated_at', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}


@endsection