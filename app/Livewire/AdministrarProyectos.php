<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Usuario;

class AdministrarProyectos extends Component
{
    public $proyectos;
    public $proyectoSeleccionado;
    public $nombre;
    public $descripcion;
    public $search = '';
    public $usuario;
    public $refresh = 0;

    public function mount()
    {
        $this->proyectos = Proyecto::all()->sortBy('nombre');
    }

    public function render()
    {
        $this->refresh++;
        $this->proyectos = Proyecto::buscarPorNombre($this->search);

        return view('livewire.administrar-proyectos', [
            'proyectos' => $this->proyectos->map(function ($proyecto) {
                $proyecto->usuario_nombre = $proyecto->usuario->nombre ?? 'N/A';
                return $proyecto;
            })
        ]);
    }

    public function seleccionarProyecto($proyectoId)
    {
        $this->proyectoSeleccionado = Proyecto::find($proyectoId);
        $this->nombre = $this->proyectoSeleccionado->nombre;
        $this->descripcion = $this->proyectoSeleccionado->descripcion;
    }

    public function actualizarProyecto()
    {
        //dd($this->proyectoSeleccionado);
        if ($this->proyectoSeleccionado) {
            // Actualizar los atributos del proyecto
            $this->proyectoSeleccionado->nombre = $this->nombre;
            $this->proyectoSeleccionado->descripcion = $this->descripcion;
            $this->proyectoSeleccionado->save();
        }
        // Limpiar los campos y actualizar la lista de proyectos
        $this->limpiarCampos();
    }

    public function eliminarProyecto($proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);

        // Establecer la fecha de eliminación en la fecha y hora actuales
        $proyecto->delete();
        //$proyecto->update(['deleted_at' => now()]);

        // Actualizar la lista de proyectos
        $this->proyectos = Proyecto::all()->sortBy('nombre');
    }

    public function limpiarCampos()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->proyectoSeleccionado = null;
    }

    public function buscar() {}

    public function agregarProyecto()
    {
        // Obtener los proyectos antes de redirigir
        $proyectos = Proyecto::all()->sortBy('nombre');

        // Guardar los proyectos en la sesión flash
        session()->flash('proyectos', $proyectos);

        // Redirige a una nueva ruta donde se puede agregar un nuevo proyecto
        return redirect()->to('/nuevo-proyecto');
    }


    public function crearProyecto()
    {
        Proyecto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'scrum_master' => $this->usuario, // Asignar el usuario seleccionado al proyecto
        ]);

        // Limpiar los campos y actualizar la lista de proyectos
        $this->limpiarCampos();

        // Redireccionar después de agregar el proyecto
        return redirect()->to('/proyectos');
    }
}
