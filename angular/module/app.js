var app = angular.module('app', []);

app.directive('checkImage', function($http) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            attrs.$observe('ngSrc', function(ngSrc) {
                $http.get(ngSrc).success(function(){
                }).error(function(){
                    element.attr('src', 'http://localhost:8081/Sale_Manage/images/product/default.jpg'); // set default image
                });
            });
        }
    };
});