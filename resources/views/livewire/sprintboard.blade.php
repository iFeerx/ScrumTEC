<div class="tabla-scrum">
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
                            <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                                <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                                <p>{{ $tarea->encoder_date }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'codificando')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                                <p>{{ $tarea->encoder_date }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'revisando')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                                <p>{{ $tarea->reviewer_date }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'probando')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                                <p>{{ $tarea->tester_date }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'terminado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                                <p>{{ $tarea->encoding_finish_date }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'corrigiendo')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'codificado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'revisado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'probado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'atascado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
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
