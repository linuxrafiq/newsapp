@extends('layouts.app')
@section('content')
    <h1>Create a category</h1>
    <form>
        <div class="form-group">
            <select name="cat" id="cat" class="form-control input-lg">
                <option value="">Select App</option>
                @foreach ($cats as $cat)
                    <option value={{$cat->id}} >{{ $cat->title }}</option>

                    {{-- @if (old('cat')==$cat->id)
                        <option value={{$cat->id}} selected>{{ $cat->title }}</option>
                    @else
                        <option value={{$cat->id}} >{{ $cat->title }}</option>
                    @endif --}}
                @endforeach
            </select>
        </div>
        
        <div class="from-group">
            <label for="name-sub">Category name:</label>
            <input type="text" name="name-sub" id ="name-sub" class="form-control" placeholder="Category name"><br>
        </div>
        <br>
        <button type="button" onclick="WebApp.CategoryController.onClickCategorySubmitButton()" class="btn btn-primary">Submit </button>
    </form>
    
@endsection