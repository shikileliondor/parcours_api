<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parcours_etudes', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->string('niveau')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['nom', 'niveau']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcours_etudes');
    }
};
