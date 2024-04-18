<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historia extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,"proyecto_id","id");
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class,"historia_id","id");
    }
}
