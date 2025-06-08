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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('reference','50')->nullable();
            $table->string('titre','50')->nullable();
            $table->string('description','255')->nullable();
            $table->string('image1','255')->nullable();
            $table->float('Qte');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade');
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->boolean('status');
            $table->boolean('nouveau');
            $table->integer('viewer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit');
        $table->dropForeign('lists_marque_id_foreign');
        $table->dropForeign('lists_categorie_id_foreign');;
    }
};
