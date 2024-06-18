<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class Usuariocrud_Test extends TestCase
{
    public function test_render_retorna_vista_con_usuarios(): void
    {
        Usuario::factory()->count(3)->create();
        $response = Livewire::test('usuario-live');
        $response->assertSee('Mr. Theodore Schuster');
        $response->assertSee('Ms. Cierra DuBuque IV');
        $response->assertSee('Alaina Brakus');
    }

}
