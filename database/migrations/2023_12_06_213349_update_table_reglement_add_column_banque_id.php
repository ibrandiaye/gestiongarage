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
        Schema::table('reglements', function (Blueprint $table) {
            $table->unsignedBigInteger("banque_id")->nullable();
            $table->foreign("banque_id")
            ->references("id")
            ->on("banques");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banques', function (Blueprint $table) {

        });
    }
};
