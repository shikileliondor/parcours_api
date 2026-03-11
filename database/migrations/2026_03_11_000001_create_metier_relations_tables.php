<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('competences', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('parcours_etudes', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->string('niveau')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('ecoles', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->string('ville')->nullable();
            $table->string('site_web')->nullable();
            $table->timestamps();
        });

        Schema::create('competence_metier', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['metier_id', 'competence_id']);
        });

        Schema::create('metier_parcours_etude', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('parcours_etude_id')->constrained('parcours_etudes')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['metier_id', 'parcours_etude_id']);
        });

        Schema::create('ecole_metier', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('ecole_id')->constrained('ecoles')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['metier_id', 'ecole_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecole_metier');
        Schema::dropIfExists('metier_parcours_etude');
        Schema::dropIfExists('competence_metier');
        Schema::dropIfExists('ecoles');
        Schema::dropIfExists('parcours_etudes');
        Schema::dropIfExists('competences');
    }
};
