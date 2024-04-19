<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function historias()
    {
        return $this->hasMany(Historia::class,"proyecto_id","id");
    }

    public function product_owner() {

    }
    public function scrum_masters() {
        //select usuarios.* form usuarios
        //inner join roles on (roles.usuario_id == usuarios.id)
        //where roles.rol = 'Scrum master' and roles.proyecto_id = $this.id
        return Usuario::join('roles','roles.usuario_id','usuarios.id')
            ->where([['rol','Scrum master'],['proyecto_id',$this->id]])->get();

    }
    public function team_leaders() {}
    public function developers() {}
    public function reviewrs() {}
    public function testers() {}

    public function getEsfuerzoTotalAttribute() {
        $suma = 0;
        foreach ($this->historias as $historia)
            foreach ($historia->tareas as $tarea) {
                $suma += $tarea->esfuerzo_estimado;
            }
        return $suma;
    }
}
