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
         // Table restaurant
        Schema::create('restaurant', function (Blueprint $table) {
            $table->id('id_restaurant');
            $table->string('nom_restau');
            $table->string('type_restau');
            $table->string('adresse_postale')->nullable();
            $table->string('lien_site_web')->nullable();
            $table->boolean('ouvert_dimanche_midi')->default(false);
            $table->timestamps();
        });

        // Table copain (lié à users)
        Schema::create('copain', function (Blueprint $table) {
            $table->id('id_copain');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('pseudo')->unique()->nullable();
            $table->text('info')->nullable();
            $table->timestamps();
        });

        // Table restopasse
        Schema::create('restopasse', function (Blueprint $table) {
            $table->id('id_restopasse');
            $table->foreignId('id_restaurant')->constrained('restaurant')->onDelete('cascade');
            $table->integer('numero_dimanche')->nullable(); // -1 si hors série
            $table->date('date_sortie');
            $table->timestamps();
        });

        // Table amange
        Schema::create('amange', function (Blueprint $table) {
            $table->foreignId('id_copain')->constrained('copain')->onDelete('cascade');
            $table->foreignId('id_restopasse')->constrained('restopasse')->onDelete('cascade');
            $table->tinyInteger('prix')->nullable()->checkBetween(1, 5);
            $table->tinyInteger('qualite_nourriture')->nullable()->checkBetween(1, 5);
            $table->tinyInteger('ambiance')->nullable()->checkBetween(1, 5);
            $table->tinyInteger('overall')->nullable()->checkBetween(1, 5);
            $table->text('avis')->nullable();
            $table->timestamps();

            $table->primary(['id_copain', 'id_restopasse']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amange');
        Schema::dropIfExists('restopasse');
        Schema::dropIfExists('copain');
        Schema::dropIfExists('restaurant');
    }
};
