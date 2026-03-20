<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->foreignId('domaine_etude_id')->constrained('domaines_etudes')->restrictOnDelete();
            $table->foreignId('niveau_etude_id')->constrained('niveaux_etudes')->restrictOnDelete();
            $table->string('titre', 180);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('duree_mois')->nullable();
            $table->unsignedInteger('cout_min')->nullable();
            $table->unsignedInteger('cout_max')->nullable();
            $table->string('devise', 10)->default('FCFA');
            $table->text('conditions_admission')->nullable();
            $table->boolean('est_publie')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->timestamp('supprime_le')->nullable();
            $table->index(['domaine_etude_id', 'niveau_etude_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
