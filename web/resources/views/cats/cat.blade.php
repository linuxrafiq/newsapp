@extends('layouts.app')
@section('content')
    <h1>Create a category</h1>

    {!!Form::open(['action'=>'CategoryController@storecat', 'method'=>'POST']) !!}
        <div class="form-group">
            <select name="cat" id="cat" class="form-control input-lg">
                <option value="">Select App</option>
                @foreach ($cats as $cat)
                    @if (old('cat')==$cat->id)
                        <option value={{$cat->id}} selected>{{ $cat->title }}</option>
                    @else
                        <option value={{$cat->id}} >{{ $cat->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="from-group">
            {{Form::label('name','Category name:')}}
            {{Form::text('name','',['class'=>'form-control', 'placeholder'=>'Category name'])}}
        </div>
    <br>
    {!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}
    
@endsection