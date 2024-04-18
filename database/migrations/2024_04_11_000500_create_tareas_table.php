<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historia_id')->references('id')->on('historias');
            $table->string('nombre',50);
            $table->text('descripcion');
            $table->text('entregables');
            $table->unsignedInteger('esfuerzo_estimado')->default(0);
            $table->unsignedInteger('esfuerzo_real')->default(0);
            $table->unsignedInteger('sprint')->default(0);
            $table->unsignedBigInteger('encoder_id')->nullable()->default(null);
            $table->foreign('encoder_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('reviewer_id')->nullable()->default(null);
            $table->foreign('reviewer_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('tester_id')->nullable()->default(null);
            $table->foreign('tester_id')->references('id')->on('usuarios');
            $table->date('encoder_date')->nullable();
            $table->date('reviewer_date')->nullable();
            $table->date('tester_date')->nullable();
            $table->date('encoding_finish_date')->nullable();
            $table->date('reviewer_finish_date')->nullable();
            $table->date('tester_finish_date')->nullable();
            $table->text('comentarios');
            $table->enum('estatus', ['espera', 'codificando', 'revisando', 'probando', 'terminado', 'corrigiendo', 'codificado', 'revisado', 'probado', 'atascado']);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /*$table->foreignId('nombreEnEstaTabla')->references('campoReal')->on('tablaOrigen');*/

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
