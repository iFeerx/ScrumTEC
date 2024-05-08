<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\Historia;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProyectoDetalle extends Component
{
    protected $proyecto;
    public $proyecto_id;
    public $usuarios;
    public $roles = ['Product owner','Scrum master','Team leader','Developer','Tester','Reviewer'];
    public $usuario;
    public $rol;
    public $mostrarAgregarRol = false;

    public function rules(): array
    {
        return [
        ];
    }

    public function mount($id)
    {
        $this->proyecto_id = $id;
        $this->usuarios = Usuario::all();
    }

    public function render(){
        $this->proyecto = Proyecto::find($this->proyecto_id);
        return view('livewire.proyecto-detalle',
        ['proyecto'=>$this->proyecto]);
    }

    public function agregarHistoria()
    {}

    public function mostrarAgregarRoles()
    {
        $this->mostrarAgregarRol = true;
    }

    public function agregarRol()
    {

    }

}
