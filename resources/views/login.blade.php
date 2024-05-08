@extends('layouts.plantilla')
@section('titulo', 'Iniciar sesión')
@section('nav')
@section('main')
<nav>
<main>
    <div id="center">
        <form name="login" method="post" action="login">
            @csrf
            @if (session('error'))
            <div id="error" class="error">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('error').classList.add('oculto');
                }, 3000);
            </script>
            @endif
            <label for="correo">Correo:</label>
            <input type="email" name="email"><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password"><br>
            <input type="submit" value="Entrar" class="boton-Azul">
        </form>
    </div>
</main>
