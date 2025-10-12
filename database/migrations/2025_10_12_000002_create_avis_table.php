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
        // Table avis
        Schema::create('avis', function (Blueprint $table) {
            $table->id('id_avis');
            $table->foreignId('id_copain')->constrained('copain')->onDelete('cascade');
            $table->foreignId('id_lieu')->constrained('lieu')->onDelete('cascade');
            $table->text('avis')->nullable();
            $table->decimal('note_general', 3, 1)->nullable();
            $table->boolean('reco')->default(false);
            $table->timestamps();
            
            // Index unique pour éviter les doublons (un copain ne peut avoir qu'un seul avis par lieu)
            $table->unique(['id_copain', 'id_lieu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
