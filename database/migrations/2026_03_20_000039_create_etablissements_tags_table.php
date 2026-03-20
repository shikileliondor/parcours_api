<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etablissements_tags', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->timestamp('cree_le')->useCurrent();
            $table->unique(['etablissement_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements_tags');
    }
};
