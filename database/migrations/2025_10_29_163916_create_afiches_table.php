<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('afiches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mascota_id')->constrained()->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('telefono_contacto');
            $table->string('recompensa')->nullable();
            $table->string('plantilla')->default('default');
            $table->string('color_principal')->default('#10b981');
            $table->boolean('mostrar_recompensa')->default(false);
            $table->boolean('mostrar_contacto')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('afiches');
    }
};