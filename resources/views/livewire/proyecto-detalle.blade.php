<div class="tabla-scrum">
    <h1>Nombre: {{ $proyecto->nombre }}</h1>
    <p>Scrum Master: {{ $proyecto->scrumMasters->first()->nombre }}</p>
    <p>Descripción: {{ $proyecto->descripcion }}</p>
    <p>Fecha de entrega: {{ $proyecto->fecha_entrega }}</p>
    <p>Esfuerzo total: {{ $proyecto->esfuerzoTota }}</p>

    <!-- Muestra las historias del proyecto en una tabla -->
    <h2>Historias</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Historia</th>
                <th>Avance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyecto->historias as $historia)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $historia->historia }}</td>
                    <td>%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button wire:click="agregarHistoria" class="boton-Azul">Agregar Historia</button>

    <!-- Muestra los usuarios asociados a un rol específico del proyecto en una tabla -->
    <h2>Usuarios por Rol</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Usuario</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyecto->roles as $rol)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rol->usuario->nombre }}</td>
                    <td>{{ $rol->rol}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button wire:click="mostrarAgregarRoles" class="boton-Azul">Agregar Rol</button>
    <br>
    @if ($mostrarAgregarRol)
        <div class="modal">
            <div class="modal-content">
                <span class="close-button" wire:click="closeModal">×</span>
                <!-- Contenido del modal -->
                <form id="agregarForm">
                    <!-- Combobox para seleccionar usuario -->
                    @if (session('error'))
                        <div id="error" class="error">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error').classList.add('oculto');
                            }, 3000);
                        </script>
                    @endif
                    <label for="usuario">Usuario:</label>
                    <select wire:model="usuario" name="usuario">
                        <option value=""></option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>

                    <!-- Combobox para seleccionar rol -->
                    <label for="rol">Rol:</label>
                    <select wire:model="rol" name="rol">
                        <option value=""></option>
                        @foreach ($roles as $r)
                            <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                    </select>
                </form>
                <button class="boton-Azul" wire:click="agregarRol">Agregar</button>
                <button class="boton-Rojo" wire:click="closeModal">Cancelar</button>
            </div>
        </div>
    @endif
</div>
