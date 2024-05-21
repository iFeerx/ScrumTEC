<nav class="navbar">
    <a class="title" href="/">Scrum Tec</a>
    <a class="boton-Etiqueta" href="/">Página de inicio</a>

    @if(Session::has('usuario'))
    @php
        $usuario = Session::get('usuario');
        $proyectos = $usuario->proyectos;
    @endphp
    <!-- Mostrar opciones para usuarios autenticados -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-item" href="#" id="recentProjectsDropdown">Proyectos recientes</a>
            <div class="dropdown-menu" aria-labelledby="recentProjectsDropdown">
                <!-- Lista de proyectos recientes -->
                @if ($proyectos != null)
                @foreach ($proyectos->sortByDesc('created_at')->take(5) as $proyecto)
                <a class="dropdown-item" href="/proyecto/sprintBoard/{{ $proyecto->id }}">
                    {{ $proyecto->nombre }}
                    <br><div class="propietario">Scrum master: {{ $proyecto->roles()->where('rol', 'Scrum master')->first()->usuario->nombre }}</div>
                </a>
                @endforeach
                @endif
            </div>
        </li>
    </ul>
    <a href="/nuevo-proyecto" class="boton-Azul"><i class="fas fa-add" style="margin-right: 4px;"></i> Crear</a>
    <div class="navbar-right">
        <a href="#" class="boton-Etiqueta">
            {{ Session::get('usuario')->nombre }}
        </a>
        <a href="/usuarios/logout" class="boton-Rojo"> <i class="fas fa-sign-out" style="margin-right: 4px;"></i> Cerrar Sesión</a>
    </div>
    @else
    <!-- Mostrar opciones para usuarios no autenticados -->
    <div class="navbar-right">
        <a href="/nuevo-proyecto" class="boton-Etiqueta">Registrarse</a>
        <a href="/usuarios/login" class="boton-Azul"><i class="fas fa-user" style="margin-right: 7px;"></i>Iniciar
            Sesión</a>
    </div>
    @endif
</nav>
