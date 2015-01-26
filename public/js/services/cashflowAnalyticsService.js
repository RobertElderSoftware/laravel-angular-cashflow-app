angular.module('cashflowAnalyticsServiceModule', [])
.factory('CashflowAnalytics', function($http) {
    return {
        get : function(cashflow_category_id) {
            if(cashflow_category_id && cashflow_category_id != '?'){
                return $http.get('/api/analytics_data?cashflow_category_id=' + cashflow_category_id);
            }else{
                return $http.get('/api/analytics_data');
            }
        }
    }
});
