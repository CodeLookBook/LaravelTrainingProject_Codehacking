@extends('layouts.admin')



@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>CATEGORIES</h1>
                <small>Made by administrators.</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>updated</th>
                        <th>created</th>
                    </tr>
                </thead>
                <tbody>
                    @if($categories)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td><a href="{{action('AdminController@editCategory', $category->id)}}">{{$category->name}}</a></td>
                                <td>{{$category->created_at? $category->created_at->diffForHumans(): ''}}</td>
                                <td>{{$category->updated_at? $category->created_at->diffForHumans(): ''}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection