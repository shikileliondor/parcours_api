<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('metiers', function (Blueprint $table): void {
            $table->string('slug', 180)->nullable()->after('nom');
            $table->string('niveau', 20)->default('debutant')->after('description');
            $table->string('devise', 10)->default('FCFA')->after('salaire_max');
            $table->boolean('est_publie')->default(true)->after('duree_estimee');
            $table->softDeletes('supprime_le');

            $table->unique('slug', 'metiers_slug_unique');
            $table->index(['niveau', 'est_publie'], 'metiers_niveau_publie_index');
        });

        Schema::table('competences', function (Blueprint $table): void {
            $table->string('slug', 180)->nullable()->after('nom');
            $table->string('categorie', 80)->nullable()->after('description');

            $table->unique('slug', 'competences_slug_unique');
            $table->index('categorie', 'competences_categorie_index');
        });
    }

    public function down(): void
    {
        Schema::table('competences', function (Blueprint $table): void {
            $table->dropIndex('competences_categorie_index');
            $table->dropUnique('competences_slug_unique');
            $table->dropColumn(['categorie', 'slug']);
        });

        Schema::table('metiers', function (Blueprint $table): void {
            $table->dropIndex('metiers_niveau_publie_index');
            $table->dropUnique('metiers_slug_unique');
            $table->dropSoftDeletes('supprime_le');
            $table->dropColumn(['est_publie', 'devise', 'niveau', 'slug']);
        });
    }
};
