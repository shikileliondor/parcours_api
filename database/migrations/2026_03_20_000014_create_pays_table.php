<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pays', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 120);
            $table->string('code_iso2', 2)->unique();
            $table->string('code_telephone', 10)->nullable();
            $table->boolean('est_actif')->default(true);
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
