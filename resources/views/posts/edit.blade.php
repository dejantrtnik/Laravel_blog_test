@extends('layouts.app')


@section('body')
    <h3>Edit post</h3>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
      </div>
      <div class="form-group">
            {{ Form::label('body', 'Title') }}
            {{ Form::textarea('body', $post->body, ['id' => 'editor-post', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
      </div>
      <img style="width: 20%;" src="/public/storage/cover_images/{{ $post->cover_image }}" alt="">
      <div class="form-group">
        {{ Form::file('cover_image') }}
      </div>
      {{ Form::hidden('_method', 'PUT') }}
      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'editor-post' );
    </script>
@endsection
