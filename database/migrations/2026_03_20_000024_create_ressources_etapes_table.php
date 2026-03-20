<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ressources_etapes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('etape_parcours_id')->constrained('etapes_parcours')->cascadeOnDelete();
            $table->foreignId('type_ressource_id')->constrained('types_ressources')->restrictOnDelete();
            $table->string('titre', 180);
            $table->string('url', 2048);
            $table->string('source', 180)->nullable();
            $table->boolean('est_gratuit')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ressources_etapes');
    }
};
