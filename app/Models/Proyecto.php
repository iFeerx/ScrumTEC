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

    public function product_owner() {}
    public function scrum_masters() {}
    public function team_leaders() {}
    public function developers() {}
    public function reviewrs() {}
    public function testers() {}

    public function esfuerzoTotalAttribute() {}
}
