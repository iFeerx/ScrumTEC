<?php   //modelo

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;

class Requisito extends Model
{
    use HasFactory;

    public function tarea()
    {
        return $this->HasOne(Tarea::class,"tarea_id","id");
    }
    public function requisito()
    {
        return $this->HasOne(Tarea::class,"requisito_id","id");
    }
}
