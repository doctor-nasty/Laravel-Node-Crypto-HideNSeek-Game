<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalPointsChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_points_charge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 255)->nullable();
            $table->string('charge_id', 255)->nullable();
            $table->text('payload')->nullable();
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
        Schema::dropIfExists('paypal_points_charge');
    }
}
