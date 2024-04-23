<!-- resources/views/livewire/administrar-proyectos.blade.php -->
<div>
    <h1>Proyectos {{$refresh}}</h1>

    <div>
        <label for="search">Buscar nombre de proyecto:</label>
        <input type="text" id="search" wire:model="search"/>
        <button wire:click="buscar">Buscar</button>
        <button wire:click="agregarProyecto" target="_blank">Agregar proyecto</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id Proyecto</th>
                <th>Nombre Encargado</th>
                <th>Nombre Proyecto</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
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
                        @if (!$proyectoSeleccionado || $proyectoSeleccionado->id !== $proyecto->id)
                            <button wire:click="seleccionarProyecto({{ $proyecto->id }})">Modificar</button>
                        @else
                            <button wire:click="actualizarProyecto">Guardar Cambios</button>
                        @endif
                        <button wire:click="eliminarProyecto({{ $proyecto->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
