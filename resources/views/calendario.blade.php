<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        .contenedor-calendario {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .usuario {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .usuario strong {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div style="color: black; font-Asize: 40px;">
        <b style="height:200px;">Calendario</b>
    </div>

{{-- PARA EL ENCODER --}}
@foreach ($usuarios_encoder as $usuario)
    <div class="usuario">
        <strong>{{ $usuario->nombre }}</strong>
        <table border="1">
            <tr>
                <td class="contenedor-calendario" style="width:500px">
                     {{--SE TIENE QUE ENCONTRAR
                            AL USUARIO QUE TENGA TAREA Y SU ESTATOS SEA TERMINADO.--}}
                    @foreach ($usuario->tareasEncoder  as $tarea)
                        @if ($tarea->estatus === 'terminado' && ($tarea->encoder_date))
                            @php
                                $fechaInicio = Carbon\Carbon::parse($tarea->encoder_date);
                                $fechaFin = Carbon\Carbon::parse($tarea->encoding_finish_date);
                                //SE CALCULA LA FECHA DE INICIA CON LA FECHA DE FIN
                                //PARA CALCULAR EL TAMAÑO DEL WIDTH(Y PINTAR LA TAREA HECHA)
                                //SI ES DE 20PX SIGNIFICA QUE DURO 1 DÍA, EL DOBLE 2, ASÍ SUCECIVAMENTE

                                //sacamos la duracion para el tamaño de los px
                                $duracion = $fechaInicio->diffInDays($fechaFin) + 1;

                            @endphp
                        @endif

                        <div style="width:{{ $duracion * 20 }}px;background-color: blue; color: white; margin-bottom: 5px;">Tarea {{ $tarea->historia_id }}</div>

                    @endforeach
                </td>
            </tr>
        </table>
    </div>
@endforeach



{{-- PARA EL REVISOR --}}
@foreach ($usuarios_reviewer as $usuario)
    <div class="usuario">
        <strong>{{ $usuario->nombre }}</strong>
        <table border="1">
            <tr>
                 {{--SE TIENE QUE ENCONTRAR
                            AL USUARIO QUE TENGA TAREA Y SU ESTATOS SEA TERMINADO.--}}
                <td class="contenedor-calendario" style="width:500px">
                    @foreach ($usuario->tareasReviewer  as $tarea)
                        @if ($tarea->estatus === 'terminado' && ( $tarea->reviewer_date))
                            @php
                                $fechaInicio = Carbon\Carbon::parse($tarea->reviewer_date);
                                $fechaFin = Carbon\Carbon::parse($tarea->reviewer_finish_date);
                                //SE CALCULA LA FECHA DE INICIA CON LA FECHA DE FIN
                                //PARA CALCULAR EL TAMAÑO DEL WIDTH(Y PINTAR LA TAREA HECHA)
                                //SI ES DE 20PX SIGNIFICA QUE DURO 1 DÍA, EL DOBLE 2, ASÍ SUCECIVAMENTE

                                 //sacamos la duracion para el tamaño de los px

                                $duracion = $fechaInicio->diffInDays($fechaFin) + 1;
                            @endphp
                            <div style="width:{{ $duracion * 20 }}px;background-color: blue; color: white; margin-bottom: 5px;">Tarea {{ $tarea->historia_id }}</div>
                            @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
@endforeach

{{-- PARA EL TESTER --}}
@foreach ($usuarios_tester as $usuario)
    <div class="usuario">
        <strong>{{ $usuario->nombre }}</strong>
        <table border="1">
            <tr>
                <td class="contenedor-calendario" style="width:500px">
                    @foreach ($usuario->tareasTester     as $tarea)
                        {{--SE TIENE QUE ENCONTRAR
                            AL USUARIO QUE TENGA TAREA Y SU ESTATOS SEA TERMINADO.--}}
                        @if ($tarea->estatus === 'terminado' && ($tarea->tester_date))
                            @php
                                $fechaInicio = Carbon\Carbon::parse($tarea->tester_date);
                                $fechaFin = Carbon\Carbon::parse($tarea->tester_finish_date);
                                //SE CALCULA LA FECHA DE INICIA CON LA FECHA DE FIN
                                //PARA CALCULAR EL TAMAÑO DEL WIDTH(Y PINTAR LA TAREA HECHA)
                                //SI ES DE 20PX SIGNIFICA QUE DURO 1 DÍA, EL DOBLE 2, ASÍ SUCECIVAMENTE


                                //sacamos la duracion para el tamaño de los px
                                $duracion = $fechaInicio->diffInDays($fechaFin) + 1;
                            @endphp
                            <div style="width:{{ $duracion * 20 }}px;background-color: blue; color: white; margin-bottom: 5px;">Tarea {{ $tarea->historia_id }}</div>
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
@endforeach
</body>
</html>
