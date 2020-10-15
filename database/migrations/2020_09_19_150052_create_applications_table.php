<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applications', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('description');
			$table->string('problem_img')->nullable();
			$table->string('result_img')->nullable();
			$table->integer('user_id');
			$table->integer('category_id');
			$table->integer('status_id')->default(1);
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
		Schema::dropIfExists('applications');
	}
}
