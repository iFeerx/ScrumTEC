<!-- resources/views/livewire/administrar-proyectos.blade.php -->
<div>
    <div class="tabla-scrum">
        <h1>Proyectos {{$refresh}}</h1>
    <div>
        <label for="search">Buscar nombre de proyecto:</label>
        <input type="text" id="search" wire:model="search" />
        <button wire:click="buscar" class="boton-Azul"><i class="fa-solid fa-magnifying-glass" style="margin-right: 7px;"></i>Buscar</button>
        <button wire:click="agregarProyecto" target="_blank" class="boton-Azul">Agregar proyecto</button>
    </div>
    <p>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre del encargado</th>
                    <th>Nombre del proyecto</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->scrum_master}}</td>
                    <td>
                        @if ($proyectoSeleccionado && $proyectoSeleccionado->id === $proyecto->id)
                        <input type="text" wire:model="nombre">
                        @else
                        {{ $proyecto->nombre }}
                        @endif
                    </td>
                    <td>
                        @if ($proyectoSeleccionado && $proyectoSeleccionado->id === $proyecto->id)
                        <textarea wire:model="descripcion"></textarea>
                        @else
                        {{ $proyecto->descripcion }}
                        @endif
                    </td>
                    <td>{{ $proyecto->created_at }}</td>
                    <td>
                        <div class="acciones">
                            @if (!$proyectoSeleccionado || $proyectoSeleccionado->id !== $proyecto->id)
                            <button wire:click="seleccionarProyecto({{ $proyecto->id }})" class="boton-Modificar02">
                                <i class="fa-regular fa-pen-to-square"></i>

                            </button>
                            @else
                            <button wire:click="actualizarProyecto" class="boton-Palomita">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            @endif
                            <button wire:click="eliminarProyecto({{ $proyecto->id }})" class="boton-Basura">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
