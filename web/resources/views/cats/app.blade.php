@extends('layouts.app')
@section('content')
    <form id="form_id" enctype="multipart/form-data">
        <div class="from-group">
            <label for="title">App name:</label>
            <input type="text" name="title" id ="title_id" class="form-control" placeholder="App name"><br>
        </div>
        <br>
        <div class="form-group">
            <input type="file" id="image" name="cover_image" autocomplete="off" class="form-control" />
        </div>
        <button type="button" onclick="WebApp.CategoryController.onClickAppSubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection