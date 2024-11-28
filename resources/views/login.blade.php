@extends('layouts.plantilla')
@section('titulo', 'Iniciar sesión')
@section('nav')
@section('main')
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
                <img src="{{ $captcha['image_src'] }}" alt="Captcha Image">                <label for="captcha">Captcha:</label>
                {{-- Display the captcha code for testing (remove in production) --}}
                {{ $captcha['code'] }}
                <input type="text" name="captcha"><br>
                <input type="submit" value="Entrar" class="boton-Azul">
            </form>
        </div>
    </main>
@endsection
