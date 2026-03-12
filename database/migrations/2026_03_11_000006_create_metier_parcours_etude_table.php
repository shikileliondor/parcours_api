<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metier_parcours_etude', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('parcours_etude_id')->constrained('parcours_etudes')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['metier_id', 'parcours_etude_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metier_parcours_etude');
    }
};
