
@extends('layouts.app')
@section('content')
    <h1>Create a sub category</h1>
    <form>
    <div class="form-group">
        <label for="app-cat">Select an app</label>
      <select name="app-cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="category" >
       <option value="">Select App</option>
       @foreach ($cats as $cat)
          @if ($cat->parent_id==0)
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
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
            <label for="name-sub">Sub Category name:</label>
            <input type="text" name="name-sub" id ="name-sub" class="form-control" placeholder="Sub Category name"><br>
        </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickSubcategorySubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection