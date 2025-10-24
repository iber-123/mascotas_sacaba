<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mascota_id')->constrained()->onDelete('cascade');

            $table->enum('estado', ['perdida', 'encontrada', 'adopcion'])
                ->default('perdida');

            $table->string('ubicacion')->nullable();
            $table->string('sexo')->nullable();
            $table->string('edad')->nullable();
            $table->string('raza')->nullable();
            $table->string('color')->nullable();
            $table->date('fecha')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('foto')->nullable(); // URL o path a la foto de la mascota

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};

