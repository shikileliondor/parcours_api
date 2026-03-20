<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progressions_parcours', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('parcours_metier_id')->constrained('parcours_metiers')->cascadeOnDelete();
            $table->string('statut', 20)->default('non_commence');
            $table->unsignedTinyInteger('pourcentage')->default(0);
            $table->timestamp('commence_le')->nullable();
            $table->timestamp('termine_le')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['utilisateur_id', 'parcours_metier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progressions_parcours');
    }
};
