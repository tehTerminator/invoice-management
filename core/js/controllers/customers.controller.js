app.controller('CustomerController', ['$scope', '$http', function($scope, $http){
    $scope.customers = [];
    $scope.activePage = 1;
    $scope.itemsPerPage = 5;
    $scope.queryText = "";

    
    $scope.getCustomers = function(){
        $scope.customers = [];
        $scope.pages = [];

        var req = {
            "queryType" : "select",
            "tableName" : "customers"
        };

        $http.post(LINK, req)

        .success( function( res ){
            // console.log( res );
            angular.forEach(res.serverData, function(item){
                $scope.customers.push( item );
            });
        })

        .then(function(){
            $scope.$broadcast('Paginate', $scope.customers.length);
        });
    }

    $scope.$on('PageChange', function(event, data){
        $scope.currentPage = data.pageIndex;
        $scope.itemsPerPage = data.pageLength;
    });

    $scope.$on('SearchTextChange', function(event, data){
        $scope.queryText = data;
    })

}]);

