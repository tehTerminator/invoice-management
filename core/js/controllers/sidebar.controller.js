app.controller('SidebarController', function($scope, $http){
    $scope.items = [];

    $scope.getItems = function(){
        $http.get('core/data/sidebarItems.json')
        .success(function(response){
            $scope.items = response.items;
        });
    }

    $scope.initComponent = function(){
        jQuery(".sidebar.menu").sidebar('setting', 'transition', 'overlay');

        jQuery("#sidebarToggleButton").click(function(){
            jQuery(".sidebar.menu").sidebar('toggle');
        });

        jQuery(".sticky").sticky();
    }
})