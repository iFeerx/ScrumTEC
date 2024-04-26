<html>
    <head>
        <title>@yield('titulo')</title>
        @vite(['resources/css/app.css','resources/sass/global/sprintboard.scss', 'resources/js/app.js'])
    </head>
    <body>
        <main id="main">
            @section('main')
                @if (isset($main))
                    {{$main}}
                @endif
                @show
        </main>
    </body>
</html>
