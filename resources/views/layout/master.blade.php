<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Styles -->
        <link href="{{asset('css/materialize.min.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="top-left links">
                @if (Auth::check())
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ url('/books/new') }}">Books</a>
                    <a href="{{ url('/categories/new') }}">Categories</a>
                @endif
            </div>

            <div class="content">
                @yield('data')
            </div>
        </div>
        <script src="{{asset('js/materialize.min.js')}}"></script>
    </body>
</html>
