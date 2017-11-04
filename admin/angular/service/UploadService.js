app.factory('fileUpload', function ($http, $q, $log) {
    var factory = {};

    factory.uploadFileToUrl = function (file) {
            var fd = new FormData();
            fd.append('fileToUpload', file);
            return $http.post("service/upload.php", fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                    .success(function (response) {
                        return response;
                    })
                    .error(function (response) {
                        console.log("Error");
                        return response;
                    });
        };
   
    return factory;
});