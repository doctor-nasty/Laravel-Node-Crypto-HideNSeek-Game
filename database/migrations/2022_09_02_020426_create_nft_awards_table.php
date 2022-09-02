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
        Schema::create('nft_awards', function (Blueprint $table) {
            $table->id();
            $table->string('address', 50);
            $table->integer('nft_type');
            $table->string('description');
            $table->integer('status')->default(0);
            $table->string('tx_hash')->nullable();
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
        Schema::dropIfExists('nft_awards');
    }
};
