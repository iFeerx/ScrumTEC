<!-- resources/views/agregar-proyecto.blade.php -->
@php
    $usuarios = \App\Models\Usuario::all();
@endphp
<form wire:submit.prevent="crearProyecto">
    <!-- Campos del formulario -->
    <input type="text" wire:model="nombre" placeholder="Nombre">
    <input type="text" wire:model="descripcion" placeholder="Descripción">

    <!-- Dropdown de usuarios -->
    <select wire:model="usuario">
        <option value="">Seleccionar Usuario</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->nombre }}">{{ $usuario->nombre }}</option>
        @endforeach
    </select>

    <!-- Botón para agregar proyecto -->
    <button type="submit">Agregar Proyecto</button>
</form>
