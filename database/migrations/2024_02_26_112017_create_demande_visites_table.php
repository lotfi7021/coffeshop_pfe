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
        Schema::create('demande_visites', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable;
            $table->string('prenom')->nullable;
            $table->string('email')->nullable;
            $table->string('telephone')->nullable;
            $table->text('message')->nullable;
            $table->string('reference')->nullable;
            $table->datetime('date_rdv')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_visites');
    }
};
