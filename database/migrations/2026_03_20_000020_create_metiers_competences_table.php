<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metiers_competences', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->string('niveau_requis', 20)->default('debutant');
            $table->unsignedTinyInteger('priorite')->default(3);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['metier_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metiers_competences');
    }
};
