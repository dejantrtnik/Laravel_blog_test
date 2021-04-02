

@extends('layouts.app')


@section('body')

@if($posts->isNotEmpty())
@foreach ($posts as $post)
    <div class="post-list">
          <a href=""><p>{{ $post->title }}</p></a>
        
        <p>{{ $post->created_at }}</p>
        <img style="width: 50%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}">
    </div>
@endforeach
@else 
<div>
    <h2>No posts found</h2>
</div>
@endif
@endsection
