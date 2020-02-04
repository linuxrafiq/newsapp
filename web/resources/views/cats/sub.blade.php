
@extends('layouts.app')
@section('content')
    <h1>Create a sub category</h1>
    {{-- {!!Form::open(['action'=>'CategoryController@storesubcat', 'method'=>'POST'])!!} --}}
    <form>
    <div class="form-group">
        <label for="app-cat">Select an app</label>
      <select name="app-cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="category" >
       <option value="">Select App</option>
       @foreach ($cats as $cat)
          @if ($cat->parent_id==0)
            {{-- <a class="dropdown-item" href="#">{{$cat->title}}</a> --}}
            {{-- @if (old('app')==$cat->id)
            <option value="{{ $cat->id}}" selected>{{ $cat->title }}</option>
            @else
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
            @endif --}}
            @if(Session::has('s_app'))
              @if (Session::get('s_app')==$cat->id)
                <option value="{{ $cat->id}}" selected>{{ $cat->title }}</option>
              @else
                <option value="{{ $cat->id}}">{{ $cat->title }}</option>
              @endif
            @else
              <option value="{{ $cat->id}}">{{ $cat->title }}</option>
            @endif
          @endif
       @endforeach
      </select>
     </div>

     <br />
     <div class="form-group">
      <label for="category">Select a category</label>
      <select name="category" id="category" class="form-control input-lg dynamic">
       <option value="">Select Category</option>
      </select>
     </div>
    
      <br>

        <div class="from-group">
            {{-- {{Form::label('name','')}} --}}
            <label for="name-sub">Sub Category name:</label>
            <input type="text" name="name-sub" id ="name-sub" class="form-control" placeholder="Sub Category name"><br>
            {{-- {{Form::text('name','',['class'=>'form-control', 'placeholder'=>'Sub Category name'])}} --}}
        </div>
        <br>
        <button type="button" onclick="WebApp.Dynamic2LayerSpinner.onClickSubmitButton()" class="btn btn-primary">Submit </button>
        {{-- {{Form::submit('Submit', ['class'=>'btn btn-primary'])}} --}}
    </form>
    
@endsection