<?php

namespace Tests\Feature\Livewire;
use Tests\TestCase;
use App\Models\Tarea;
use App\Models\Usuario;

class TareaRevisadaTest extends TestCase
{
    /** @test */
    public function una_tarea_puede_tener_un_revisor()
    {
        // Creamos un usuario revisor
        $revisor = Usuario::factory()->create();

        // Creamos una tarea y asociamos el usuario revisor
        $tarea = Tarea::factory()->create([
            'reviewer_id' => $revisor->id,
        ]);

        // Verificamos que el método reviewer() devuelva la relación con el usuario revisor
        $this->assertInstanceOf(Usuario::class, $tarea->reviewer);
        $this->assertEquals($revisor->id, $tarea->reviewer->id);
    }
}
