<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BiggerAmount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
                Schema::table('cashflow_events', function($table) {
                    $table->dropColumn('amount');
                });
                Schema::table('cashflow_events', function($table){
                    $table->decimal('amount', 12, 2);
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
                Schema::table('cashflow_events', function($table) {
                    $table->dropColumn('amount');
                });
                Schema::table('cashflow_events', function($table){
                    $table->decimal('amount', 5, 2);
                });
	}

}
