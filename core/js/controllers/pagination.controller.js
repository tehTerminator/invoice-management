app.controller('PaginationController', ['$scope', function($scope){
    $scope.totalPages = 0;
    $scope.pageLength = 5;
    $scope.pageIndex = 1;
    $scope.pageArray = [];
    $scope.lastPage = 1;
    $scope.dataLength = 0;
    $scope.searchText = "";

    $scope.setPage = function(i){
        if( i >= 1 || i <= $scope.totalPages ){
            $scope.pageIndex = i;
        } else{
            $scope.pageIndex = 1;
        }

        $scope.$emit('PageChange', {"pageIndex" : $scope.pageIndex, "pageLength" : $scope.pageLength });
    }

    $scope.setPageLength = function(i){
        $scope.pageLength = i;
        $scope.firstPage();
        $scope.initialize( $scope.dataLength );
    }

    $scope.firstPage = function(){
        $scope.setPage(1);
    }

    $scope.nextPage = function(){
        if( $scope.pageIndex < $scope.totalPages )
            $scope.setPage( $scope.pageIndex + 1 ); 
    }

    $scope.prevPage = function(){
        if( $scope.pageIndex > 1 )
            $scope.setPage( $scope.pageIndex - 1 );
    }

    $scope.lastPage = function(){
        $scope.setPage( $scope.totalPages );
    }

    $scope.$on('Paginate', function(event, dataLength){
        $scope.initialize( dataLength );
    });

    $scope.initialize = function(dataLength){
        $scope.dataLength = dataLength;
        $scope.totalPages = Math.ceil( dataLength / $scope.pageLength );
        $scope.firstPage();
        $scope.pageArray = [];

        for( var i = 0; i < $scope.totalPages; i++){
            $scope.pageArray.push( i + 1 ); 
        }
    }

    $scope.resetPage = function(){
        if( $scope.searchText == "" ){
            //Return to last Viewed Page After SearchText is erased
            $scope.setPage( $scope.lastPage );
        } else if( $scope.pageIndex > 1 ){
            $scope.lastPage = $scope.pageIndex;
            $scope.firstPage(); //Goto First Page When Searching
        }

        $scope.$emit('SearchTextChange', $scope.searchText);
    }

    $scope.isFirst = function(){
        return $scope.pageIndex == 1;
    }

    $scope.isLast = function () { 
        return $scope.pageIndex == $scope.totalPages;
     }

    $scope.initDropdown = function(){
        jQuery(".dropdown").dropdown();
    }

}]);

app.filter('paged', function(){
    return function(items, pageLength, pageIndex ){
        var result = [],
            minIndex = pageLength * (pageIndex - 1),
            maxIndex = pageLength * pageIndex
            index = 0;
        angular.forEach(items, function(item){
            if( index < minIndex ){
                index += 1;
            } else if( index >= maxIndex ){
                return result;
            } else{
                result.push( item ); 
                index += 1;
            }
        });
        return result;
    }
});