<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formations_metiers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->unsignedTinyInteger('pertinence')->default(3);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['formation_id', 'metier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations_metiers');
    }
};
