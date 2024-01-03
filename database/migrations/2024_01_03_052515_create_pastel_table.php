<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pastel', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('tamano');
            $table->string('masa');
            $table->string('sabor');
            $table->string('cobertura');
            $table->string('relleno');
            $table->string('descripcion');
            $table->decimal('precio', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastel');
    }
};
