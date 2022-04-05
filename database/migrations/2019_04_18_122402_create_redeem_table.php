<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('points', 255)->nullable();
            $table->string('user_id', 255)->nullable();
            $table->string('wallet', 255)->nullable();
            $table->string('giftcard', 255)->nullable();
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
        Schema::dropIfExists('redeem');
    }
}
