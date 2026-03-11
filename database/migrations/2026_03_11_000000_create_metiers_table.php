<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metiers', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->unsignedInteger('salaire_min');
            $table->unsignedInteger('salaire_moyen');
            $table->unsignedInteger('salaire_max');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metiers');
    }
};
