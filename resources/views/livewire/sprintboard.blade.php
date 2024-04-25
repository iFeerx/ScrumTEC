<div>
    <table>
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
            </div>
        </div>
    @endif
</div>
