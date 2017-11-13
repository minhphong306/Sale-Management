app.factory('receiptService', function ($http, $q, $log) {
    var factory = {};

    factory.receiptAction = function (data) {
        return  $http({
            url: "service/receipt.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
    
     factory.test = function (data) {
        return  $http({
            url: "tmp_echo.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});