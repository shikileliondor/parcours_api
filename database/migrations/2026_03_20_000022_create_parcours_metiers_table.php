<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parcours_metiers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->string('titre', 180);
            $table->text('description')->nullable();
            $table->unsignedInteger('version')->default(1);
            $table->boolean('est_actif')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['metier_id', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcours_metiers');
    }
};
