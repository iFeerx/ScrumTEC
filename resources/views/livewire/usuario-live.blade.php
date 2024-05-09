<div class="tabla-scrum">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Control</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Esfuerzo semanal</th>
                <th>Apodo</th>
                <th>Estatus</th>
            </tr>
        </thead>

        <tbody>

            {{-- Recorre a los Usuarios y los despliega en la tabla--}}
            @foreach ($usuarios as $usuario)
        {{-- Al hacer doble click busca al usuario por su ID, y lo muestra en el modal editar--}}
            <tr wire:dblclick="buscarUsuario({{$usuario->id}})">
                <td>{{$usuario->id}}</td>
                    <td>{{$usuario->control}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->esfuerzo_semanal}}</td>
                    <td>{{$usuario->apodo}}</td>
                    <td>{{$usuario->estatus}}</td>
                </tr>

            @endforeach
        </tbody>

    </table>


 {{-- AQUI SE VE EL METODO PARA EDITAR A UN USUARIO--}}
 @if ($mostrarFormulario)
 <form id="editarModal" class="modal-error"> {{-- Poner Estilo--}}
         <label for="control">Control</label>
         <input type="text"  wire:model="control">
         <br>
         <label for="nombre">Nombre</label>
         <input type="text" wire:model="nombre">
         <br>
         <label for="password">Password</label>
         <input type="password" wire:model="password">
         <br>
         <label for="email">Email</label>
         <input type="text" wire:model="email">
         <br>
         <label for="esfuerzo_semanal">Esfuerzo semanal</label>
         <input type="text" wire:model="esfuerzo_semanal">
         <br>
         <label for="apodo">Apodo</label>
         <input type="text" wire:model="apodo">
         <br>
         <label for="estatus">Estatus</label>
         <input type="text" wire:model="estatus">
         <br>
         <button id="update" wire:click='update("{{ $selectedUsuario->id }}")' wire:click='cerrarModalEditar()' class="boton-Modificar02"><i class="fa-regular fa-pen-to-square"></i></button>
         <button id="eliminar" wire:click='eliminar("{{ $selectedUsuario->id }}")' wire:click='cerrarModalEditar()' class="boton-Basura"><i class="fa-solid fa-trash"></i></button>
         <button wire:click='cerrarModalEditar()' class="boton-Rojo">Cancelar</button>
 </form>
 @endif





    {{-- Botón para abrir el modal de registro --}}
    <button wire:click="abrirModal2()" class="boton-Azul">Registrar</button>
    @if ($mostrarFormulario2)
    {{-- Div donde guardo los datos del modal Registro --}}
    <div class="modal" id="mainModal"> {{-- Poner Estilo--}}
    <form wire:submit.prevent="submit">
        <label for="control">Control</label>
        <input type="text" wire:model="control">
        <br>
        <label for="nombre">Nombre</label>
        <input type="text" wire:model="nombre">
        <br>
        <label for="password">Password</label>
        <input type="password" wire:model="password">
        <br>
        <label for="email">Email</label>
        <input type="text" wire:model="email">
        <br>
        <label for="esfuerzo_semanal">Esfuerzo semanal</label>
        <input type="text" wire:model="esfuerzo_semanal">
        <br>
        <label for="apodo">Apodo</label>
        <input type="text" wire:model="apodo">
        <br>
        <label for="estatus">Estatus</label>
        <input type="text" value="activo" wire:model="estatus">
        <br>
        <label for="remember_token">Remember_token</label>
        <input type="text" wire:model="remember_token">

        <button type="submit" class="boton-Verde">Guardar</button>
        <button wire:click="cerrarModal2()" class="boton-Rojo">Cancelar</button>

    </form>

</div>
@endif
</div>
@livewireScripts


