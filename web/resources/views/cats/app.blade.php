@extends('layouts.app')
@section('content')
    <form>
        <div class="from-group">
            <label for="name-sub">App name:</label>
            <input type="text" name="name-sub" id ="name-sub" class="form-control" placeholder="App name"><br>
        </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickAppSubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection