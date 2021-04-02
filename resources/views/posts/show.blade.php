@extends('layouts.app')
@php
    $date = date("d.m.Y - H:i:s", strtotime($post->created_at));
@endphp

@section('body')
<div class="">
    <a class="btn btn-primary" href="/posts">Back</a>
    <h3>{{ $post->title }}</h3>
    <p>{!! $post->body !!}</p>
    <p>{{ $date  }} by {{ $post->user->name }}</p>
    <a href="/storage/app/public/cover_images/{{ $post->cover_image }}"><img style="width: 50%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}" alt=""></a>
    <br>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
        <a class="btn btn-success float-right ml-2" href="/posts/{{ $post->id }}/edit">Edit</a>
            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!} 
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger float-right ml-2', ]) }}            

                
            {!! Form::close() !!}
        @endif
    @endif
</div>
@endsection

