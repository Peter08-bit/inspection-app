<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('numero_serie')->unique();
            $table->string('categorie');
            $table->string('localisation')->nullable();
            $table->enum('etat', ['bon', 'a_verifier', 'defectueux'])->default('bon');
            $table->date('date_achat')->nullable();
            $table->string('marque')->nullable();
            $table->string('responsable')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiels');
    }
};
