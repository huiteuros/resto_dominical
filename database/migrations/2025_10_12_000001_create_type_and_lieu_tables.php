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
        // Table type
        Schema::create('type', function (Blueprint $table) {
            $table->id('id_type');
            $table->string('nom', 100);
            $table->timestamps();
        });

        // Table lieu
        Schema::create('lieu', function (Blueprint $table) {
            $table->id('id_lieu');
            $table->string('nom', 100);
            $table->string('adresse', 255)->nullable();
            $table->foreignId('id_type')->constrained('type')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lieu');
        Schema::dropIfExists('type');
    }
};
