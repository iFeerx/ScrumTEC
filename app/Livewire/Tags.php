<?php

namespace App\Livewire;

use Livewire\Component;

class Tags extends Component
{
    public $estatus;
    public $color;

    public function mount($estatus,$color)
    {
        $this->estatus = $estatus;
        $this->color = $color;
    }
    
    public function render()
    {
        return view('livewire.tags');
    }
}
