@extends('layouts.plantilla')
@section('titulo','sprintboard')
@section('main')
@vite(['resources/sass/global/sprintboard.scss', 'resources/js/app.js'])
    <main>
        <livewire:sprintboard/>
    </main>
@endsection
