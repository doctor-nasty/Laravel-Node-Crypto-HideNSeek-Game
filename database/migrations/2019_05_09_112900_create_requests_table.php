<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('requests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('username', 255)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('subject', 255)->nullable();
			$table->text('message', 255)->nullable();
			$table->text('user_id', 255)->nullable();
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
		Schema::drop("requests");
	}
}
