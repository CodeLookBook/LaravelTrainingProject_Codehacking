@extends('layouts.admin')



@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>CREATE CATEGORY:</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['action'=>'AdminController@storeCategory', 'role'=>'form']) !!}
            <div class="form-group {{ count($errors)? $errors->has('name')? 'has-error' : 'has-success' : ''  }}">
                {!! Form::label('name', 'Category name:', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}

                @if(count($errors))
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <span class="help-block">{{$error}}</span>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="form-group">
                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection