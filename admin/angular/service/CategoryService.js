app.factory('categoryService', function ($http, $q, $log) {
    var factory = {};

    factory.get_categories = function (data) {
        return  $http({
            url: "service/category.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };

    return factory;
});