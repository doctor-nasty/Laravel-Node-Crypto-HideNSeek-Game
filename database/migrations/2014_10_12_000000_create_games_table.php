<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('type');
            $table->longText('comment');
            $table->string('title', 255);
            $table->string('city', 255);
            $table->string('mark_lat', 255)->nullable();
            $table->string('mark_long', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('points', 255);
            $table->string('winner_user_id', 255)->nullable();
            $table->text('full_comment')->nullable();
            $table->unsignedBigInteger('status')->default('3');
            $table->string('photo')->default('game.jpg');
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
        Schema::dropIfExists('games');
    }
}
