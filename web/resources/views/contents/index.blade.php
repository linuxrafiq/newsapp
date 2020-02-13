
@extends('layouts.app')
@push('head')
<!-- Initialize Quill editor -->
<script>
 var quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>
    @endpush
@section('content')
<form id="form_id" enctype="multipart/form-data">
    <div class="form-group">
      <select name="app_cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="category" >
       <option value="">Select App</option>
       @foreach ($cats as $cat)
            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
       @endforeach
      </select>
     </div>
     <div class="form-group">
      <select name="category" id="category" class="form-control input-lg dynamic" data-dependent="subcategory">
       <option value="">Select Category</option>
      </select>
     </div>
      <div class="form-group">
        <select name="subcategory" id="subcategory" class="form-control input-lg">
         <option value="">Select Subcategory</option>
        </select>
       </div>
        <div class="form-group">
            <select name="type" id="type" class="form-control input-lg dynamic-view" data-dependent="view-area">
             <option value="">Select content type</option>
             <option value="1">Normal Text</option>
             <option value="2">Html Text</option>
             <option value="3">File uploaded</option>
             <option value="4">PDF</option>
             <option value="5">Image</option>
            </select>
        </div>
        <div class="from-group">
          <label for="title">Content title(optional):</label>
          <input type="text" name="title" id ="title_id" class="form-control" placeholder="Category name"/><br>
      </div>
      <div class="form-group">
        <label for="image" >Upload an image (optional)</label>
        <input type="file" id="image" name="cover_image" autocomplete="off" class="form-control"/>
      </div>
        <div class="row" id="view-area" name="view-area">
          <!--this part will change-->
        </div>
        <br>
        
        <button type="button" onclick="WebApp.ContentController.onClickContentSubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
    
    {{-- <textarea name="comment" form="input-form">Enter text here...</textarea>  --}}
    
@endsection