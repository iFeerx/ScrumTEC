<?php

namespace Tests\Feature;

use App\Models\Proyecto;
use App\Models\Historia;
use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RelacionadasTest extends TestCase
{
    use RefreshDatabase; // Esto reiniciará la base de datos para cada prueba

    public function test_muestra_tareas_relacionadas_al_hacer_clic_en_una_historia(): void
    {
        // Crear un usuario
        $usuario = Usuario::factory()->create();

        // Crear un proyecto
        $proyecto = Proyecto::factory()->create();

        // Crear una historia relacionada con el proyecto
        $historia = Historia::factory()->create([
            'proyecto_id' => $proyecto->id,
        ]);

        // Crear algunas tareas relacionadas con la historia
        $tareas = Tarea::factory()->count(3)->create([
            'historia_id' => $historia->id,
        ]);

        // Autenticar al usuario
        $this->actingAs($usuario);

        // Probar el componente Livewire que maneja las historias
        Livewire::test('historias-livewire-component') // Asegúrate de usar el nombre correcto del componente
            ->call('cargarTareas', $historia->id) // Llama al método que carga las tareas
            ->assertSee($tareas[0]->nombre)
            ->assertSee($tareas[1]->nombre)
            ->assertSee($tareas[2]->nombre);
    }
}
