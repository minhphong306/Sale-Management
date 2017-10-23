app.factory('unitService', function ($http, $q, $log) {
    var factory = {};

    factory.unitAction = function (data) {
        return  $http({
            url: "service/unit.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});