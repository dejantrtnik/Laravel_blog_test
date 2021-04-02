@extends('layouts.app')


@section('body')

    <h3>Create</h3>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
      </div>
      <div class="form-group">
            {{ Form::label('body', 'Title') }}
            {{ Form::textarea('body', '', ['id' => 'editor-post', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
      </div>
      <div class="form-group">
        {{ Form::file('cover_image') }}
      </div>
      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'editor-post' );
    </script>
@endsection
