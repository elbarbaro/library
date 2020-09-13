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
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo"><i class="material-icons">book</i>Library</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        @if (Auth::check())
                            <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li><a href="{{ url('/books/new') }}">Books</a></li>
                            <li><a href="{{ url('/categories/new') }}">Categories</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            @yield('data')
        </div>
        <script src="{{asset('js/materialize.min.js')}}"></script>
        @stack('scripts')
    </body>
</html>
