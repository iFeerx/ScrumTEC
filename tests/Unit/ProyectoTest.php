<?php

namespace Tests\Unit;

use App\Models\Historia;
use App\Models\Proyecto;
use App\Models\Tarea;
use Tests\TestCase;

class ProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $proyecto = Proyecto::factory()->create();
        $historias = Historia::factory()->count(10)->make();
        foreach ($historias as $historia) {
            $historia->proyecto_id = $proyecto->id;
            $historia->save();
            $tareas = Tarea::factory()->count(10)->make();
            foreach ($tareas as $tarea)
            {
                $tarea->historia_id = $historia->id;
                $tarea->esfuerzo_estimado = 3;
                $tarea->save();
            }
        }
        //dump($proyecto->esfuerzoTotal);
        $this->assertTrue($proyecto->esfuerzoTotal == 300);
    }
}
