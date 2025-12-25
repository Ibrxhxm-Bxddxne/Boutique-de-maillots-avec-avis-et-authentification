<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        // Clé étrangère vers la table users (si l'user est supprimé, ses avis le sont aussi)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Clé étrangère vers la table products
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        
        $table->integer('rating'); // On stockera ici un chiffre de 1 à 5
        $table->text('comment');   // Le texte de l'avis
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
