<div class="col-md-12">
    @if(Session::has('message'))
     <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
  @if(Session::has('alert-danger'))
  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('alert-danger') }}</p>
  @endif
   <div class="messages"></div>
</div>

@if(count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class = "alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success')) 
<div class = "alert alert-success">
    {{-- {{$success->message}} --}}
    {{session('success')}}
</div>
@endif

@if(session('error'))
<div class = "alert alert-danger">
    {{session('error')}}
</div>
@endif