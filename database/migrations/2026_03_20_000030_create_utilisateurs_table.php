<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table): void {
            $table->id();
            $table->string('nom', 120);
            $table->string('prenoms', 180)->nullable();
            $table->string('email', 180)->unique();
            $table->string('mot_de_passe');
            $table->string('role', 20)->default('etudiant');
            $table->boolean('est_actif')->default(true);
            $table->timestamp('dernier_login_le')->nullable();
            $table->timestamp('cree_le')->useCurrent();
            $table->timestamp('mis_a_jour_le')->nullable()->useCurrentOnUpdate();
            $table->timestamp('supprime_le')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
