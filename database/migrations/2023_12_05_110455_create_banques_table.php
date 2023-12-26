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
        Schema::create('banques', function (Blueprint $table) {
            $table->id();
            //'','','','','',''
            $table->date('date');
            $table->text("description");
            $table->string('reference');
            $table->double('credit')->nullable();
            $table->double('debit')->nullable();

            $table->double('solde');
            $table->unsignedBigInteger('facture_id')->nullable();
            $table->foreign('facture_id')
            ->references('id')
            ->on("factures");
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
        Schema::dropIfExists('banques');
    }
};
