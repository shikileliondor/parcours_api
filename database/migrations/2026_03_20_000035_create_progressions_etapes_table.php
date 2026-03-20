<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progressions_etapes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('progression_parcours_id')->constrained('progressions_parcours')->cascadeOnDelete();
            $table->foreignId('etape_parcours_id')->constrained('etapes_parcours')->cascadeOnDelete();
            $table->string('statut', 20)->default('non_commence');
            $table->timestamp('complete_le')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['progression_parcours_id', 'etape_parcours_id'], 'prog_etapes_prog_etape_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progressions_etapes');
    }
};
