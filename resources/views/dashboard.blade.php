@extends('layouts.app')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in !') }}
                </div>
                <div class="card-body">
                    <h3>Posts</h3>
                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>id</th>
                                <th>Title</th>
                                <th></th>
                                <th></th>
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
                                        
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No post</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
