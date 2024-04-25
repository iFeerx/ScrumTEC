<?php

namespace App\Livewire;
use App\Models\Tarea;
USE illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Sprintboard extends Component
{
    public $selectedTask = null;
    public $tareas;
    public $id=0;
    public $nombre;
    public $descripcion;
    public $estatus;

    public function mount()
    {
        $this->tareas = Tarea::all();
    }

    public function showTask($id)
    {
        $this->id=$id;
        //dd('showTask method was called with id: ' . $id);
        $this->selectedTask = Tarea::find($id);
    }

    public function closeModal()
    {
        $this->selectedTask = null;
    }

    public function changeEstatus()
    {
        $this->tareas = $this->tareas[$this->id]
        ->tareas->sortBy('nombre')->keyBy('id');
        $this->id = 0;
        $this->nombre = " ";
        $this->descripcion = " ";
        $this->estatus = " ";
    }

    public function empezarTarea($tareaId)
    {

    }
    public function changeStatus($taskId)
    {
        Tarea::find($taskId)->update(['estatus' => 'codificando']);
        // Refresca las tareas después de cambiar el estado
        $this->mount();
    }

    public function cambiarEstado($tareaId, $nuevoEstatus)
    {
        $tarea = Tarea::find($tareaId);
        if ($tarea) {
            $tarea->estatus = $nuevoEstatus;
            $tarea->save();
        }
    }

    public function render()
    {
        return view('livewire.sprintboard');
    }

}
