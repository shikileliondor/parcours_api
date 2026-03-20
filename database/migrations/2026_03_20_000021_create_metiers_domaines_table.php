<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metiers_domaines', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('domaine_etude_id')->constrained('domaines_etudes')->cascadeOnDelete();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['metier_id', 'domaine_etude_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metiers_domaines');
    }
};
