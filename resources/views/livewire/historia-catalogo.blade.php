<div class="tabla-history">
    <br>
    <div class="form-group">
        <form id="filtrarForm">
            <label for="proyecto">Filtrar por proyecto:</label>
            <select name="proyecto"  wire:model.live="filtrarPorProyecto">
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Proyecto</th>
                <th>Historia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historias as $historia)
                @if ($id_editando == $historia->id)
                <tr>
                    <td>@error('nombre') <span class="error">{{ $message }}</span> @enderror
                        <input type="text" wire:model='nombre'></td>
                    <td>@error('proyecto_id') <span class="error">{{ $message }}</span> @enderror
                        <select wire:model='proyecto_id'>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{$proyecto->id}}"
                                    @if ($proyecto->id==$historia->proyecto_id)
                                    selected
                                    @endif
                                    >
                                    {{$proyecto->nombre}}</option>
                            @endforeach
                        </select></td>
                        <td>@error('historia') <span class="error">{{ $message }}</span> @enderror
                            <textarea cols="50" rows="5" wire:model="historia"></textarea>
                        </td>
                        <td>
                        <div class="acciones">
                        <button wire:click="guardar()" class="boton-Palomita">
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button wire:click="cancelar()" class="boton-Basura">
                            <i class="fa-solid fa-ban"></i></button>
                        </div>
                        </td>
                @else
                    <tr>
                        <td>{{ $historia->nombre }}</td>
                        <td>{{ $historia->proyecto->nombre }}</td>
                        <td>{{ $historia->historia }}</td>
                        <td>
                            <div class="acciones">
                            <button wire:click="editar({{ $historia->id }})" class="boton-Modificar02">
                            <i class="fa-solid fa-pen-to-square"></i></button>
                            <button wire:click="eliminar({{ $historia->id }})" class="boton-Basura">
                            <i class="fa-solid fa-trash"></i></button>
                            <button wire:click="cargarTareas({{ $historia->id }})" class="boton-Tareas">
                            <i class="fa-solid fa-tasks"></i></button>
                            </div>
                        </td>
                    </tr>
                    @if ($selectedHistoriaId == $historia->id)
                        <!-- Mostrar tareas relacionadas debajo de la historia seleccionada -->
                        <tr class="tabla-sprintboard">
                            <td colspan="4">
                                <div class="tareas-relacionadas">
                                    <h3>Tareas Relacionadas</h3>
                                    @if ($tareas->isNotEmpty())
                                        <ul style="display:flex; align-items:center;justify-self: start;">
                                            @foreach ($tareas as $tarea)
                                                <div class="div-tarjeta01" style="margin: 5px;"><li> <p> <b>{{ $tarea->nombre}} </b></p> <p> {{ $tarea->estatus}}  </p></li></div>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No hay tareas relacionadas.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</div>
