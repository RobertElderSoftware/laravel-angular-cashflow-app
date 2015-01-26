@extends('layouts.main')

@section('title')
@parent
:: Home
@stop
@section('content')
<div class="container" ng-app="cashflowApp" ng-controller="cashflowAnalyticsController">
	<div class="container" ng-controller="cashflowAnalyticsController">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header" style="text-align: center;">
				<h3>Cash Flow Overview</h3>
			</div>
			<div style="width: 800px; height:300px; margin-right:auto; margin-left:auto;" class="chart-container" id="chart1">
			</div>
			<div style="text-align: center;">
				Show cash flow events for
				<select ng-change="refreshCashflowAnalytics()" ng-model="selected_cashflow_category" ng-options="cashflow_category.id as cashflow_category.cashflow_category for cashflow_category in cashflow_categories">
				</select>
			</div>
		</div>
	</div>
	<hr/>
	<div class="container" ng-controller="cashflowEventController">
		<div class="col-md-8 col-md-offset-2">
			<div style="text-align: center;">
				<h3>@{{ header_text }}</h3>
			</div>

			<ul style="color:red" ng-hide="loading" ng-repeat="error in form_errors">
				<h4>@{{ error[0] }}</h4>
			</ul>

			<form ng-submit="submitCashflowEvent()">

				<div class="form-group">
					<label for="amount_input_id">Amount</label> &nbsp;<input ng-init="cashflowEventData.amount=0" id="amount_input_id" style="width: 280px; display:inline-block;" type="text" class="form-control input-sm" name="amount" ng-model="cashflowEventData.amount" placeholder="Amount">
					<span class="pull-right"><label for="date_input_id">Date</label> &nbsp;<input id="date_input_id"  style="width: 280px; display:inline-block;" type="text" class="date-picker form-control input-sm" name="event_time" ng-model="cashflowEventData.event_time" placeholder="Date"></span>
				</div>

				<div class="form-group">
					<textarea for="memo_input_id" class="form-control" rows="2" name="memo" ng-model="cashflowEventData.memo" placeholder="Memo"></textarea>
				</div>
				<div class="form-group">
					<label for="category_input_id">Category</label> &nbsp;
					<select id="category_input_id" name="cashflow_category" ng-model="cashflowEventData.cashflow_category_id" ng-options="cashflow_category.id as cashflow_category.cashflow_category for cashflow_category in cashflow_categories">
					</select>
				</div>
				<div class="form-group text-right">   
					<button type="submit" class="btn btn-primary btn-lg">Submit</button>
				</div>

			</form>
			<div style="text-align: center;">
				<h3>Recently Added Cash Flow Items</h3>
			</div>
			<div class="cashflow_event" ng-hide="loading" ng-repeat="cashflow_event in cashflow_events">
				<p>@{{ cashflow_event.amount }} for @{{ cashflow_categories_map[cashflow_event.cashflow_category_id] }} on @{{ cashflow_event.event_time }} Submitted by <a href="/users/@{{ cashflow_event.owner_id }}">@{{ cashflow_event.firstname }} @{{ cashflow_event.lastname }}</a></p>
				<p>@{{ cashflow_event.memo }}</p>
				<div><a href="#" ng-click="editCashflowEvent(cashflow_event.id)" class="text-muted">Edit</a><a href="#" ng-click="deleteCashflowEvent(cashflow_event.id)" class="text-muted pull-right">Delete</a></div>
				<hr ng-show="!$last">
			</div>
		</div>
	</div>
</div>
@stop
