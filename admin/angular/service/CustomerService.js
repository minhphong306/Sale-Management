app.factory('customerService', function ($http, $q, $log) {
    var factory = {};

    factory.customerAction = function (data) {
        return  $http({
            url: "service/customer.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});