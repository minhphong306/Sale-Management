app.factory('galleryService', function ($http, $q, $log) {
    var factory = {};

    factory.galleryAction = function (data) {
        return  $http({
            url: "service/gallery.php",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: jQuery.param(data)
        }).success(function (response) {
            return response;
        });
    };
   
    return factory;
});