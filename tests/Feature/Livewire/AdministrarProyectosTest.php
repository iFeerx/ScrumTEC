<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AdministrarProyectos;
use App\Models\Proyecto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdministrarProyectosTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AdministrarProyectos::class)
            ->assertStatus(200);
    }
    /** @test */
    public function actualizar_proyecto()
    {
        $proyecto = Proyecto::all()->random();
        Livewire::test(AdministrarProyectos::class)
        ->set('proyectoSeleccionado',$proyecto )
        ->set('nombre', $proyecto->nombre."X")
        ->set('descripcion',$proyecto->descripcion."X")
        ->call('actualizarProyecto');
        $proyectoModificado = Proyecto::find($proyecto->id);
        $this->assertEquals($proyecto->nombre."X", $proyectoModificado->nombre);
        $this->assertEquals($proyecto->descripcion."X", $proyectoModificado->descripcion);
    }

}
