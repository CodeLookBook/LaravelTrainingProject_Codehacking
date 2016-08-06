@extends('layouts.admin')



@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>CREATE POST:</h1>
            </div>
        </div>
    </div>

    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminController@storePost', 'role'=>'form', 'files'=>true, 'id'=>'PostCreationForm']) !!}

            <div class="form-group {{count($errors)? $errors->has('category_id')? 'has-error' : 'has-success' : ''}}">
                {!! Form::label('category_id', 'Category: ',['class'=>'control-label']) !!}
                {!! Form::select('category_id', ['2'=>'PHP','1'=>'JavaScript' ], null, ['class'=>'form-control', 'placeholder'=>'Pick post category']) !!}

                {{--Отображение ошибки ввода данных в поле--}}
                @if(count($errors))
                    @if($errors->has('category_id'))
                        @foreach($errors->get('category_id') as $msg)
                            <span class="help-block">{{$msg}}</span>
                        @endforeach
                    @endif
                @endif
            </div>

            <div class="form-group {{count($errors)? $errors->has('photo_id')? 'has-error' : 'has success' : ''}}">
                {!! Form::label('photo_id', 'Post photo: ', ['class'=>'control-label']) !!}
                {!! Form::file('photo_id', ['value'=>'Choose file']) !!}

                {{--Отображение ошибки ввода данных в поле--}}
                @if(count($errors))
                    @if($errors->has('photo_id'))
                        @foreach($errors->get('photo_id') as $msg)
                            <span class="help-block">{{$msg}}</span>
                        @endforeach
                    @endif
                @endif
            </div>

            <div class="form-group {{count($errors)? $errors->has('title')? 'has-error': 'has-success' : ''}}">
                {!! Form::label('title', 'Title:', ['class'=>'control-label']) !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}

                {{--Отображение ошибки ввода данных в поле--}}
                @if(count($errors))
                    @if($errors->has('title'))
                        @foreach($errors->get('title') as $msg)
                            <span class="help-block">{{$msg}}</span>
                        @endforeach
                    @endif
                @endif
            </div>

            <div class="form-group {{count($errors)? $errors->has('body') ? 'has-error' : 'has-success' : ''}}">
                {!! Form::label('body', 'Body', ['class'=>'control-label']) !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}

                {{--Отображение ошибки ввода данных в поле--}}
                @if(count($errors))
                    @if($errors->has('body'))
                        @foreach($errors->get('body') as $msg)
                            <span class="help-block">{{$msg}}</span>
                        @endforeach
                    @endif
                @endif
            </div>

        {!! Form::close() !!}

        {!! Form::submit('save', ['class'=>'btn btn-primary', 'form'=>'PostCreationForm']) !!}

    </div>


@endsection