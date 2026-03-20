<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecole_domaine', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('ecole_id')->constrained('ecoles')->cascadeOnDelete();
            $table->foreignId('domaine_id')->constrained('domaines')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['ecole_id', 'domaine_id']);
            $table->index(['domaine_id', 'ecole_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecole_domaine');
    }
};
