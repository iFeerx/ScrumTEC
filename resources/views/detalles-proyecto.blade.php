@extends('layouts.plantilla')
@section('titulo', 'Detalles del proyecto')
@section('main')
    <main>
        <h1>Nombre: {{ $proyecto->nombre }}</h1>
        <p>Scrum Master: {{ $proyecto->scrum_masters()->first()->nombre }}</p>
        <p>Descripción: {{ $proyecto->descripcion }}</p>
        <p>Fecha de entrega: {{ $proyecto->fecha_entrega }}</p>
        <p>Esfuerzo total: {{ $proyecto->esfuerzoTota }}</p>
        <h2>Historias</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Historia</th>
                    <th>Avance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyecto->historias as $historia)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $historia->historia }}</td>
                        <td>%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Historia</th>
                    <th>Avance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyecto->roles as $rol)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rol->usuario->nombre }}</td>
                        <td>{{ $rol->rol}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <input type="submit" value="Agregar">


        </main=>

@endsection
