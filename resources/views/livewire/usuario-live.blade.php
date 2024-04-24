<div>
    {{$mostrarFormulario}}
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Control</th>
                <th>Nombre</th>
                <th>Password</th>
                <th>Email</th>
                <th>Esfuerzo semanal</th>
                <th>Apodo</th>
                <th>Estatus</th>
                <th>Remember_token</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                    {{-- AL HACER CLICK A UNA FILA NOS DA EL ID --}}
                    <tr id="btnModal" wire:dblclick="buscarUsuario({{ $usuario->id }})">
                <td>{{$usuario->id}}</td>
                    <td>{{$usuario->control}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->password}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->esfuerzo_semanal}}</td>
                    <td>{{$usuario->apodo}}</td>
                    <td>{{$usuario->estatus}}</td>
                    <td>{{$usuario->remember_token}}</td>
                </tr>

            @endforeach

        </tbody>
    </table>


        {{-- AQUI SE VE EL METODO PARA EDITAR A UN USUARIO--}}
        @if ($mostrarFormulario)
        <div id="editarModal" class="modal-error">
            <form wire:submit.prevent="update({{ $usuario->id }})">
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
                <label for="remember_token">Remember_token</label>
                <input type="text" wire:model="remember_token">

                <button id="update" onclick="closeModalEditar()" wire:click='update("{{$usuario->id}}")'>Editar</button>
                <button onclick="closeModalEditar()">Salir</button>
            </form>
        </div>
        @endif

        {{-- AQUI SE VE EL METODO PARA REGISTRAR A UN USUARIO--}}

    <button onclick="openModal()">Registrar</button>
    <dialog class="modal" id="mainModal">
        <form wire:submit.prevent="submit">
            @csrf
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
            <input type="text"  value="activo">
            <br>
            <label for="remember_token">Remember_token</label>
            <input type="text" wire:model="remember_token">

            <button id="submit" onclick="abrirModal()" wire:click="submit">Guardar</button>
            <button onclick="closeModal()">Salir</button>
        </form>
    </dialog>

</div>
