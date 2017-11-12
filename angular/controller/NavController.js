app.controller('navCtrl', function ($scope, categoryService, productService) {
    //<editor-fold defaultstate="collapsed" desc="Until model & function">
    function getRequestObject(mode) {
        var object = {};
        object['mode'] = mode;
        return object;
    }

    function show_notify(title, text, type) {
        (new PNotify({
            title: title,
            text: text,
            type: type
        }));
    }


    $scope.current_add_model = {};
    $scope.current_edit_model = {};
    $scope.current_remove_model = {};

    $scope.reset_add_model = function () {
        // init add model
        $scope.current_add_model.name = '';
        $scope.current_add_model.note = '';
    };
    $scope.reset_edit_model = function () {
        // init edit model
        $scope.current_edit_model.name = '';
        $scope.current_edit_model.note = '';
    };
    $scope.init_model = function () {
        $scope.reset_add_model();
        $scope.reset_edit_model();
    };

    $scope.load_edit_index = function (index) {
        $scope.current_edit_model['id'] = index.id;
        $scope.current_edit_model['name'] = index.name;
        $scope.current_edit_model['note'] = index.note;
    };

    $scope.load_remove_index = function (index) {
        $scope.current_remove_model['id'] = index.id;
        $scope.current_remove_model['name'] = index.name;
    };
    //</editor-fold>

    $scope.parent_categories = [];
    $scope.products = [];

    $scope.get_category = function () {
        var request_obj = getRequestObject('get_parent_category');
        categoryService.getCategory(request_obj).then(function (response) {
            $scope.parent_categories = response.data.data;
        });
    };

    $scope.get_product = function () {
        var request_obj = getRequestObject('get_product');
        productService.getProduct(request_obj).then(function (response) {
            $scope.products = response.data.data;
        });
    };
    //<editor-fold defaultstate="collapsed" desc="Init function">
    $scope.get_category();
    $scope.get_product();
    //</editor-fold>


});
