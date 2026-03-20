<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etapes_parcours', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('parcours_metier_id')->constrained('parcours_metiers')->cascadeOnDelete();
            $table->unsignedInteger('ordre');
            $table->string('titre', 180);
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('duree_estimee_semaines')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['parcours_metier_id', 'ordre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etapes_parcours');
    }
};
