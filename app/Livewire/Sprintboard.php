<?php

namespace App\Livewire;
use App\Models\Adjunto;
use App\Models\Tarea;
use App\Models\Usuario;
USE illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Rol;

class Sprintboard extends Component
{
    public $selectedTask = null;
    public $tareas;
    public $id=0;
    public $nombre;
    public $descripcion;
    public $estatus;
    public $selectAdjuntos = null;
    public $apodo = null;
    public $selectedUser = null;
    public $selectedTester = null;
    public $selectedReviewer = null;
    public $comentarios;

    public function mount()
    {
        $this->tareas = Tarea::all();
    }


    public function showTask($id)
    {
        $this->id=$id;
        //dd('showTask method was called with id: ' . $id);
        $this->selectedTask = Tarea::find($id);
        $this->selectAdjuntos = Adjunto::where('tarea_id', $this->id)->get();
        $this->selectedUser = $this->selectedTask->encoder;
        $this->selectedTester = $this->selectedTask->tester;
        $this->selectedReviewer = $this->selectedTask->reviewer;
        $this->comentarios = $this->selectedTask->comentarios;
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

    public function empezarTarea($tareaId, $proyectoId)
    {
        $user = Session::get('usuario');

        //Obtener los roles del usuario dentro del proyecto
        $roles = Rol::where('proyecto_id', $proyectoId)->where('usuario_id', $user['id'])->get();

        // Verifica si el usuario es un desarrollador
        if ($roles->rol != 'Developer') {
            session()->flash('error', 'No tienes permiso para empezar una tarea');
            return;
        }

        // Verifica si el desarrollador ya tiene una tarea activa en el proyecto específico
        $tareaActiva = Tarea::join('historias', 'tareas.historia_id', '=', 'historias.id')
            ->where('tareas.encoder_id', $user->id)
            ->where('tareas.estatus', 'codificando')
            ->where('historias.proyecto_id', $proyectoId)
            ->first();

        if ($tareaActiva) {
            session()->flash('error', 'Ya tienes una tarea activa en este proyecto');
            return;
        }

        $this->cambiarEstado($tareaId, 'codificando');
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
        Tarea::find($taskId)->update(
            ['estatus' => 'revisado',
             'comentarios' => $this->comentarios,
        ]);
        // Refresca las tareas después de cambiar el estado
        $this->mount();
        // Mensaje de éxito
        session()->flash('success', 'Tarea revisada exitosamente');
        $this->closeModal();
    }

    public function regresarTarea($taskId){
        $comentarios = $this->comentarios; // Obtener el comentario desde el componente Livewire

        // Actualizar la tarea con el nuevo estado y comentario
        Tarea::find($taskId)->update([
            'estatus' => 'codificando',
            'comentarios' => $comentarios, // Asignar el comentario a la columna correspondiente en la tabla de tareas
        ]);

        // Mostrar un mensaje de depuración en la consola del navegador
        //dd('Método regresarTarea ejecutado correctamente. Comentario:', $comentario);
    }

    public function render()
    {
        return view('livewire.sprintboard');
    }


    public function obtenerApodo($usuarioID)
    {
        $usuario = Usuario::find($usuarioID);
        if ($usuario) {
            return $usuario->apodo;
        } else {
            return 'Usuario no encontrado';
        }
    }
}
