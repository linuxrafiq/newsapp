
@extends('layouts.app')
@section('content')
    <h1>Create a sub category</h1>
    
    <form id="form_id" enctype="multipart/form-data">
        <label for="app-cat">Select an app</label>
      <select name="app-cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="parent" >
       <option value="">Select App</option>
       @foreach ($cats as $cat)
          @if ($cat->parent_id==0)
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
          @endif
       @endforeach
      </select>

     <br />
     <div class="form-group">
      <label for="parent">Select a category</label>
      <select name="parent" id="parent" class="form-control input-lg">
       <option value="">Select Category</option>
      </select>
     </div>
    
      <br>

        <div class="from-group">
            <label for="title">Sub Category name:</label>
            <input type="text" name="title" id ="title_id" class="form-control" placeholder="Sub Category name"/><br>
        </div>
        <div class="form-group">
          <input type="file" id="image" name="cover_image" autocomplete="off" class="form-control" />
      </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickSubcategorySubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection