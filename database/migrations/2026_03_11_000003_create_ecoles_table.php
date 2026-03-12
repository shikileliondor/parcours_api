<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecoles', function (Blueprint $table): void {
            $table->id();
            $table->string('nom');
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('site_web')->nullable();
            $table->timestamps();

            $table->index(['ville', 'pays']);
            $table->unique(['nom', 'ville', 'pays']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecoles');
    }
};
