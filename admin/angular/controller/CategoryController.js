app.controller('categoryCtrl', function ($scope, categoryService, NgTableParams) {
    $scope.data = [];
    $scope.get_data = {};
    $scope.get_data['mode'] = 'get_category';
    
    $scope.categoryTable = new NgTableParams({}, {dataset: $scope.data});
    
    categoryService.get_categories($scope.get_data).then(function(response){
        $scope.data = response.data.data;
        console.log($scope.data);
    });
});
