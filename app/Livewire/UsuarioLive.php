<?php

namespace App\Livewire;

use App\Models\Usuario;
use Livewire\Component;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Database\QueryException;
class UsuarioLive extends Component
{
    public $mostrarFormulario = false;
    protected $listeners = ['buscarUsuario'];
    public $control, $nombre, $password, $email, $esfuerzo_semanal, $apodo, $estatus, $remember_token;

    public function render()
    {
        $usuarios = Usuario::all();
        return view('livewire.usuario-live', ['usuarios'=>$usuarios]);
    }

    public function submit()
    {
        try {
            // Intenta guardar el nuevo usuario
            $usuario = new Usuario();
            $usuario->control = $this->control;
            $usuario->nombre = $this->nombre;
            $usuario->password = $this->password;
            $usuario->email = $this->email;
            $usuario->esfuerzo_semanal = $this->esfuerzo_semanal;
            $usuario->apodo = $this->apodo;
            $usuario->estatus = $this->estatus;
            $usuario->remember_token = $this->remember_token;
            $usuario->save();


        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1048) {
                session()->flash('error', 'El campo control no puede estar vacío.');
            } else {
                throw $e;
            }
        }
    }

    // Método para buscar un usuario por su ID
    public function buscarUsuario($id)
    {
        //dd("Entro");
        $usuario = Usuario::findOrFail($id);

            $this->control = $usuario->control;
            $this->nombre = $usuario->nombre;
            $this->password = $usuario->password;
            $this->email = $usuario->email;
            $this->esfuerzo_semanal = $usuario->esfuerzo_semanal;
            $this->apodo = $usuario->apodo;
            $this->estatus = $usuario->estatus;
            $this->remember_token = $usuario->remember_token;
            $this->mostrarFormulario = true;



    }



    //metodo para actualizar

    public function update($id)
    {
        $usuario = Usuario::findOrFail($id);

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
