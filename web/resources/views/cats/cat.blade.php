@extends('layouts.app')
@section('content')
    <h1>Create a category</h1>
    <form id="form_id" enctype="multipart/form-data">
            <div class="from-group">
            <select name="parent" id="parent_id" class="form-control input-lg">
                <option value="">Select App</option>
                @foreach ($cats as $cat)
                    <option value={{$cat->id}} >{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="from-group">
            <label for="title">Category name:</label>
            <input type="text" name="title" id ="title_id" class="form-control" placeholder="Category name"/><br>
        </div>
        <div class="form-group">
            <input type="file" id="image" name="cover_image" autocomplete="off" class="form-control" />
        </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickCategorySubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection