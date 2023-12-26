<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mouvements', function (Blueprint $table) {
            $table->unsignedBigInteger("facture_id")->nullable();
            $table->foreign("facture_id")
            ->references("id")
            ->on("factures");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mouvements', function (Blueprint $table) {
            //
        });
    }
};
