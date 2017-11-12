app.factory('sessionService', function ($http, $q, $log) {
    var factory = {};

    factory.sessionAction = function (data) {
        return  $http({
            url: "service/session.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
    
    factory.sessionClientAction = function (data) {
        return  $http({
            url: "admin/service/session.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});