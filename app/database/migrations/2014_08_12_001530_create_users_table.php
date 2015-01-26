<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('users', function($table)
                {
                        $table->increments('id');
    			$table->string('username', 64)->unique();
			$table->string('password', 64);
                });

                DB::table('users')->insert(
                    array(
                        'username' => 'Bob',
                        'password' => Hash::make('secret')
                    )
                );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
