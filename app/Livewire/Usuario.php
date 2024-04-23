<?php

namespace App\Livewire;

use Livewire\Component;

class Usuario extends Component
{
    public $usuario_detalle_id = 0;
    public function render()
    {
        return view('livewire.usuario');
    }
    public function openModal()
    {
        $this->usuario_detalle_id = 10;
    }
}
