<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tips', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('tip', 35);
			$table->string('description', 35);
			$table->boolean('sticky')->default(0);
			$table->string('remoteaddr', 15)->nullable();
			$table->string('useragent', 255)->nullable();
			$table->timestamps();

			$table->foreign('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('tips');
	}
}
