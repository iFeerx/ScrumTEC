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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('control',11);
            $table->string('nombre',100);
            $table->string('password',128);
            $table->string('email',250)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedInteger('esfuerzo_semanal');
            $table->string('apodo',15);
            $table->enum('estatus', ['activo', 'baja']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
