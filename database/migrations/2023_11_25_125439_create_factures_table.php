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
        Schema::create('factures', function (Blueprint $table) {
            $table->id()->startingValue(201);
           // $table->integer("quantite");
           // $table->text("description");
          //  $table->integer("montant");
            $table->unsignedBigInteger("vehicule_id");
            $table->foreign("vehicule_id")
            ->references("id")
            ->on("vehicules");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
