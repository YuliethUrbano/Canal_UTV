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
        Schema::create('noticias', function (Blueprint $table) {
    $table->id('id_noticia');
    $table->string('titulo');
    $table->string('entradilla')->nullable();
    $table->longText('cuerpo');
    $table->string('imagen_destacada')->nullable();
    $table->string('ruta_slug')->unique();
    $table->timestamp('fecha_programada')->nullable();
    $table->timestamp('fecha_publicacion')->nullable();
    $table->enum('estado', ['borrador','revisión','publicado'])->default('borrador');
    $table->unsignedBigInteger('categoria_id')->nullable();
    $table->unsignedBigInteger('autor_id');
    $table->integer('visitas')->default(0);
    $table->timestamps();

    $table->foreign('categoria_id')->references('id_categoria')->on('categorias')->nullOnDelete();
    $table->foreign('autor_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
