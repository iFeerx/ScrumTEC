<div class="tabla-scrum">
    {{$refresh}}
    <button wire:click="incrementar">+</button>
    <table >
        <thead>
            <tr>
                <th>Espera</th>
                <th>Codificando</th>
                <th>revisando</th>
                <th>provando</th>
                <th>terminado</th>
                <th>corrigiendo</th>
                <th>codificado</th>
                <th>revisado</th>
                <th>provado</th>
                <th>atascado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'espera')
                            <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                                <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'codificando')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'revisando')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'probando')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'terminado')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'corrigiendo')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'codificado')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'revisado')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'probado')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'atascado')
                        <div data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->descripcion }}</p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>`
            </tr>
        </tbody>
    </table>
    @if ($selectedTask)
        <div class="modal">
            <div class="modal-content">
                <span class="close-button" wire:click="closeModal">×</span>
                <h2>{{ $selectedTask->nombre }}</h2>
                <p>{{ $selectedTask->descripcion }}</p>
                <h3>{{ $selectedTask->estatus }}</h3>
                @if ($selectedTask->estatus == "codificando")
                <livewire:ArchivosAdjuntables id="{{$selectedTask->id}}" />
                @endif
                @if ($selectedTask->estatus == "revisando")
                <div>
                    <h2>Archivos adjuntos:</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>URL</th>
                                <th>Descargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectAdjuntos as $archivo)
                                <tr>
                                    <td>{{ $archivo->nombre }}</td>
                                    <td>{{ $archivo->url }}</td>
                                    <td><a href="{{ Storage::url($archivo->url) }}" download>Descargar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button wire:click="revisarTarea({{$tarea->id}})">Revisado</button>
                @endif
            </div>
        </div>
    @endif
</div>
