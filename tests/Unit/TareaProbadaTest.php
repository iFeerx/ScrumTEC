<?php

namespace Tests\Feature\Livewire;

use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TareaProbadaTest extends TestCase
{

    /** @test */
    public function it_shows_task_details_when_clicked()
    {
        // Crear un usuario y una tarea asociados
        $usuario = Usuario::factory()->create();
        $tarea = Tarea::factory()->create([
            'tester_id' => $usuario->id,
            'nombre' => 'Test Tarea'
        ]);

        // Probar el componente Livewire
        Livewire::test('sprint-board')
            ->call('showTask', $tarea->id)
            ->assertSee('Test Tarea')
            ->assertSee($usuario->name);
    }
}
