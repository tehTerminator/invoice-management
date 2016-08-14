var app = angular.module('MainApp', ['ngRoute']);

app.config(function($routeProvider){
    $routeProvider
        .when('/', {
            'templateUrl' : 'templates/dashboard.html',
            'controller' : 'DashBoardController'
        })

        .when('/customers', {
            'templateUrl' : 'templates/customers.html',
            'controller' : 'CustomerController'
        })

        .when('/products', {
            'templateUrl' : 'templates/products.html',
            'controller' : 'ProductController'
        })

        .when('/invoices', {
            'templateUrl' : 'templates/invoices.html',
            'controller' : 'InvoiceController'
        })

        .otherwise({
            'redirectTo' : '/'
        });
})