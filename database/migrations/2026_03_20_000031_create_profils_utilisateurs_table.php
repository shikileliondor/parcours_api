<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profils_utilisateurs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('ville_id')->nullable()->constrained('villes')->nullOnDelete();
            $table->foreignId('niveau_etude_id')->nullable()->constrained('niveaux_etudes')->nullOnDelete();
            $table->date('date_naissance')->nullable();
            $table->string('genre', 20)->nullable();
            $table->text('bio')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique('utilisateur_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils_utilisateurs');
    }
};
