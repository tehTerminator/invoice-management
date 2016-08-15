app.directive('sideBar', function(){
    return {
        'restrict' : 'E',
        'templateUrl' : 'components/sidebar.html'
    };
});

app.directive('tableHeader', function(){
    return {
        'restrict' : 'E',
        'templateUrl' : 'components/tableHeader.html'
    };
});

app.directive('customerTable', function(){
    return {
        'restrict' : 'E',
        'templateUrl' : 'components/customerTable.html'
    };
})