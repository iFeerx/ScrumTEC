<?php

namespace Tests\Feature;

use App\Models\Proyecto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginVistaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_vista(): void
    {
        Proyecto::factory()->count(5)->create();
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('proyectos', function ($proyectos) {
            return $proyectos->count() === 5;
        });
    }
}
