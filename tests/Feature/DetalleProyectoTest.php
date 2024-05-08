<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Proyecto;
use Tests\TestCase;

class DetalleProyectoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_detalle_proyecto(): void
    {
        $proyecto = Proyecto::all()->first();
        $response = $this->get('/proyecto/detalle/'.$proyecto->id);

        $response->assertStatus(200);
    }
}
