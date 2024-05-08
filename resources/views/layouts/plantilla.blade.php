<html>
    <head>
        <title>@yield('titulo')</title>
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @livewireStyles()
    </head>
    <body>
        <nav id='nav'>
            @section('nav')
                @include('layouts.components.menu_principal')
        </nav>
        <main id="main">
            @section('main')
                @if (isset($main))
                    {{$main}}
                @endif
                @show
        </main>
        @livewireScripts()
    </body>
</html>
