<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTestFallido extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_usuario_incorrecto(): void
    {
        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => 'contraseñaincorrecta',
        ]);
        $response->assertRedirect()->assertSessionHas('error');
    }
}
