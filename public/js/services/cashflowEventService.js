angular.module('cashflowEventServiceModule', [])
.factory('CashflowEvent', function($http, CSRF_TOKEN) {
    return {
        get : function() {
            return $http.get('/api/cashflow_events');
        },

        edit : function(id) {
            return $http.get('/api/cashflow_events/' + id);
        },

        save : function(cashflowEventData) {
            var url = '/api/cashflow_events' + (cashflowEventData.id ? ('/' + cashflowEventData.id) : '');
            cashflowEventData.csrf_json = CSRF_TOKEN;
            return $http({
                method: cashflowEventData.id ? 'PUT' : 'POST',
                url: url,
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(cashflowEventData)
            });
        },

        destroy : function(id) {
            return $http.delete('/api/cashflow_events/' + id);
        }
    }
});
