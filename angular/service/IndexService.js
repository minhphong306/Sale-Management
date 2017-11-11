app.factory('indexService', function ($http, $q, $log) {
    var factory = {};

    factory.getCategory = function (data) {
        return  $http({
            url: "admin/service/category.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});