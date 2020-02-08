
@extends('layouts.app')
@section('content')
    <form id="input-form">
    <div class="form-group">
      <select name="app-cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="category" >
       <option value="">Select App</option>
       @foreach ($cats as $cat)
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
       @endforeach
      </select>
     </div>
     <div class="form-group">
      <select name="category" id="category" class="form-control input-lg dynamic" data-dependent="subcategories">
       <option value="">Select Category</option>
      </select>
     </div>
      <div class="form-group">
        <select name="subcategories" id="subcategories" class="form-control input-lg">
         <option value="">Select Subcategory</option>
        </select>
       </div>
        <div class="form-group">
            <select name="type" id="type" class="form-control input-lg">
             <option value="">Select content type</option>
             <option value="1">Normal Text</option>
             <option value="2">Html Text</option>
             <option value="3">File uploaded</option>
             <option value="4">PDF</option>
             <option value="5">Image</option>
            </select>
           </div>

        <div class="from-group">
            <label for="content-area">Content:</label>
            <textarea class="form-control" rows="5" id="content-area"></textarea>        
        </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickSubcategorySubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    {{-- <textarea name="comment" form="input-form">Enter text here...</textarea>  --}}
@endsection