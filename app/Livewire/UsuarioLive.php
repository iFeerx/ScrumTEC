<?php

namespace App\Livewire;

use App\Models\Usuario;
use Livewire\Component;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Database\QueryException;
class UsuarioLive extends Component
{
    public $mostrarFormulario = false;
    public $mostrarFormulario2= false;
    public $showEditModal = false; // Controla si el modal de edición está visible
    public $selectedUsuario; // Almacena el usuario seleccionado para editar o eliminar
    public $control, $nombre, $password, $email, $esfuerzo_semanal, $apodo, $estatus, $remember_token;
    public function render()
    {
        $usuarios = Usuario::all();
        return view('livewire.usuario-live', ['usuarios'=>$usuarios]);

    }

    //METODO PARA AGREGAR A UN USUARIO
    public function submit()
    {
        $usuario = new Usuario();
        $usuario->control = $this->control;
        $usuario->nombre = $this->nombre;
        $usuario->password = bcrypt($this->password);
        $usuario->email = $this->email;
        $usuario->esfuerzo_semanal = $this->esfuerzo_semanal;
        $usuario->apodo = $this->apodo;
        $usuario->estatus = $this->estatus;
        $usuario->save();

        $this->cerrarModal2();

    }

    //METODO PARA ELIMINAR AL USUARIO
    public function eliminar($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);


            $usuario->delete();

            return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario'], 500);
        }
    }

    //METODO PARA BUSCAR USUARIO POR ID
    public function buscarUsuario($id)
    {
        //dd("Entro");
        $usuario = Usuario::findOrFail($id);
        //Se guarda en esta variable el usuario seleccionado.
        $this->selectedUsuario = $usuario;
            //Muestra los datos
            $this->control = $usuario->control;
            $this->nombre = $usuario->nombre;
            $this->password = $usuario->password;
            $this->email = $usuario->email;
            $this->esfuerzo_semanal = $usuario->esfuerzo_semanal;
            $this->apodo = $usuario->apodo;
            $this->estatus = $usuario->estatus;
            $this->mostrarFormulario = true;



    }

    //METODO PARA ABRIR EL MODAL REGISTRO
    public function abrirModal2()
    {
        $this->mostrarFormulario2 = true;

    }
    //METODO PARA ABRIR EL MODAL REGISTRO
    public function cerrarModal2()
    {
        $this->mostrarFormulario2 = false;

    }

    //METODO PARA CERRAR EL MODAL EDITAR
    public function cerrarModalEditar()
    {
        // Cierra el modal
        $this->mostrarFormulario = false;
    }

    //METODO PARA ACTUALIZAR
    public function update($control)
    {
        $usuario = Usuario::findOrFail($control);

        $usuario->control = $this->control;
        $usuario->nombre = $this->nombre;
        $usuario->password = $this->password;
        $usuario->email= $this->email;
        $usuario->esfuerzo_semanal= $this->esfuerzo_semanal;
        $usuario->apodo= $this->apodo;
        $usuario->estatus= $this->estatus;
        $usuario->remember_token= $this->remember_token;

        $usuario->save();



    }


}
