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
        Schema::table('model_voitures', function (Blueprint $table) {
            $table->unsignedBigInteger('id_marque')->after('status');
            $table->foreign('id_marque')
                  ->references('id')->on('marques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('model_voitures', function (Blueprint $table) {
            //
        });
    }
};
