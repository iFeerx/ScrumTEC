<?php

namespace App\Livewire;
use App\Models\Adjunto;
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
    public $selectAdjuntos = null;
    public $refresh = 0;

    public function mount()
    {
        $this->tareas = Tarea::all();
    }

    public function showTask($id)
    {
        $this->id=$id;
        //dd('showTask method was called with id: ' . $id);
        $this->selectedTask = Tarea::find($id);
        $this-> selectAdjuntos = Adjunto::where('tarea_id', $this->id)->get();

    }

    public function closeModal()
    {
        $this->selectedTask = null;
        $this->selectAdjuntos = null;

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

    public function revisarTarea($taskId){
        Tarea::find($taskId)->update(['estatus' => 'revisado']);
        // Refresca las tareas después de cambiar el estado
        $this->mount();
        // Mensaje de éxito
        session()->flash('success', 'Tarea revisada exitosamente');
        $this->closeModal();
    }

    public function render()
    {
        $this->refresh++;
        return view('livewire.sprintboard');
    }

    public function incrementar()
    {
        $this->refresh++;
    }
}
