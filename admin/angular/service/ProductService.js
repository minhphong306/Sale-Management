app.factory('productService', function ($http, $q, $log) {
    var factory = {};

    factory.productAction = function (data) {
        return  $http({
            url: "service/product.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});