<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Historia;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Historialivewire extends Component
{
    protected $historias;
    protected $proyectos;
    public $id_editando = 0;
    public $nombre;
    public $proyecto_id;
    public $historia;

    public function rules(): array
    {
        return [
            'nombre' => 'required',
            'proyecto_id' => 'required|exists:proyectos,id',
            'historia' => 'required'
        ];
    }

    public function mount()
    {

    }

    public function render(){
        $historias = Historia::all();
        $proyectos = Proyecto::all();
        return view('livewire.historia-catalogo',
        compact('historias'))
        ->layout('components.plantilla')
        ->slot('main');
    }

    public function editar($id){
        $this->id_editando = $id;
        $historia = Historia::find($id);
        $this->nombre = $historia->nombre;
        $this->historia = $historia->historia;
        $this->proyecto_id = $historia->proyecto_id;
    }

    public function eliminar($id){
        $historia = Historia::find($id);
        $historia->delete();
    }

    public function guardar(){
        $this->validate();
        $historia = Historia::find($this->id_editando);
        $historia->nombre = $this->nombre;
        $historia->historia = $this->historia;
        $historia->proyecto_id = $this->proyecto_id;
        $historia->save();
        $this->id_editando = 0;
    }

    public function cancelar(){
        $this->id_editando = 0;
    }
}
