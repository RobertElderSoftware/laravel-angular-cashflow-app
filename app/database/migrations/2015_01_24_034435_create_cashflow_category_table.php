<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashflowCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('cashflow_categories', function($table){
			$table->increments('id');
			$table->string('cashflow_category');
		});

		Schema::table('cashflow_events', function($table){
			$table->dropColumn('choices');
			$table->integer('cashflow_category_id');
		});

                DB::table('cashflow_categories')->insert(
                        array(
                                array('cashflow_category' => 'General Expense'),
                                array('cashflow_category' => 'Client Payment'),
                                array('cashflow_category' => 'Collected GST'),
                                array('cashflow_category' => 'GST on Purchase'),
                                array('cashflow_category' => 'Credit Card Payment'),
                                array('cashflow_category' => 'Employee Net Pay'),
                                array('cashflow_category' => 'Employee Pay Source Deduction')
                         )
                 );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('cashflow_categories');

		Schema::table('cashflow_events', function($table){
			$table->dropColumn('cashflow_category_id');
			$table->enum('choices', array('Client Payment', 'General Expense', 'Employee Pay', 'Taxes'));
		});

	}
}
