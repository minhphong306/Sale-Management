app.factory('loginService', function ($http, $q, $log) {
    var factory = {};

    factory.loginAction = function (data) {
        return  $http({
            url: "service/login.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});