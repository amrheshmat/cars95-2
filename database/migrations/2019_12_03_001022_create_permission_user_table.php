<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('permission_user')){
			Schema::create('permission_user', function(Blueprint $table)
			{
				$table->increments('id');
				$table->integer('permission_id')->unsigned()->index();
				$table->integer('user_id')->unsigned()->index();
				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permission_user');
	}

}
