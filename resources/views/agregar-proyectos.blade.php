@extends('layouts.plantilla')
@section('titulo','agregar-proyecto')
@section('main')
<!-- resources/views/agregar-proyecto.blade.php -->
@php
    $usuarios = \App\Models\Usuario::all();
@endphp
<main>
<div id="center">
<form wire:submit.prevent="crearProyecto">
    <!-- Campos del formulario -->
    <input type="text" wire:model="nombre" placeholder="Nombre">
    <input type="text" wire:model="descripcion" placeholder="Descripción">

    <!-- Dropdown de usuarios -->

    <select wire:model="usuario"  style="margin-top: 15px; width:100%;"">
        <option value="">Seleccionar Usuario</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->nombre }}">{{ $usuario->nombre }}</option>
        @endforeach
    </select>

    <!-- Botón para agregar proyecto -->
    <button type="submit" class="boton-Azul" style="margin-top: 15px; width:100%;">Agregar Proyecto</button>
</form>
</div>
</main>
