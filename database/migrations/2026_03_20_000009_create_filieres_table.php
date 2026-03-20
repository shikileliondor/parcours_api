<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('filieres', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 120)->unique();
            $table->timestamps();
            $table->index('nom');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};
