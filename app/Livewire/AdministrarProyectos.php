<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Rol;
use App\Models\Usuario;

class AdministrarProyectos extends Component
{
    public $proyectos;
    public $proyectoSeleccionado;
    public $nombre;
    public $descripcion;
    public $fecha_entrega;
    public $search = '';
    public $refresh = 0;
    public $proyectoId;
    public $mostrarModal = false;
    public $usuarios;
    public $usuario_id;

    public function mount()
    {
        $this->proyectos = Proyecto::all()->sortBy('nombre');
    }

    public function render()
    {
        $this->refresh++;
        $this->proyectos = Proyecto::buscarPorNombre($this->search);
        $this->usuarios = Usuario::all();
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
        $this->fecha_entrega = null;
        $this->proyectoSeleccionado = null;
    }

    public function buscar() {}

    public function agregarProyecto()
    {
        $proyecto=new Proyecto();
        $proyecto->nombre=$this->nombre;
        $proyecto->descripcion=$this->descripcion;
        $proyecto->fecha_entrega=$this->fecha_entrega;
        $proyecto->save();
        $rol= new Rol();
        $rol->proyecto_id=$proyecto->id;
        $rol->usuario_id=$this->usuario_id;
        $rol->rol="Scrum master";
        $rol->save();

        // Limpiar los campos y actualizar la lista de proyectos
        $this->limpiarCampos();
        $this->proyectos = Proyecto::all()->sortBy('nombre');
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

     public function obtenerEsfuerzoEstimadoAcumulado($proyectoId)
    {

        $proyecto = Proyecto::with('historias.tareas')->find($proyectoId);
        $esfuerzoTotal = 0;
        if ($proyecto) {
            foreach ($proyecto->historias as $historia) {
                foreach ($historia->tareas as $tarea) {
                    $esfuerzoTotal += $tarea->esfuerzo_estimado;  // Asumiendo que el campo es 'esfuerzo_estimado' en Tarea
                }
            }
        }
        return $esfuerzoTotal;
    }

    public function abrirModal()
    {
        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
    }
}
