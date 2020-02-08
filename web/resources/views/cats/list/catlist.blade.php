@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                <select name="app-cat" id="app-cat" class="form-control input-lg dynamic-app-cats" data-dependent="categories" >
                 <option value="">Select App</option>
                 @foreach ($cats as $cat)
                     <option value="{{ $cat->id}}">{{ $cat->title }}</option>
                 @endforeach
                </select>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Catagory list</h3>
                    @if (count($cats)>0)
                        <table id="categories" name="categories" class="table table-striped">
                            {{-- <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <div id="categories" name="categories"></div> --}}

                            {{-- @foreach ($cats as $cat)
                            <tr>
                                <td>{{$cat->title}}</td>
                                <td><a href={{route('cats.edit', $cat->id)}} class="btn btn-default">Edit</a></td>
                                <td>
                                    <form method="POST" action="{{ route('cats.destroy', $cat->id) }}" class='pull-right' accept-charset="UTF-8">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-danger" value='Delete'/>
                                    </form>
                                </td>
                            </tr>
                            @endforeach --}}
                            </table>
                        @else
                        <p>You have no catagory</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
