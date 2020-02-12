@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>App list</h3>
                    @if (count($cats)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($cats as $cat)
                            <tr>
                                <td><img width="50" height="50" src="/storage/cover_images/{{$cat->cover_image}}"></td>
                                <td>{{$cat->title}}</td>
                                <td><a href='{{route('cats.edit', $cat->id)}}' class="btn btn-default">Edit</a></td>
                                <td>
                                    <form method="POST" action="{{ route('cats.destroy', $cat->id) }}" class='pull-right' accept-charset="UTF-8">
                                    {{-- {!!Form::open(['action'=>['CategoryController@destroy', $cat->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!} --}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-danger" value='Delete'/>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </table>
                        @else
                        <p>You have no app</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
