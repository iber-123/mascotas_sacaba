<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('dueño_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->text('mensaje');
            $table->enum('tipo', ['reclamo', 'hogar_temporal', 'adopcion', 'consulta']);
            $table->boolean('leido')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contactos');
    }
};