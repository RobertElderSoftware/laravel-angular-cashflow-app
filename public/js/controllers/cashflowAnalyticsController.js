var chart1 = null;

$(function () {
    chart1 = $('#chart1').highcharts({
        chart:{
          type: 'column',
          backgroundColor: '#FFFFFF',
          height: 300,
          width: 800,
        },
        plotOptions: {
        },
        credits: {
             enabled: false
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Cash flow'
            }
        },
        tooltip: {
            formatter: function() {
                var events_list = "<br/>";
                for(var i = 0; i < this.point.cashflow_events.length; i++){
                    events_list += "<br/><strong>$" + this.point.cashflow_events[i].amount.toFixed(2) + "</strong> " + this.point.cashflow_events[i].memo;
                }
                return 'Total cash flow of <strong>$' + this.y.toFixed(2) + '</strong> on ' + Highcharts.dateFormat('%a %d %b', this.x) + ' for ' + this.series.name + events_list;
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: []
    }).highcharts();
});

function update_chart(data, category_name){
	var series = {};
	var unique_dates = {};
	var series_array = [];
	var keys = [];

        for(var i = 0; i < data.length; i++){
            /*  Group multiple data points on the same day together */
            if(data[i].event_time in unique_dates){
                unique_dates[data[i].event_time].push(data[i]);
            }else{
                unique_dates[data[i].event_time] = [];
                unique_dates[data[i].event_time].push(data[i]);
            }
        }

        for(var key in unique_dates){
		keys.push(key);
        }

	keys.sort();

        for(var i = 0; i < keys.length; i++){
            var year = parseInt(keys[i].substr(0,4), 10);
            var month = parseInt(keys[i].substr(5,7), 10) -1;
            var day = parseInt(keys[i].substr(8,10), 10);
            var total = 0;
            /*  The total for that day. */
            for(var j = 0; j < unique_dates[keys[i]].length; j++){
                var data_point = unique_dates[keys[i]][j];
                total += data_point.amount;
            }
            series_array.push({x: Date.UTC(year, month, day), y: total, cashflow_events: unique_dates[keys[i]]});
        }

	while(chart1.series.length > 0)
	    chart1.series[0].remove(true);

	chart1.addSeries({
            color: '#BF0B23',
	    name: 'Cash Flow for ' + category_name,
	    data: series_array
	});
}

angular.module('cashflowAnalyticsControllerModule', [])
.controller('cashflowAnalyticsController', function($scope, $http, CashflowAnalytics) {
    $scope.cashflow_categories = [];
    $scope.cashflow_categories_map = {};
    $scope.selected_cashflow_category = '?';
    $scope.$on('updateChartEvent', function() {
        CashflowAnalytics.get(null)
            .success(function(data) {
                $scope.cashflow_events = data;
                update_chart(data, $scope.cashflow_categories_map[$scope.selected_cashflow_category]);
                $scope.loading = false;
            })
            .error(function(data) {
                $scope.loading = false;
            });
    });
    $http.get('/api/cashflow_categories').
        success(function(d1, status, headers, config) {
            d1.push({"cashflow_category":"All Categories", "id": "?"});
            for(var i = 0; i < d1.length; i++){
                $scope.cashflow_categories_map[d1[i].id] = d1[i].cashflow_category;
            }
            $scope.cashflow_categories = d1;
            $scope.loading = true;
            CashflowAnalytics.get(null)
                .success(function(data) {
                    $scope.cashflow_events = data;
                    update_chart(data, $scope.cashflow_categories_map[$scope.selected_cashflow_category]);
                    $scope.loading = false;
                })
                .error(function(data) {
                    $scope.loading = false;
                });
            $scope.refreshCashflowAnalytics = function() {
                $scope.loading = true;
                CashflowAnalytics.get($scope.selected_cashflow_category)
                    .success(function(getData) {
                        $scope.cashflow_events = getData;
                        update_chart(getData, $scope.cashflow_categories_map[$scope.selected_cashflow_category]);
                        $scope.loading = false;
                    });
            };
        }).
        error(function(data, status, headers, config) {
            console.log("Unable to get cashflow categories.");
        });
});
