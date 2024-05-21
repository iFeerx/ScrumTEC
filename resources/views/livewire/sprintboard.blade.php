<div class="tabla-scrum">
    <table >
        <thead>
            <tr>
                <th>Espera</th>
                <th>Codificando</th>
                <th>Corrigiendo</th>
                <th>Atascado</th>
                <th>Revisando</th>
                <th>Provando</th>
                <th>Terminado</th>
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
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'codificando' || $tarea->estatus == 'codificado')
                            <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                                <p><b>{{$tarea->nombre }}</b></p>
                                <p><span class="tag {{$tarea->estatus == 'codificado'?'verde':''}}">{{$tarea->estatus}}</span></p>
                                <p>{{\Carbon\Carbon::parse($tarea->encoder_date)->format('d/m/Y') }}</p>
                                <p>{{$this->obtenerApodo($tarea->encoder_id) }}</p>
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
                        @if ($tarea->estatus == 'atascado')
                            <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                                <p><b>{{ $tarea->nombre }}</b></p>
                                <p>{{ $tarea->estatus }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>`
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'revisando' || $tarea->estatus == 'revisado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <livewire:tags :key="$tarea->id" estatus="{{ $tarea->estatus }}" color="{{ $tarea->estatus == 'revisado' ? 'verde' : '' }}" />
                                <p>{{ \Carbon\Carbon::parse($tarea->reviewer_date)->format('d/m/Y') }}</p>
                                <p>{{ $this->obtenerApodo($tarea->reviewer_id) }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tareas as $tarea)
                        @if ($tarea->estatus == 'probando' || $tarea->estatus == 'probado')
                        <div class="div-tarjeta01" data-id="{{ $tarea->id }}" wire:click="showTask({{ $tarea->id }})">
                            <p><b>{{ $tarea->nombre }}</b></p>
                                <livewire:tags :key="$tarea->id" estatus="{{ $tarea->estatus }}" color="{{ $tarea->estatus == 'probado' ? 'verde' : '' }}" />
                                <p>{{ \Carbon\Carbon::parse($tarea->tester_date)->format('d/m/Y') }}</p>
                                <p>{{ $this->obtenerApodo($tarea->tester_id) }}</p>
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
                                <p>{{ \Carbon\Carbon::parse($tarea->encoding_finish_date)->format('d/m/Y') }}</p>
                            </div>
                        @endif
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    @if ($selectedTask!=null)
        <div class="modal">
            <div class="modal-content">
                <span class="close-button" wire:click="closeModal">×</span>
                <div style="display: flex;margin-top:20px;margin-bottom:-30px;">
                    <p style="margin-left:auto">
                        <p style="border: 1px solid rgba(0, 0, 0, 0.150);border-top: none;border-left: none; border-radius: 2px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);"> {{ $selectedTask->estatus }} </p>
                        <p style="margin-left: 10px;border: 1px solid rgba(0, 0, 0, 0.150);border-top: none;border-left: none; border-radius: 2px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);">Estimado: {{$selectedTask->esfuerzo_estimado}}hrs</p>
                        @if ($selectedTask->estatus == "codificado")
                            <p style="margin-left: 10px;border: 1px solid rgba(0, 0, 0, 0.150);border-top: none;border-left: none; border-radius: 2px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);">Real: {{$selectedTask->esfuerzo_real}}hrs</p>
                        @endif
                        <p style="margin-left: 10px;border: 1px solid rgba(0, 0, 0, 0.150);border-top: none;border-left: none; border-radius: 2px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);">Sprint: {{$selectedTask->sprint}} </p>
                    </p>
                </div>
                <h2>{{ $selectedTask->nombre }}</h2>
                <div style="display: flex;">
                    @if ($selectedTask->estatus == "codificando" ||$selectedTask->estatus == "codificado")
                        <h4>{{ $selectedTask->estatus }}: {{$selectedUser->nombre}}</h4>
                    @elseif ($selectedTask->estatus == "revisando"||$selectedTask->estatus == "revisado")
                        <h4>codificado: {{$selectedUser->nombre}}</h4>
                        <h4 style="margin-left: 10px">| {{ $selectedTask->estatus}}: {{$selectedReviewer->nombre}}</h4>
                    @elseif ($selectedTask->estatus == "probando"||$selectedTask->estatus == "probado")
                        <h4>codificado: {{$selectedUser->nombre}}</h4>
                        <h4 style="margin-left: 10px">| revisado: {{$selectedReviewer->nombre}}</h4>
                        <h4 style="margin-left: 10px">| {{ $selectedTask->estatus}}: {{$selectedTester->nombre}}</h4>
                    @elseif ($selectedTask->estatus == "terminado")
                        <h4>codificado: {{$selectedUser->nombre}}</h4>
                        <h4 style="margin-left: 10px">| revisado: {{$selectedReviewer->nombre}}</h4>
                        <h4 style="margin-left: 10px">| probado: {{$selectedTester->nombre}}</h4>
                    @endif
                </div>
                <p>Descripcion</p>
                <hr style="border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.1); margin-top: -20px; margin-bottom: -5px;">
                <p>{{ $selectedTask->descripcion }}</p>
                <p>Entregables</p>
                <hr style="border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.1); margin-top: -20px; margin-bottom: -5px;">
                <p>{{ $selectedTask->entregables}}</p>
                @if ($selectedTask->estatus == "codificando")
                    <livewire:ArchivosAdjuntables id="{{$selectedTask->id}}" />
                @else
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
                    @if ($selectedTask->estatus == "revisando")
                        <button wire:click="revisarTarea({{$tarea->id}})">Revisado</button>
                    @endif
                @endif
                <p>Comentarios</p>
                <hr style="border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.1); margin-top: -20px; margin-bottom: -5px;">
                <p>{{$selectedTask->comentarios}}</p>
            </div>
        </div>
    @endif
</div>
