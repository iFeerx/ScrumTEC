<?php

namespace App\Livewire;
use App\Models\Tarea;
USE illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Sprintboard extends Component
{
    public $tareas;
    public $tarea_id;
    public $nombre_tarea;
    public $descripcion;
    public $estatus;

    public function mount()
    {
        $this->tareas = Tarea::all();
    }

    public function changeEstatus()
    {
        $this->tareas = $this->paises[$this->tarea_id]
            ->tareas->sortBy('nombre')->keyBy('id');
        $this->tarea_id = 0;
        $this->nombre_tarea = " ";
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
        return view('livewire.sprintboard', ['tareas' => $this->tareas]);
    }

}
