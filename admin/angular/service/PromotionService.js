app.factory('promotionService', function ($http, $q, $log) {
    var factory = {};

    factory.promotionAction = function (data) {
        return  $http({
            url: "service/promotion.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});