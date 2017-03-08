<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsReportTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tip_id')->unsigned();
			$table->string('remoteaddr', 15);
			$table->string('useragent', 255);
			$table->integer('report');
			$table->timestamps();

			$table->foreign('tip_id')->unsigned()->references('id')->on('tips')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('reports');
	}
}
