<?php //Migracion

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tarea_id")->references('id')->on('tareas');
            $table->foreignId("requisito_id")->references('id')->on('tareas');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('requisitos');
    }
};
