<?php   //modelo

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;

class Adjunto extends Model
{
    use HasFactory;


    public function tarea()
    {
        return $this->hasMany(Tarea::class,"tarea_id","id");
    }
}
