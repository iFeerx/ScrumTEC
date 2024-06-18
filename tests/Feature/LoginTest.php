<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\Proyecto;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_usuario_exitoso(): void
    {
        $usuario = Usuario::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertRedirect('proyecto');
        $this->assertNotNull(Session::get('usuario'));
    }

    public function test_login_usuario_incorrecto(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'contraseñaincorrecta',
        ]);
        $response->assertRedirect()->assertSessionHas('error');
    }

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
