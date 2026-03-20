<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('niveaux_etudes', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->unsignedSmallInteger('ordre')->default(1);
            $table->text('description')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveaux_etudes');
    }
};
