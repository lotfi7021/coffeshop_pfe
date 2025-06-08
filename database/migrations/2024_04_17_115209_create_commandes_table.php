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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('ref_commande');
            $table->integer('id_client');
            $table->float('prix');
            $table->float('tva');
            $table->string('date_livraison');
            $table->string('title');
            $table->string('start');
            $table->string('end');
            $table->integer('total_qte');
            $table->integer('id_livreur');
            $table->string('etat');
            $table->string('paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
