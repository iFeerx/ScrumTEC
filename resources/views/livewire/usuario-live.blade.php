<div>
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
                    <tr id="btnModal" onclick="openModalEditar({{ $usuario->id }})">

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

        <dialog class="modalEditar" id="editarModal">
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
        </dialog>


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

<script>
const modal = document.getElementById("mainModal");
const modalEditar = document.getElementById("editarModal");


    function seleccionarFila(id) {
        console.log("ID seleccionado:", id);
    }

    const openModal = () =>{
        modal.showModal()

    }

    const closeModal = () =>{
        modal.close();
    }
//MODALES PARA EDITAR
const openModalEditar = (id) => {
    console.log("ID recibido:", id); // Verificar el valor de ID
    modalEditar.showModal();
    Livewire.component('UsuarioLive').call('buscarUsuario', id);
}


    const closeModalEditar = () =>{
        modalEditar.close();
    }



    </script>
        @livewireScripts

