<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('villes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('pays_id')->constrained('pays')->cascadeOnDelete();
            $table->string('nom', 120);
            $table->string('slug', 180)->unique();
            $table->boolean('est_actif')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->unique(['pays_id', 'nom']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villes');
    }
};
