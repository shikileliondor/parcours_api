<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table): void {
            $table->id();
            $table->string('nom_fichier', 255);
            $table->string('url', 2048);
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('taille_octets')->nullable();
            $table->string('alt', 255)->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
