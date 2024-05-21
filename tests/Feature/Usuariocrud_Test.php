<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class Usuariocrud_Test extends TestCase
{
    use DatabaseTransactions;

    public function test_render_retorna_vista_con_usuarios(): void
    {
        $usuarios = Usuario::factory()->count(3)->create();
        $response = Livewire::test('usuario-live');
        $response->assertSee($usuarios[0]->nombre);
        $response->assertSee($usuarios[1]->nombre);
        $response->assertSee($usuarios[2]->nombre);
    }

}
