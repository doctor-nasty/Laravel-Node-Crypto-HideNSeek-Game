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
        Schema::create('token_infos', function (Blueprint $table) {
            $table->id();

            // ownership
            $table->integer('token_id')->unique();
            $table->string('owner', 50);
            $table->dateTime('purchase_time')->nullable();
            
            // delegation info
            $table->integer('status')->default(0); // 0-default, 1-offered, 2-delegated
            $table->string('borrower', 50)->nullable();
            $table->integer('duration')->nullable();
            $table->dateTime('expiresAt')->nullable();

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
        Schema::dropIfExists('token_infos');
    }
};
