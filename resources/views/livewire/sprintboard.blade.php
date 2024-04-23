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
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'espera')
              <div data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
                  <button wire:click="cambiarEstado({{ $tarea->id }}, 'codificando')">Empezar tarea</button>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'codificando')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'revisando')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre}}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'probando')
              <div data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'terminando')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'corrigiendo')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>

              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'revisado')
              <div data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'codificado')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'revisando')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'revisado')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'provado')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      <td>@foreach($tareas as $tarea)
          @if ($tarea->estatus == 'atascado')
              <div  data-id="{{ $tarea->id }}">
                  <p><b>{{ $tarea->nombre }}</b></p>
                  <p>{{ $tarea->descripcion }}</p>
                  <p>{{ $tarea->estatus }}</p>
              </div>
          @endif
      @endforeach
      </td>
      </tr>
  </tbody>
  </table>
</div>
