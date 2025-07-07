<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_reactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('site_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('reaction_type_id')->constrained();
            $table->string('ip_date_hash');
            $table->index(['site_id', 'reaction_type_id', 'ip_date_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_reactions');
    }
};
