@extends('layouts.app')
@section('content')
    <h1> Category</h1>
    @if (count($cats)>0)
        @foreach ($cats as $cat)
            <div class = 'well'>
                <h3>{{$cat->title}}</h3>
                <small>Created on {{$cat->created_at}}</h3>
            </div>
        @endforeach
    @endif
    
@endsection