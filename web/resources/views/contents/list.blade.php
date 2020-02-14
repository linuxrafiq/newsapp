@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Content List</h5>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($contents)>0)
                    @foreach ($contents as $content)
                    {{-- <td><img width="50" height="50" src="/storage/cover_images/{{$cat->cover_image}}"></td> --}}
                    <div class="card">
                        <h5 class="card-header">{{$content->app->title}}
                        ->{{$content->category->title}}->{{$content->subcategory->title}}</h5>
                        <div class="card-body">
                            @if ($content->content->title!=null)
                            <h5 class="card-title">{{$content->content->title}}</h5>
                            @endif
                          <p class="card-text">{{$content->content->content}}</p>
                          <div class="row">
                            <a href='{{route('contents.edit', $content->content->id)}}' class="btn btn-primary col-md-3">Edit</a>
                            <form method="POST" action="{{ route('contents.destroy', $content->content->id) }}" class='pull-right col-md-5 col-md-offset-2' accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-danger col-md-3" value='Delete'/>
                            </form>
                        </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                        @else
                        <p>You have no contents</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
