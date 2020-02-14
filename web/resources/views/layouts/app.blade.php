<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #editor-container {
           height: 375px;
           background-color: black
        }
    </style>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript">
        let url_cats_fetch = "{{ route('cats.fetch') }}";
        let url_app_post = "{{ route('cats.storeapp') }}";
        let url_sub_cat_post = "{{ route('cats.storesubcat') }}";
        let url_cat_post = "{{ route('cats.storecat') }}";
        let url_content_post = "{{ route('storecontent') }}";
        let url_cat_edit = "{{ route('cats.edit', ':id') }}";
        let url_cat_destory = "{{ route('cats.destroy', ':id') }}";
        let url_content_type = "{{ route('content.type') }}";
        let url_content_store = "{{ route('contents.store') }}";
        let url_cat_contents = "{{ route('cats.contentlist', ':id') }}";
      </script>
    <script src="{{ asset('js/cats.js') }}" defer></script>
    <script src="{{ asset('js/content.js') }}" defer></script>

    <!--CK Editor-->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <!--CK Editor-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
       
        @include('inc.navbar')
        <main class="py-4 container">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
