<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    protected $table = 'tareas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'proyecto_id',
        'nombre_tarea',
        'descripcion',
        'entregables',
        'esfuerzo_estimado',
        'esfuerzo_real',
        'sprint',
        'encoder_id',
        'reviewer_id',
        'tester_id',
        'encoder_date',
        'reviewer_date',
        'tester_date',
        'encoding_finish_date',
        'reviewer_finish_date',
        'tester_finish_date',
        'comentarios',
        'estatus',
    ];


    /**
     * Get the project associated with the task.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }


    /**
     * The relationships to the Usuario model for the encoder, reviewer, and tester.
     */
    public function encoder()
    {
        return $this->belongsTo(Usuario::class, 'encoder_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Usuario::class, 'reviewer_id');
    }

    public function tester()
    {
        return $this->belongsTo(Usuario::class, 'tester_id');
    }
}
