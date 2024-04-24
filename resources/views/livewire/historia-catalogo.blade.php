<div class="tabla-history">
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
                        <textarea cols="50" rows="5" wire:model="historia">
                        </textarea>
                    </td>
                    <td><i wire:click='guardar()' class="fa-solid fa-check"></i>
                        <i wire:click='cancelar()' class="fa-solid fa-ban"></i></td>
                </tr>
                @else
                    <tr>
                        <td>{{$historia->nombre}}</td>
                        <td>{{$historia->proyecto->nombre}}</td>
                        <td>{{$historia->historia}}</td>
                        <td><i wire:click='editar({{$historia->id}})' class="fa-solid fa-pen-to-square"></i>
                            <i wire:click='eliminar({{$historia->id}})' class="fa-solid fa-trash"></i></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
