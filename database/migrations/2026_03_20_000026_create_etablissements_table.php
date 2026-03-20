<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etablissements', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 180);
            $table->string('slug', 180)->unique();
            $table->foreignId('type_etablissement_id')->constrained('types_etablissements')->restrictOnDelete();
            $table->foreignId('ville_id')->constrained('villes')->restrictOnDelete();
            $table->text('description')->nullable();
            $table->string('adresse', 255)->nullable();
            $table->string('email', 180)->nullable();
            $table->string('telephone', 40)->nullable();
            $table->string('site_web', 2048)->nullable();
            $table->boolean('est_publie')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->timestamp('supprime_le')->nullable();
            $table->unique(['nom', 'ville_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
