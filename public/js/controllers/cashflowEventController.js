angular.module('cashflowEventControllerModule', [])

.controller('cashflowEventController', function($scope, $http, CashflowEvent) {
    $scope.header_text = "Add New Cash Flow Item";
    $scope.cashflowEventData = {};
    $scope.cashflow_categories = [];
    $scope.cashflow_categories_map = {};
    $scope.form_errors = [];
    $http.get('/api/cashflow_categories').
        success(function(d1, status, headers, config) {
            /*  Put these in a map, so we can display category names in view based on ids */
            for(var i = 0; i < d1.length; i++){
                $scope.cashflow_categories_map[d1[i].id] = d1[i].cashflow_category;
            }
            $scope.cashflow_categories = d1;
            $scope.loading = true;
            CashflowEvent.get()
                .success(function(data) {
                    $scope.cashflow_events = data;
                    $scope.loading = false;
                    $scope.form_errors = [];
                })
                .error(function(data) {
                    $scope.form_errors = data;
                    $scope.loading = false;
                });
            $scope.editCashflowEvent = function(id) {
                $scope.loading = true;
                CashflowEvent.edit(id)
                    .success(function(getData) {
                        $scope.cashflowEventData = getData;
                        $scope.loading = false;
                        $scope.form_errors = [];
                        $scope.header_text = "Editing Existing Cash Flow Item";
                    })
                    .error(function(data) {
                        $scope.form_errors = data;
                        $scope.loading = false;
                    });
            };
            $scope.submitCashflowEvent = function() {
                $scope.loading = true;
                CashflowEvent.save($scope.cashflowEventData)
                    .success(function(data) {
                        CashflowEvent.get()
                            .success(function(getData) {
                                $scope.cashflow_events = getData;
                                $scope.loading = false;
                                $scope.form_errors = [];
                                $scope.$emit('updateChartEvent');
                                $scope.header_text = "Add New Cash Flow Item";
                                delete $scope.cashflowEventData.id;
                            });
  
                    })
                    .error(function(data) {
                        $scope.form_errors = data;
                        $scope.loading = false;
                    });
            };
            $scope.deleteCashflowEvent = function(id) {
                var confirmed = confirm("Are you sure you want to delete this item?");
                if(confirmed){
                    $scope.loading = true; 
                    CashflowEvent.destroy(id)
                        .success(function(data) {
                            CashflowEvent.get()
                                .success(function(getData) {
                                    $scope.cashflow_events = getData;
                                    $scope.loading = false;
                                    $scope.form_errors = [];
                                    $scope.$emit('updateChartEvent');
                                });
                 
                        })
                        .error(function(data) {
                            $scope.form_errors = data;
                            $scope.loading = false;
                        });
                }
            };
        }).
        error(function(data, status, headers, config) {
            console.log("Unable to get cashflow categories.");
        });
});
