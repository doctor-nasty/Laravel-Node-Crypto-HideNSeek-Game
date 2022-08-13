<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 20)->nullable();
            $table->string('wallet_address', '45')->unique();
            $table->string('status', 255)->default('3');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar', 255)->default('user.jpg');
            $table->string('settings', 255)->nullable();
            $table->string('points', 255)->default('35')->nullable();
            $table->string('lockout_time', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('total_winning_points', 255)->nullable();
            $table->rememberToken();
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
        // Schema::dropIfExists('users');
    }
}
