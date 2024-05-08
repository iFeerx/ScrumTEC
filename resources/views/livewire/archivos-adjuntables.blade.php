<div>
    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="subirEntregables" enctype="multipart/form-data">
        <div>
             <!-- Mostrar archivos adjuntos -->
             @if ($archivosAdjuntos->isNotEmpty())
             <div>
                 <h2>Archivos adjuntos:</h2>
                 <table>
                     <thead>
                         <tr>
                             <th>Nombre</th>
                             <th>URL</th>
                             <th>Descargar</th>
                             <th>Acciones</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($archivosAdjuntos as $archivo)
                             <tr>
                                 <td>{{ $archivo->nombre }}</td>
                                 <td>{{ $archivo->url }}</td>
                                 <td><a href="{{ Storage::url($archivo->url) }}" download>Descargar</a></td>
                                 <td>
                                     <!-- Boton para eliminar archivo -->
                                     <button wire:click="eliminarArchivo({{ $archivo->id }})">Eliminar</button>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         @endif
<br>
<div hidden>
<label for="archivos">Tarea:</label><br>
<input type="text" required wire:model="tarea_id"><br>
</div>
            <label for="archivos">Archivos:</label>
            <input type="file" wire:model="archivos" multiple required>
            @error('archivos.*') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="nombres">Adjuntos:</label>
            <br>
            @foreach ($archivos as $index => $archivo)
                <input type="text" wire:model="nombres.{{ $index }}" placeholder="Nombre para {{ $archivo->getClientOriginalName() }}"><br>
            @endforeach
            @error('nombres.*') <span>{{ $message }}</span> @enderror
        </div>
        <br>
        <button type="submit">Subir archivos</button>
        <br><br>
        <button wire:click="tareaCompleta">Marcar Tarea como Completa</button>
    </form>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('afterDomUpdate', () => {
            const inputArchivos = document.querySelector('input[type="file"]');
            inputArchivos.addEventListener('change', function () {
                const nombresArchivos = Array.from(this.files).map(file => file.name).join(', ');
                this.nextElementSibling.textContent = nombresArchivos;
            });
        });
        Livewire.hook('element.updated', (el, component) => {
            if (el.id === 'archivos') {
                const archivosSeleccionados = el.files;
                const inputsNombres = document.querySelectorAll('input[type="text"][id^="nombre"]');

                for (let i = 0; i < archivosSeleccionados.length; i++) {
                    const nombreArchivo = archivosSeleccionados[i].name;
                    inputsNombres[i].value = nombreArchivo;
                }
            }
        });
    });
</script>
