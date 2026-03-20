<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecole_filiere', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('ecole_id')->constrained('ecoles')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['ecole_id', 'filiere_id']);
            $table->index(['filiere_id', 'ecole_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecole_filiere');
    }
};
