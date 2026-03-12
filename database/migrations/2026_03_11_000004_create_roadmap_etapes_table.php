<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roadmap_etapes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('metier_id')->constrained('metiers')->cascadeOnDelete();
            $table->unsignedInteger('ordre');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['metier_id', 'ordre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap_etapes');
    }
};
