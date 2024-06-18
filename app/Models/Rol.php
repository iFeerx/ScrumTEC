<?php   //modelo

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rol extends Model
{
    use HasFactory;
    protected $table="roles";

    protected $fillable = [
        'rol',
        'proyecto_id',
        'usuario_id'
    ];

    public function proyecto()
    {
        return $this->hasOne(Proyecto::class,"id","proyecto_id");
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class,"id","usuario_id");
    }

}
