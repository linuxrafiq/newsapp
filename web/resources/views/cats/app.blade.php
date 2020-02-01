@extends('layouts.app')
@section('content')
    <h1>Create an app</h1>
    {!!Form::open(['action'=>'CategoryController@store', 'method'=>'POST'])!!}
        {{ Form::hidden('parent_id', '0') }}
        <div class='form-group'>
            {{Form::label('name', 'App name')}}
            {{Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'app name'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!!Form::close()!!}
@endsection