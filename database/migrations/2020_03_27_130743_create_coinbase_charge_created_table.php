<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinbaseChargeCreatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinbase_charge_created', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 255)->nullable();
            $table->string('charge_id', 255)->nullable();
            $table->string('payload', 255)->nullable();
            $table->string('is_paid', 255)->nullable();
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
        Schema::dropIfExists('coinbase_charge_created');
    }
}
