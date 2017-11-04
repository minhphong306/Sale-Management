app.factory('accountService', function ($http, $q, $log) {
    var factory = {};

    factory.accountAction = function (data) {
        return  $http({
            url: "service/account.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});