<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
		@section('title')
		Demo Expense Web App
		@show
		</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/js/jquery-ui-1.11.2.custom/jquery-ui.theme.min.css"> 
		<link rel="stylesheet" href="/js/jquery-ui-1.11.2.custom/jquery-ui.structure.min.css"> 
		<link rel="stylesheet" href="/js/jquery-ui-1.11.2.custom/jquery-ui.min.css"> 
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
		<script src="/js/controllers/cashflowAnalyticsController.js"></script>
		<script src="/js/controllers/cashflowEventController.js"></script>
		<script src="/js/services/cashflowAnalyticsService.js"></script>
		<script src="/js/services/cashflowEventService.js"></script>
		<script src="/js/app.js"></script>
		<script type="text/javascript" src="https://www.robertelder.org/highcharts/highcharts.js"></script>
		<script type="text/javascript" src="https://www.robertelder.org/highcharts/highcharts-more.js"></script>
		<script type="text/javascript" src="https://www.robertelder.org/highcharts/exporting.js"></script>
		<script type="text/javascript" src="https://www.robertelder.org/highcharts/heatmap.js"></script>
		<script type="text/javascript" src="https://www.robertelder.org/highcharts/highcharts-3d.js"></script>
		<script type="text/javascript" src="/js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
		<script type="text/javascript">
			/*  Allows us to use laravel CSRF tokens through angular */
			angular.module("cashflowEventServiceModule").constant("CSRF_TOKEN", '{{ csrf_token() }}');

			$(document).ready(function () {
				/*  Set up date picker for data entry */
				$(".date-picker").datepicker({ dateFormat: 'yy-mm-dd', onSelect: function() { $(this).trigger('input'); }});
				$(".date-picker").datepicker('setDate', new Date());
				/*  Trigger the input box change so angular can pick it up and sync models. */
				$(".date-picker").trigger('input');
			});
		</script>
  	</head>
  	<body>  
  	<ul class="nav navbar-nav">  
	@if(!Auth::check())
		<li>{{ HTML::link('users/register', 'Register') }}</li>   
		<li>{{ HTML::link('users/login', 'Login') }}</li>   
		@else
		<li>{{ HTML::link('users/logout', 'Logout') }}</li>
	@endif
	</ul>

	@if(Auth::check())
	@yield('content')
	@endif
	@yield('login-form')
	@yield('register-form')
	<div style="height: 100px;">
	</div>
  </body>
</html>
