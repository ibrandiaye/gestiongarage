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
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->double("montant");
            $table->text("description");
            $table->string("type");
          /*  $table->unsignedBigInteger('depensevehicule_id')->nullable();
            $table->foreign('depensevehicule_id')->references('id')->on('depensevehicules');
            $table->unsignedBigInteger('reglement_id')->nullable();
            $table->foreign('reglement_id')->references('id')->on('reglements');*/

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
        Schema::dropIfExists('mouvements');
    }
};
