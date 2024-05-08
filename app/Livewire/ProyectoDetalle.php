<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Historia;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProyectoDetalle extends Component
{
    protected $proyecto;
    public $proyecto_id;

    public function rules(): array
    {
        return [
        ];
    }

    public function mount($id)
    {
        $this->proyecto_id = $id;
    }

    public function render(){
        $this->proyecto = Proyecto::find($this->proyecto_id);
        return view('livewire.proyecto-detalle',
        ['proyecto'=>$this->proyecto])->layout('layouts.plantilla')->slot('main');
    }

}
