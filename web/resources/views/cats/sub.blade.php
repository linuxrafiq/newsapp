@extends('layouts.app')
@section('content')
    <h1>Create a sub category</h1>
    {!!Form::open(['action'=>'CategoryController@store', 'method'=>'POST'])!!}
    
    <div class="form-group">
      <select name="app" id="app" class="form-control input-lg dynamic" data-dependent="category">
       <option value="">Select App</option>
       @foreach ($cats as $cat)
          @if ($cat->parent_id==0)
            {{-- <a class="dropdown-item" href="#">{{$cat->title}}</a> --}}
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
          @endif
       @endforeach
      </select>
     </div>

     <br />
     <div class="form-group">
      <select name="category" id="category" class="form-control input-lg dynamic">
       <option value="">Select Category</option>
      </select>
     </div>
    
      <br>

        <div class="from-group">
            {{Form::label('title','Sub Category name:')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Sub Category name'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    
@endsection