@extends('layouts.plantilla')
@section('titulo', 'Detalles del proyecto')
@section('main')
    <livewire:ProyectoDetalle id='{{$id}}'>
@endsection
