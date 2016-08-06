@extends('layouts.admin')



@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>USERS POSTS:</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
            	<thead>
            		<tr>
            			<th>id      </th>
                        <th>user    </th>
                        <th>photo   </th>
                        <th>category</th>
                        <th>title   </th>
                        <th>body    </th>
                        <th>created </th>
                        <th>updated </th>
            		</tr>
            	</thead>
            	<tbody>
                    @if($posts)
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id }}                          </td>
                                <td>{{$post->user->name}}                   </td>
                                <td><img height="50" src="{{$post->photo? $post->photo->path : 'http://placehold.it/50x50'}}" alt="" class="img-rounded"></td>
                                <td>{{$post->category_id}}                  </td>
                                <td>{{$post->title}}                        </td>
                                <td>{{$post->body}}                         </td>
                                <td>{{$post->created_at->diffForHumans()}}  </td>
                                <td>{{$post->updated_at->diffForHumans()}}  </td>
                            </tr>
                        @endforeach
                    @endif
            	</tbody>
            </table>
        </div>
    </div>



@endsection