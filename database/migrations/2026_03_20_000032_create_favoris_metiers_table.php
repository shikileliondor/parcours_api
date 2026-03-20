<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favoris_metiers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->timestamp('cree_le')->useCurrent();
            $table->unique(['utilisateur_id', 'metier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoris_metiers');
    }
};
