@extends('layouts.app')
@section('content')
    <h1>CSRF Token:{{ csrf_token() }}</h1>
    {!!Form::open(['action'=>'CategoryController@store', 'method'=>'POST'])!!}
    
    <div class="form-group">
      <select name="category" id="category" class="form-control input-lg dynamic" data-dependent="subcategory">
       <option value="">Select Category</option>
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
      <select name="subcategory" id="subcategory" class="form-control input-lg dynamic">
       <option value="">Select Subcategory</option>
      </select>
     </div>
    
    {{-- <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Category
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if (count($cats)>0)
          @foreach ($cats as $cat)
            @if ($cat->parent_id==0)
              <a class="dropdown-item" href="#" data-catid={{$cat->id}}>{{$cat->title}}</a>
            @endif
          @endforeach
        @endif
      </div>
    </div>
    
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sub Category
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if (count($cats)>0)
          @foreach ($cats as $cat)
            @if ($cat->parent_id!=0)
              <a class="dropdown-item" href="#">{{$cat->title}}</a>
            @endif
          @endforeach
        @endif
      </div>
    </div> --}}
    
      <br>

        <div class="from-group">
            {{Form::label('title','Category name:')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Category name'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    
@endsection