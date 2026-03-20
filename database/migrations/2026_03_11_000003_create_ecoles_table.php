<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecoles', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 120);
            $table->string('slug', 160)->unique();
            $table->string('ville', 80);
            $table->string('type', 40);
            $table->string('logo_url', 2048)->nullable();
            $table->timestamps();

            $table->unique(['nom', 'ville']);
            $table->index('nom');
            $table->index('ville');
            $table->index('type');
            $table->index(['ville', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecoles');
    }
};
