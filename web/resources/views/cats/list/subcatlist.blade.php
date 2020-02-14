@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                {{-- <select name="app-cat" id="app-cat" class="form-control input-lg dynamic-app-cats" data-dependent="categories" >
                 <option value="">Select App</option>
                 @foreach ($cats as $cat)
                     <option value="{{ $cat->id}}">{{ $cat->title }}</option>
                 @endforeach
                </select> --}}

                <form>
                    <div class="form-group">
                      <select name="app-cat" id="app-cat" class="form-control input-lg dynamic" data-dependent="category" >
                       <option value="">Select App</option>
                       @foreach ($cats as $cat)
                          @if ($cat->parent_id==0)
                            <option value="{{ $cat->id}}">{{ $cat->title }}</option>
                          @endif
                       @endforeach
                      </select>
                     </div>
                     <div class="form-group">
                      <select name="category" id="category" class="form-control input-lg dynamic-app-cats" data-dependent="subcategories">
                       <option value="">Select Category</option>
                      </select>
                     </div>
                </form>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Subcatagory list</h3>
                    @if (count($cats)>0)
                        <table id="subcategories" name="subcategories" class="table table-striped">
                            
                        </table>
                        @else
                        <p>You have no subcatagory for this category</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
