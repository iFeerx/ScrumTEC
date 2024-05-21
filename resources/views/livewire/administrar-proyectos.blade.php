<!-- resources/views/livewire/administrar-proyectos.blade.php -->
<div>
    <h1>Proyectos</h1>
    <div>
        <label for="search">Buscar nombre de proyecto:</label>
        <input type="text" id="search" wire:model="search" />
        <button wire:click="buscar" class="boton-Azul"><i class="fa-solid fa-magnifying-glass" style="margin-right: 7px;"></i>Buscar</button>
        <button wire:click="abrirModal" class="boton-Azul">Agregar proyecto</button>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 2%;">Id</th>
                <th style="width: 10%;">Nombre Encargado</th>
                <th style="width: 10%;">Nombre Proyecto</th>
                <th style="width: 30%;" >Descripción</th>ss
                <th style="width: 8%;">Fecha de Entrega</th>
                <th style="width: 5%;">Esfuerzo requerido</th>
                <th style="width: 5%;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->scrumMasters?$proyecto->scrumMasters->first()->nombre:" "}}</td>
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
                            <div class="textoTruncado">{{ $proyecto->descripcion }}</div>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('d/m/Y') }}</td>
                    <td>{{ $this->obtenerEsfuerzoEstimadoAcumulado($proyecto->id) }} hrs</td>
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
    <div id="miModal" class="modal" style="display: {{ $mostrarModal ? 'block' : 'none' }}">
        <div class="modal-content">
            <span class="close-button" wire:click="cerrarModal">×</span>
            <form>
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" wire:model="nombre"><br>
                <label for="descripcion">Descripcion:</label><br>
                <input type="text" id="descripcion" wire:model="descripcion"><br>
                <label for="usuario">Usuario:</label><br>
                <select wire:model="usuario_id">
                    <option value="">Seleccionar Usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select><br>
                <label for="fechaEntrega">Fecha Entrega:</label><br>
                <input type="date" id="fecha_entrega" wire:model="fecha_entrega"><br>
                <label for="Agregar Proyecto">Agregar Proyecto:</label><br>
                <button wire:click.prevent="agregarProyecto">Agregar Proyecto</button>
            </form>
        </div>
    </div>
</div>
