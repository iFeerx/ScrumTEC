<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Adjunto;
use App\Models\Tarea;
use Illuminate\Support\Facades\Storage;

class ArchivosAdjuntables extends Component
{
    use WithFileUploads;
    //Arreglo que contiene los archivos a subir
    public $archivos = [];
    //Arreglo con los nombres de los archivos a subir
    public $nombres = [];
    //Variable que contiene el id de la tarea
    public $tarea_id=4;

    public function mount($id)
    {
        $this->tarea_id = $id;
    }

    public function render()
    {
        //return view('livewire.archivos-adjuntables');
        $archivosAdjuntos = Adjunto::where('tarea_id', $this->tarea_id)->get();

        return view('livewire.archivos-adjuntables', [
            'archivosAdjuntos' => $archivosAdjuntos,
        ]);
    }

    public function subirEntregables()
    {
        // Si hay archivos seleccionados y los nombres están vacíos, llenar los nombres con los placeholders
        foreach ($this->archivos as $index => $archivo) {
            if (empty($this->nombres[$index])) {
                $nombreArchivo = $archivo->getClientOriginalName();
                $this->nombres[$index] = $nombreArchivo;
            }
        }
        //Valida que los arreglos contengan los datos suficientes para subir un archivo
        $this->validate([
            'archivos.*' => 'required|file',
            'nombres.*' => 'required|string|max:255',
        ]);
        //Guarda cada archivo a subir tanto en el storage como en la base de datos
        foreach ($this->archivos as $index => $archivo) {
            $nombreArchivo = $this->nombres[$index] . '.' . $archivo->getClientOriginalExtension();
            $url = $archivo->storeAs('public/archivos/'.$this->tarea_id, $nombreArchivo);

            $adj=new Adjunto();
            $adj->tarea_id = $this->tarea_id;
            $adj->nombre = $this->nombres[$index];
            $adj->url = $url;
            $adj->save();
        }
        session()->flash('success', 'Archivos subidos correctamente.');
        $this->reset(['archivos', 'nombres']);
    }
    //Funcion para eliminar un archivo
    public function eliminarArchivo($archivoId)
    {
        $archivo = Adjunto::find($archivoId);
        if ($archivo) {
            // Eliminar archivo físico del almacenamiento
            Storage::delete($archivo->url);
            // Eliminar registro de la base de datos
            $archivo->delete();
            session()->flash('success', 'Archivo adjunto eliminado correctamente.');
        }
    }
    //Funcion para completar una tarea
    public function tareaCompleta()
    {
        // Buscar y actualizar registros según el id de la tarea
        Tarea::where('id', $this->tarea_id)
          ->update(['estatus' => 'revisando']);
        session()->flash('success', 'El estatus se ha actualizado a "Terminado" correctamente.');
    }
}
