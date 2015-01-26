<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('users', function($table)
            {
                $table->string('email');
                $table->string('firstname');
                $table->string('lastname');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('users', function($table)
            {
                $table->dropColumn('email');
                $table->dropColumn('firstname');
                $table->dropColumn('lastname');
            });
	}

}
