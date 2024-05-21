<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_usuario_exitoso(): void
    {
        $usuario = Usuario::factory()->create([
            //'email' => 'teste@example.com',
            'password' => Hash::make('password'),
        ]);
        $response = $this->post('/', [
            'email' => $usuario->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('proyecto');
        $this->assertNotNull(Session::get('usuario'));
    }
}
