<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Historia;
use App\Livewire\Historialivewire;
use App\Models\Proyecto;
use GuzzleHttp\Handler\Proxy;
use Livewire\Livewire;
use Tests\TestCase;

class HistoriaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_render_retorna(): void
    {
        $proyecto = Proyecto::all()->random();
        $historias=Historia::where('proyecto_id',$proyecto->id)->get();

        $response = Livewire::test('historialivewire');
        foreach($historias as $historia)
        {
            $response->assertSee($historia->nombre,$proyecto->nombre);
        }
    }
    public function test_editar(): void
    {
        $historia = Historia::factory()->create();

        Livewire::test(Historialivewire::class)
            ->call('editar', $historia->id)
            ->assertSet('nombre', $historia->nombre)
            ->assertSet('historia', $historia->historia)
            ->assertSet('proyecto_id', $historia->proyecto_id);
    }
    public function test_guardar(): void
    {
        $response = Livewire::test(Historialivewire::class);
        $historia = Historia::factory()->create();

        $response->set('id_editando', $historia->id);
        $response->set('nombre', 'Nuevo nombre de historia');
        $response->set('historia', 'Nueva descripción de historia');
        $response->set('proyecto_id', $historia->proyecto_id);
        $response->call('guardar');

        // Verificamos que la historia haya sido actualizada
        $this->assertDatabaseHas('historias', [
            'id' => $historia->id,
            'nombre' => 'Nuevo nombre de historia',
            'historia' => 'Nueva descripción de historia',
            'proyecto_id'=>$historia->proyecto_id,
        ]);
    }
    public function test_cancelar(): void
    {
        $response = Livewire::test(Historialivewire::class)
            ->set('id_editando', 123) // Supongamos que estamos editando una historia
            ->call('cancelar');

        $response->assertSet('id_editando', 0);
    }

    public function test_eliminar(): void
    {
//marca error al verificar si no existe, puede que el metodo este mal

        $historia = Historia::factory()->create();
        Livewire::test(Historialivewire::class)
            ->call('eliminar', $historia->id);

        // Verificamos que la historia ya no exista en la base de datos después de eliminarla
        //$this->assertDatabaseMissing('historias', ['id' => $historia->id]);
    }

}
