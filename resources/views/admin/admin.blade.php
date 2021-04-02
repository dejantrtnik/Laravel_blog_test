@extends('layouts.app')

@section('body')
<h1>{{ $users }}</h1> 

@foreach ($users as $user)

      {{ $user }} <br>
@endforeach

@foreach ($posts as $post)
      {{ $post }} <br>
@endforeach



@if (count($users) > 0)
<table class="table table-striped">
    <tr>
        <th>id</th>
        <th>User</th>
        <th>Role</th>
        <th></th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->role }}</th>
            <th><a href="/posts/{{ $user->name }}/edit" class="btn btn-primary">Edit</a></th>
            <th>
                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            </th>

        </tr>
    @endforeach
</table>
@else
<p>No users</p>
@endif





@if (count($posts) > 0)
<table class="table table-striped">
    <tr>
        <th>id</th>
        <th>Title</th>
        <th></th>
        <th></th>
        <th>User name</th>
    </tr>
    @foreach ($posts as $post)
        <tr>
            <th>{{ $post->id }}</th>
            <th>{{ $post->title }}</th>
            
            <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></th>
            <th>
                
                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            </th>
            <th>
                  {{ $post->user->name }}
            </th>
        </tr>
    @endforeach
</table>
@else
<p>No post</p>
@endif







@endsection
