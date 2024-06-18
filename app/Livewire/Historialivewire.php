<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Historia;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Tarea;

class Historialivewire extends Component
{
    protected $historias;
    protected $proyectos;
    public $tareas; // Colección de tareas
    public $id_editando = 0;
    public $nombre;
    public $proyecto_id;
    public $historia;
    public $filtrarPorProyecto;
    public $selectedHistoriaId = null; // ID de la historia seleccionada

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
        $this->filtrarPorProyecto = Proyecto::all()->first()->id;
        $this->historias = Historia::all();
        $this->proyectos = Proyecto::all();
        $this->tareas = collect(); // Inicializar como colección vacía
    }

    public function render(){
        $proyectos = Proyecto::all();
        $historias = Proyecto::find($this->filtrarPorProyecto)->historias;
        return view('livewire.historia-catalogo',
        ['historias'=>$historias, 'proyectos'=>$proyectos]);
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

    public function cargarTareas($historiaId)
    {
        $this->selectedHistoriaId = $historiaId;
        $this->tareas = Tarea::where('historia_id', $historiaId)->get();
    }
}
