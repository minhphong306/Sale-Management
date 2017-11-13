app.factory('providerService', function ($http, $q, $log) {
    var factory = {};

    factory.providerAction = function (data) {
        return  $http({
            url: "service/provider.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});