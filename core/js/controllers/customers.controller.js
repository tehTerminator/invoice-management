app.controller('CustomerController', ['$scope', '$http', function($scope, $http){
    $scope.activePage = 1;
    $scope.itemsPerPage = 5;
    $scope.queryText = "";
    $scope.selectedCustomer = {
        "name" : "",
        "address" : ""
    };

    $scope.isSelected = false;

    
    $scope.getCustomers = function(){
        $scope.$parent.customers = [];
        $scope.pages = [];

        var req = {
            "queryType" : "select",
            "tableName" : "customers"
        };

        $http.post(LINK, req)

        .success( function( res ){
            // console.log( res );
            angular.forEach(res.serverData, function(item){
                $scope.$parent.customers.push( item );
            });
        })

        .then(function(){
            $scope.$broadcast('Paginate', $scope.$parent.customers.length);
        });
    }

    $scope.addNew = function(){
        var request = {
            "queryType" : "insert",
            "tableName" : "customers",
            "params" : {
                "columnNames" : ['name', 'address'],
                "userData" : { "name" : $scope.selectedCustomer.name, "address" : $scope.selectedCustomer.address }
            }
        }

        $scope.save( request );
    }

    $scope.updateCustomer = function(){
        var request = {
            "queryType" : "update",
            "tableName" : "customers",
            "params" : {
                "columnNames" : ['name', 'address'],
                "userData" : { "name" : $scope.selectedCustomer.name, "address" : $scope.selectedCustomer.address },
                "conditions" : {"id" : $scope.selectedCustomer.id }
            }
        }

        $scope.save( request );
    }

    $scope.save = function(request){
        $http.post( LINK, request )

        .success( function(response){
            if( response['affectedRows'] == 1 ){
                $scope.selectedCustomer.id = response.lastInsertId;
                $scope.$parent.customers.push( $scope.selectedCustomer );
                $scope.selectedCustomer = {
                    "name" : "",
                    "address" : ""
                }

                $scope.isSelected = false;
            }
        });
    }

    $scope.selectCustomer = function(customer){
        var index = $scope.$parent.customers.indexOf( customer );
        $scope.selectedCustomer = customer;
        $scope.$parent.customers.splice(index, 1);
        $scope.isSelected = true;
    }

    $scope.unSelect = function(){
        $scope.$parent.customers.push( $scope.selectedCustomer );
        $scope.selectedCustomer = {
            "name" : "",
            "address" : ""
        }

        $scope.isSelected = false;
    }

    $scope.$on('PageChange', function(event, data){
        $scope.currentPage = data.pageIndex;
        $scope.itemsPerPage = data.pageLength;
    });

    $scope.$on('SearchTextChange', function(event, data){
        $scope.queryText = data;
    })

}]);

