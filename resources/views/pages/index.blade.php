@extends('layouts.app')

@section('body')
     <h1></h1> 
@php
    $ip = '193.77.83.59';
    //$ip = $_SERVER['REMOTE_ADDR'];
    //print_r($data);
    
@endphp


{!! Form::open(['action' => ['App\Http\Controllers\PagesController@index'], 'method' => 'GET']) !!}
<div class="form-group">
      {{ Form::label('title', 'Title') }}
      {{ Form::text('title', $ip, ['class' => 'form-control', 'placeholder' => 'ip']) }}
</div>


{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}



  
@endsection
