<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CashflowEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
        public function up(){
                Schema::create('cashflow_events', function(Blueprint $table) {
                        $table->increments('id');
			$table->unsignedInteger('commenter_id');
                        $table->decimal('amount', 5, 2);
                        $table->string('memo', 10000);
			$table->enum('choices', array('Client Payment', 'General Expense', 'Employee Pay', 'Taxes'));
                        $table->timestamps();
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
                Schema::table('cashflow_events', function(Blueprint $table) {
                        $table->drop();
                });
        }

}
