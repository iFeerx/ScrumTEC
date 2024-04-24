<html>
    <head>
        <title>@yield('titulo')</title>
        @vite(['resources/css/app.css','resources/sass/global/sprintboard.scss', 'resources/js/app.js'])
    </head>
    <body>
        @section('main')
            @show
    </body>
</html>
