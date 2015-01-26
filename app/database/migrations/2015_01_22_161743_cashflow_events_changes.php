<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CashflowEventsChanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		/*  This must be done as raw sql due to a bug in doctrine where you cannot rename a column
                    that belongs to a table containing an enum 
                    http://doctrine-orm.readthedocs.org/en/latest/cookbook/mysql-enums.html
                */
		DB::statement("alter table cashflow_events change commenter_id owner_id INT not null;");
		Schema::table('cashflow_events', function($table){
		    $table->timestamp('event_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('cashflow_events', function($table) {
		    $table->dropColumn('event_time');
		});
		/*  This must be done as raw sql due to a bug in doctrine where you cannot rename a column
                    that belongs to a table containing an enum 
                    http://doctrine-orm.readthedocs.org/en/latest/cookbook/mysql-enums.html
                */
		DB::statement("alter table cashflow_events change owner_id commenter_id INT not null;");
	}
}
