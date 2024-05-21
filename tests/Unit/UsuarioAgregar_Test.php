<?php

namespace Tests\Unit;

use App\Livewire\UsuarioLive;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class UsuarioAgregar_Test extends TestCase
{
    public function test_agregar_usuario(): void
    {
        Livewire::test(UsuarioLive::class)
        ->set('control', '00111000')
        ->set('nombre', 'juanelo')
        ->set('password', 'password')
        ->set('email', 'ema@email')
        ->set('esfuerzo_semanal', '5')
        ->set('apodo', 'chon')
        ->set('estatus', 'activo')
        ->call('submit');
        $this->assertDatabaseHas('usuarios', [
            'control' => '00111000',
            'nombre' => 'juanelo',
            'email' => 'ema@email',
            'esfuerzo_semanal'=>'5',
            'apodo'=>'chon',
            'estatus'=>'activo'
        ]);
    }
}
